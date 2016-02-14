<?php
//use google\appengine\api\users\User;
use google\appengine\api\users\UserService;

//set_include_path('my_additional_path' . PATH_SEPARATOR . get_include_path()); //todo auto load here
$output_buffer = "";
$errors = [];

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

  //print "<noscript>";
  print "<details class='debug' open>";
  print "<summary>".$title."</summary>";
  print "<pre>";
  print_r($object);
  print "</pre>";

  if(is_object($object) || is_array($object)){
    //print "<script>var nexus = nexus || {}; nexus.debug = []; nexus.debug.push(".$object."); console.debug(nexus.debug);";
    //print "</script>";
  }

  print "</details>";
  //print "</noscript>";
}

function alert($message = null){
  if($message != null)
  print '<script>alert("'.$message.'")</script>';
}

class nexus{

    var $name = null;
    var $settings = [
      "icon" => "link"
    ];
    var $defaults = [
      "method" => "dashboard"
    ];


    //http://stackoverflow.com/questions/173400/how-to-check-if-php-array-is-associative-or-sequential
    function readable_string($string = ""){

      $string = str_replace("-"," ",$string);
      $string = str_replace("_"," ",$string);

      return $string;
    }

    function generate_nav_items(){
      // //get plugin files
      // $plugin_modules = [];
      // $project_root_files = scandir("../../plugins");
      // debug($project_root_files);
      //
      // foreach($project_root_files as $file){
      //   //debug($file);
      //    if(is_dir("../../".$file) && ($file != "." || $file != "..")){
      //      //array_push($plugin_modules,$file);
      //      $plugin_modules[] = $file;
      //      debug($file);
      //    }
      // }
      // //debug($plugin_modules);
      //
      // //get core files
      // //$core_modules = [
      //
      // //];

      //debug(scandir("../../"));
      //debug(dirname("../../app.bak.yaml"));
      //$path= dirname(__FILE__);
      //$dir  = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
      //$files = new Rec")ursiveIteratorIterator($dir, RecursiveIteratorIterator::CHILD_FIRST);
      //debug($files);

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
                "absolute_path" => dirname($rfparent->getFileName()),
                "relative_path" => str_replace($_SERVER['DOCUMENT_ROOT'],'',dirname($rfparent->getFileName()))
            ];
            $plist = self::get_parents($parent, $plist);
        }
        return $plist;

    }

    function get_extension($filename = ''){

        if(strpos($filename,".") < 0 ){return null;}
        $parts = explode('.',$filename);
        return $parts[count($parts)-1];
    }

    function get_user_info(){
      //TODO logout must clear session
      //TODO login must reassign session to nulls and start again
      $_SESSION["user"] = null;
      $user = UserService::getCurrentUser();

      if($user){
        $_SESSION["user"]["nickname"]   = $user->getNickname();
        $_SESSION["user"]["logout_url"] = UserService::createLogoutUrl('/');
        $_SESSION["user"]['user_email'] = $user->getEmail();
      }

      return $_SESSION["user"];
    }

    function get_path($options = []){
        $options = is_array($options) ? $options : array("relative");
        $reflector = new ReflectionClass(get_class($this));
        $fn = $reflector->getFileName();
        $filepath = dirname($fn);

        $filepath = (array_key_exists("relative",$options) && $options["relative"] == true) ? str_replace($_SERVER["DOCUMENT_ROOT"],"",$filepath) : $filepath;
        //$this->debug($filepath,'filepath');
        //$this->debug($_SERVER['DOCUMENT_ROOT'],'doc root');
        return $filepath;
    }

    function get_file_location($filename = null){

        if(!$filename) return null;
        $location = [];
        $folder_to_check = "templates"; //default folder to check

        switch($this->get_extension($filename)){
            case "js":
              $folder_to_check = "scripts";
            break;

            case "css":
              $folder_to_check = "stylesheets";
            break;

            case "template":
              $folder_to_check = "templates";
            break;

            case "widget":
              $folder_to_check = "widgets";
            break;
        }

        //check module specific folder...
        if(file_exists($this->get_path()."/".$folder_to_check."/".$filename)){
            $location["absolute_path"] = $this->get_path()."/".$folder_to_check."/".$filename;
            $location["relative_path"] = $this->get_path(["relative" => true])."/".$folder_to_check."/".$filename;
            return $location;
        }

        //check parent's module folder
        $parents = $this->get_parents();
        foreach($parents as $name=>$data){
            if(file_exists($data["absolute_path"]."/".$folder_to_check."/".$filename)){
                $location["absolute_path"] = $data["absolute_path"]."/".$folder_to_check."/".$filename;
                $location["relative_path"] = $data["relative_path"]."/".$folder_to_check."/".$filename;
                return $location;
            }
        }
    }

    function get_stylesheets(){
      //TODO:maybe link this function with the other get_scripts tag
      $stylesheets = [];

      if(file_exists($this->get_file_location(get_class($this).".min.css")["absolute_path"])){
        $stylesheets[] = $this->parse_template("link_tag.template",[
          "href" => $this->get_file_location(get_class($this).".min.css")["relative_path"],
          "rel"  => "stylesheet"
        ]);
      }

      $parents = $this->get_parents();
      foreach($parents as $name=>$data){
        if(file_exists($this->get_file_location($name.".min.css")["absolute_path"])){
            $stylesheets[] = $this->parse_template("link_tag.template",[
              "href" => $this->get_file_location($name.".min.css")["relative_path"],
              "rel"  => "stylesheet"
            ]);
        }
      }
      $stylesheets = array_reverse($stylesheets);
      $stylesheets = implode("",$stylesheets);
      return $stylesheets;
    }

    function get_scripts(){

      $scripts = [];

      if(file_exists($this->get_file_location(get_class($this).".min.js")["absolute_path"])){
        $scripts[] = $this->parse_template("script_tag.template",["src" => $this->get_file_location(get_class($this).".min.js")["relative_path"]]);
      }

      $parents = $this->get_parents();
      foreach($parents as $name=>$data){
        if(file_exists($this->get_file_location($name.".min.js")["absolute_path"])){
            $scripts[] = $this->parse_template("script_tag.template",[
              "src" => $this->get_file_location($name.".min.js")["relative_path"]]);
        }
      }
      $scripts = array_reverse($scripts);
      $scripts = implode("",$scripts);
      return $scripts;
    }

    function get_file($file_name = null){

      if(!$file_name) return null;

      $file = [];
      $file["location"] = $this->get_file_location($file_name);
      return $file;
    }

    function get_template($template_name = null){
        $template = [];

        $template["location"] = $this->get_file_location($template_name);
        if(!$template["location"]) return null;

        if(array_key_exists("absolute_path",$template["location"])){
          $template["contents"] = file_get_contents($template["location"]["absolute_path"]);
        }
        else{
          $this->error("Template name: ".$template_name,"Template not found");
        }
        //$template[]
        //fetch template
        //fetch template name
        //template size
        //template location
        //template fileextension

        return $template;
    }

    function parse_template($template_name = null,$data = []){

      if(!$template_name || !is_string($template_name)) return null;

      //debug("looking for: ".$template);
      global $page_data;
      //todo need a way to catch templates NOT found
      //these are gonna be the global variables
			//these values must get fetched from the setup file\module

      $template = $this->get_template($template_name) ?: array("contents" => $template_name);

      $page_data["user"]                               = $_SESSION["user"];
      $page_data['module_name']                        = $this->name;
      $page_data['module_name_lowercase']              = strtolower($this->name);
      $page_data["module_name_singular"]               = substr($this->name,0,strlen($this->name)-1);
      $page_data["module_class"]                       = get_class($this);

      //TODO get public class vars into the data
      $data = array_merge($data,$page_data);

			while(preg_match("/\(#(.*?)#\)/", $template["contents"])){
				if (preg_match_all("/\(#(.*?)#\)/", $template["contents"], $variables)){
					foreach ($variables[1] as $i => $variable_name){
            if(strpos($variable_name,".widget") > -1){
                $match = $this->parse_template($variable_name);
            }else{
              $match		= array_key_exists($variable_name,$data) ? $data[$variable_name] : '';
              $match		= is_array($match) ? json_encode($match) : $match;
            }
            $template["contents"]	= str_replace($variables[0][$i],$match, $template["contents"]);
					}
				}
			}
      return html_entity_decode($template["contents"]);
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

      if(array_key_exists("QUERY_STRING",$_SERVER)){
        if($_SERVER["QUERY_STRING"] != ""){
          foreach(explode("&",$_SERVER["QUERY_STRING"]) as $index=>$string){
            $arr = explode("=",$string);
            $key = $arr[0];
            $value = count($arr) == 2 ? $arr[1] : null;
            $object[$key] = $value;
          }
        }
      }
  		$object["ajax"] = array_key_exists("ajax",$object) ? $object["ajax"] : "false";

  		return $object;
  	}

    private function get_all_modules(){

      //TODO cache this!
      //TODO auto require all core modules
      //TODO user info to be stored in the session variable not in the class

      //REF: http://www.codedevelopr.com/articles/recursively-scan-a-directory-using-php-spl-directoryiterator/
      $modules = [];
      $plugins_directory = $_SERVER["DOCUMENT_ROOT"]."/plugins";
      $directory = new RecursiveDirectoryIterator($plugins_directory,RecursiveDirectoryIterator::SKIP_DOTS);
      $iterator = new RecursiveIteratorIterator($directory,RecursiveIteratorIterator::LEAVES_ONLY);

      $extensions = array("php");

      foreach ($iterator as $fileinfo) {
          if (in_array($fileinfo->getExtension(), $extensions)) {
              $file_name = str_replace(".".$fileinfo->getExtension(),"",$fileinfo->getFileName());
              $folder_name = basename(dirname($fileinfo->getPathname()));

              if($file_name == $folder_name){
                //TODO check if this class is excluded from the menu via its class settings
                //TODO get module name from class settings
                //TODO cache this bitch
                require_once($fileinfo->getPathname());
                $class_settings = get_class_vars($file_name)["settings"];
                $class_settings["name"] = !array_key_exists("name",$class_settings) ? $file_name : $class_settings["name"];
                $class_settings["url"]  = !array_key_exists("url", $class_settings) ? "/".$file_name : $class_settings["url"];
                $modules[$file_name] = $class_settings;
              }
          }
      }

      return $modules;
    }

    public function generate_main_menu(){
      $menu_items = "";
      $modules = $this->get_all_modules();
      foreach($modules as $module){
        $menu_items .= $this->parse_template("menu_item.template",[
          "url" => $module["url"],
          "text" => $module["name"],
          "icon" => $module["icon"]
        ]);
      }

      return $menu_items;
    }

    function __construct($requested_method = "dashboard"){
      //TODO:clean up this function
        global $page_data;
        global $output_buffer;

        $requested_module = null;

        ob_start();

        $this->name = $this->get_name();
        $this->queries = $this->get_query_string_object();

        //TODO function to fetch all page_data
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
        $page_data["menu_items"]        = $this->generate_main_menu();
        $output_buffer .= ob_get_contents();
        ob_end_clean();

        $page_data["page_content"] = $output_buffer . $page_data["page_content"];
        if($this->queries["ajax"] ==  "true"){
          print $page_data["page_content"];
        }else{
          print $this->parse_template("nexus.template",$page_data);
        }

        return;
    }
}

?>
