<?php
//use google\appengine\api\users\User;
use google\appengine\api\users\UserService;

//set_include_path('my_additional_path' . PATH_SEPARATOR . get_include_path()); //todo auto load here

$page_data = [
  "page_content"          => null,
  "account_settings_url"  => "https://myaccount.google.com/",
  "company_name"          => "Domestic", //settings //company settings
  "company_logo_url"      => "/images/company_logo.png",
  "year"                  => date("Y"),
  "month"                 => intval(getdate()["mon"]) < 10 ? ("0".getdate()["mon"]) : getdate()["mon"],
  "day"                   => getdate()["mday"],
  "weekday"               => getdate()["weekday"]
];
$page_data["today"] = $page_data["year"]."-".$page_data["month"]."-".$page_data["day"];

function debug($object){
  //TODO  change this to a javascript debug
  //TODO change this to a template call
  $title = (func_num_args() == 2) ? func_get_arg(1) : 'Debug';

  if(is_array($object) && func_num_args() == 1){
      $title = "Debugging Array(".sizeof($object).")";
  }

  $object = is_string($object) ? htmlentities($object) : $object;

  print "<details class='debug' open>";
  print "<summary>".$title."</summary>";
  print "<pre>";
  print_r($object);
  print "</pre>";
  print "</details>";
}

class nexus{

    public $name = '';
    public $user = null;
    public static $instances = 0;
    var $defaults = [
      "method" => "dashboard"
    ];

    //http://stackoverflow.com/questions/173400/how-to-check-if-php-array-is-associative-or-sequential
    function readable_string($string = ""){

      $string = str_replace("-"," ",$string);
      $string = str_replace("_"," ",$string);

      return $string;
    }

    function alert($message = null){
      if($message != null)
      print '<script>alert("'.$message.'")</script>';
    }

    function error($message = "An error occurred",$title = "Error"){
      $stacktrace = debug_backtrace();
      array_shift($stacktrace);

        print $this->parse_template("error.template",[
          "title"=>$title,
          "message"=>$message,
          "stacktrace" => $stacktrace
        ]);
    }


    function info($message = "No information provided",$title = "Info"){
        print $this->parse_template("info.template",['title'=>$title, 'message'=>$message]);
    }

    function generate_html_table($data){

      $html_table = '
        <table>
          <thead>
            <tr>';

      foreach($data as $column){
        $html_table .= '<th>';
        $html_table .= $column;
        $html_table .= '</th>';
      }

      $html_table .= '</tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
          </tfoot>
        </table>
      ';

      return $html_table;
    }

    function get_name(){
        $name = get_class($this);
        $name = str_replace('nexus_','',$name);
        $name = str_replace('_',' ',$name);
        $name = ucwords($name);
        return $name;
    }

    function get_parents($class = null,$plist=array()){

        $class = $class ? $class : $this;
        $parent = get_parent_class($class);
        if($parent) {
            $rfparent = new ReflectionClass($parent);
            $plist[$parent] = [
                'absolute_path' => dirname($rfparent->getFileName()),
                'relative_path' => str_replace($_SERVER['DOCUMENT_ROOT'],'',dirname($rfparent->getFileName()))
            ];
            $plist = self::get_parents($parent, $plist);
        }
        return $plist;

    }

    function get_stylesheets(){

        $stylesheets = array();
        $location = $this->get_file_location(get_class($this).'.min.css');
        array_push($stylesheets,$this->parse_template("link.template",[
          "rel" => "stylesheet",
          "href" => $location
        ]));

        $parents = $this->get_parents();
        foreach($parents as $name=>$data){
            if($name == "nexus") continue;
            if(file_exists($data["absolute_path"]."/stylesheets/".$name.".min.css")){
                array_push($stylesheets, $this->parse_template("link.template",[
                  "rel"   => "stylesheet",
                  "href"  => $data["relative_path"]."/stylesheets".$name.".min.css"
                ]));
            }
        }
        $stylesheets = array_reverse($stylesheets);
        $stylesheets = implode("",$stylesheets);
        return $stylesheets;
    }

    function get_scripts(){
      $scripts = '';
      $location = $this->get_file_location(get_class($this).'.min.js');
      $scripts .= '<script type="text/javascript" src="'.$location.'" ></script>';

      //todo get parent stylesheets
      $parents = $this->get_parents();
      foreach($parents as $name=>$data){
          if(file_exists($data['absolute_path'].'/scripts/'.$name.'.min.js')){
              $scripts .= '<script type="text/javascript" src="'.$data['relative_path'].'/scripts/'.$name.'.min.js" ></script>';
          }
      }
      return $scripts;

      //return file_exists($this->get_path().'/scripts/'.get_class($this).'.js') ? "<script type='text/javascript' src='".$this->get_path(['relative'])."/scripts/".get_class($this).".js'></script>" : null;
    }

    function get_extension($filename = ''){

        if(strpos($filename,".") < 0 ){return null;}
        $parts = explode('.',$filename);
        return $parts[count($parts)-1];
    }

    function get_user_info(){
      $_SESSION["user"] = null;
      $user = UserService::getCurrentUser();

      if($user){
        $_SESSION["user"]["nickname"]   = $user->getNickname();
        $_SESSION["user"]["logout_url"] = UserService::createLogoutUrl('/');
        $_SESSION["user"]['user_email'] = $user->getEmail();
      }

      return $_SESSION["user"];
    }

    function get_path($relative = false){
        $reflector = new ReflectionClass(get_class($this));
        $fn = $reflector->getFileName();
        $filepath = dirname($fn);

        $filepath = ($relative == true)  ? str_replace($_SERVER["DOCUMENT_ROOT"],"",$filepath) : $filepath;
        //$this->debug($filepath,'filepath');
        //$this->debug($_SERVER['DOCUMENT_ROOT'],'doc root');
        return $filepath;
    }

    function get_file_location($filename = null){
        $location = null ;

        switch($this->get_extension($filename)){
            case "js":
            break;

            case "css":
            if(file_exists($this->get_path()."/stylesheets/".$filename)){
                return $this->get_path(['relative']).'/stylesheets/'.$filename;
            }
            break;

            default:
            //TODO check the user template section for a template matching module name


            //check module's template folder
            if(file_exists($this->get_path()."/templates/".$filename)){
                return $this->get_path().'/templates/'.$filename;
            }

            //check parent's template folders
            $parents = $this->get_parents();
            foreach($parents as $name=>$data){
                if(file_exists($data['absolute_path'].'/templates/'.$filename)){
                    return $data['absolute_path'].'/templates/'.$filename;
                }
            }

            break;
        }



        return $location;
    }

    function get_template($template_name = null){
        $location = $this->get_file_location($template_name);
        $template = $location ? file_get_contents($location) : $template_name;
        return $template;
    }

    function parse_template($template,$data = []){
      global $page_data;
      //todo need a way to catch templates NOT found
      //these are gonna be the global variables
			//these values must get fetched from the setup file\module

      //$template = file_get_contents(getcwd()."/core/templates/".$template);
      $template = $this->get_template($template);
      $page_data["user"]                               = $_SESSION["user"];
      $page_data['module_name']                        = $this->name;
      $page_data['module_name_lowercase']              = strtolower($this->name);
      $page_data["module_name_singular"]               = substr($this->name,0,strlen($this->name)-1);
      $page_data["module_class"]                       = get_class($this);

      $data = array_merge($data,$page_data);

			while(preg_match("/\(#(.*?)#\)/", $template)){
				if (preg_match_all("/\(#(.*?)#\)/", $template, $variables)){
					foreach ($variables[1] as $i => $variable_name){
            $match		= array_key_exists($variable_name,$data) ? $data[$variable_name] : '';
						$match		= is_array($match) ? json_encode($match) : $match;
						$template	= str_replace($variables[0][$i],$match, $template);
					}
				}
			}

			return html_entity_decode($template);
		}

    //TODO error function must check call stack for the function that initiated it
    function curl($params = []){
      //TODO if internet connection unavailable (maybe in js) throw error message
      //TODO get cached version first...

      $result;

      if(array_key_exists("url",$params)){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $params["url"]
        ));
        $result = curl_exec($curl);
        if(array_key_exists("explode",$params)){
          $result = explode("|",$result);
        }

        curl_close($curl);
      }
      else{
        $this->error("No url provided.");
      }

      return $result;
    }

    function dashboard(){
        return $this->parse_template("dashboard.template");
    }

    //TODO catch template not found

    function get_query_string_object(){
  		$object = [];

  		if($_SERVER["QUERY_STRING"] !== ""){
  			foreach(explode("&",$_SERVER["QUERY_STRING"]) as $index=>$string){
  				$arr = explode("=",$string);
  				$key = $arr[0];
  				$value = count($arr) == 2 ? $arr[1] : null;
  				$object[$key] = $value;
  			}
  		}
  		$object["ajax"] = array_key_exists("ajax",$object) ? $object["ajax"] : "false";

  		return $object;
  	}

    function __construct($requested_method = "dashboard"){
        global $page_data;

        $this->name = $this->get_name();
        $this->queries = $this->get_query_string_object();

        //TODO function to fetch all page_data
        $requested_module = null;
        $page_data = array_merge($page_data,$this->get_user_info());

        //catch module and method request
        $_SERVER["QUERY_STRING"]  = !array_key_exists("QUERY_STRING",$_SERVER) ? "" : $_SERVER["QUERY_STRING"];
        $_SERVER["PATH_INFO"]     = !array_key_exists("PATH_INFO",$_SERVER) ? str_replace($_SERVER["QUERY_STRING"],"",$_SERVER["REQUEST_URI"]) : $_SERVER["PATH_INFO"];
        $_SERVER["PATH_INFO"]     = str_replace("?","",$_SERVER["PATH_INFO"]);
        $request_array            = explode("/",$_SERVER["PATH_INFO"]);    //converts the url requested path string into an object
        $request_array            = array_diff($request_array,array(""));  //removes empty values from the array
        $request_array            = array_values($request_array);          //resets the indexes of the array
        if(count($request_array) >= 1){
          $requested_method = count($request_array) > 1 ? $request_array[1] : $this->defaults["method"];
          $requested_module = $page_data["requested_module"] = $request_array[0];
          $module_path = $_SERVER["DOCUMENT_ROOT"]."/plugins/".$requested_module."/".$requested_module.".php";
          $_SERVER["PATH_INFO"] = null;

          if(file_exists($module_path)){
            require_once("plugins/".$requested_module."/".$requested_module.".php");
            if(function_exists($requested_method)){
              $page_data["page_content"] = $requested_method();
            }
            elseif(class_exists($requested_module)){
              $requested_module_class = new $requested_module($requested_method);
              if(method_exists($requested_module_class,$requested_method)){
                $page_data["page_content"] = $requested_module_class->$requested_method();
              }
              else{
                $this->error("requested method: ".$requested_method." does not exist");
              }

              if(is_subclass_of($requested_module_class,"nexus")){
                return;
              }
            }
            else{
              $this->error("The function:<br/><i>".$requested_method."</i><br/>does not exist","Undefined");
            }
          }
          else{
            $this->error("the requested page: ".$_SERVER["REQUEST_URI"]." <br/>could not be found","page not found");
          }

        }else{
          $requested_module = get_class($this);
          $page_data["page_content"] = $this->$requested_method();
        }

        $page_data["head"] = $this->parse_template("head.template",[
          "stylesheets" => $this->get_stylesheets(),
          "scripts"     => $this->get_scripts()
        ]);

        $page_data["requested_method"]  = $requested_method;
        $page_data["page_content"]      = $this->parse_template($page_data["page_content"],$page_data);

        if($this->queries["ajax"] ==  "true"){
          print $page_data["page_content"];
        }else{
          print $this->parse_template("nexus.template",$page_data);

        }

        return;
    }
}

?>
