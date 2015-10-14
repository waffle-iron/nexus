<?php
use google\appengine\api\users\User;
use google\appengine\api\users\UserService;

//set_include_path('my_additional_path' . PATH_SEPARATOR . get_include_path()); //todo auto load here
class nexus{

    public $name = '';
    public $user = null;
    var $default_method = 'dashboard';

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

    function debug($object){

        $title = (func_num_args() == 2) ? func_get_arg(1) : 'Debug';

        if(is_array($object) && func_num_args() == 1){
            $title = "Debugging Array(".sizeof($object).")";
        }

        print "<details class='debug' open>";
        print "<summary>".$title."</summary>";
        print "<pre>";
        print_r($object);
        print "</pre>";
        print "</details>";
    }

    function error($title = 'Error', $message = ''){
        return $this->parse_template("error.template",['title'=>$title, 'message'=>$message]);
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
        $stylesheets = '';

        $location = $this->get_file_location(get_class($this).'.min.css');
        $stylesheets .= '<link rel="stylesheet" href="'.$location.'" />';

        //todo get parent stylesheets
        $parents = $this->get_parents();
        foreach($parents as $name=>$data){
            if(file_exists($data['absolute_path'].'/stylesheets/'.$name.'.min.css')){
                $stylesheets .= '<link rel="stylesheet" href="'.$data['relative_path'].'/stylesheets/'.$name.'.min.css" />';
            }
        }

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

      /*
      if (isset($user)) {
          echo sprintf('Welcome, %s! (<a href="%s">sign out</a>)',
                       $user->getNickname(),
                       UserService::createLogoutUrl('/'));
        } else {
          echo sprintf('<a href="%s">Sign in or register</a>',
                       UserService::createLoginUrl('/'));
        }
      */

      if($this->user){
        $info = [
          'user_nickname' => $this->user->getNickname()
        ];
      }

      return $info;
    }

    function get_path($relative = false){
        $reflector = new ReflectionClass(get_class($this));
        $fn = $reflector->getFileName();
        $filepath = dirname($fn);

        $filepath = ($relative == true)  ? str_replace($_SERVER["DOCUMENT_ROOT"],"",$filepath) : $filepath;
        $this->debug($filepath,'filepath');
        $this->debug($_SERVER['DOCUMENT_ROOT'],'doc root');
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

            //todo need a way to catch templates NOT found
            //these are gonna be the global variables
			//these values must get fetched from the setup file\module

            //$template = file_get_contents(getcwd()."/core/templates/".$template);
      $template = $this->get_template($template);

      //$data['logout_url']                         = UserService::createLogoutUrl('/');

      $data['account_settings_url']               = 'https://myaccount.google.com/';

      $data['module_name']                        = $this->name;
      $data['module_name_lowercase']              = strtolower($this->name);
      $data["module_name_singular"]               = substr($this->name,0,strlen($this->name)-1);
      $data["module_class"]                       = get_class($this);
      $data['company_name']                       = "Domestic"; //settings //company settings
      $data['company_logo_url']                   = "/images/company_logo.png";

      $data['year']                               = date('Y');
			$data['month']                              = intval(getdate()['mon']) < 10 ? ('0'.getdate()['mon']) : getdate()['mon'];
			$data['day']                                = getdate()['mday'];
			$data['weekday']                            = getdate()['weekday'];
			$data['today']                              = $data['year'].'-'.$data['month'].'-'.$data['day'];

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

    function dashboard(){
        return $this->parse_template("dashboard.template");
    }

    function __construct($method = null){

        $this->name = $this->get_name();
        $this->user = UserService::getCurrentUser();

        if(strlen($_SERVER['REQUEST_URI']) > 1){
            $request = explode("/",$_SERVER['REQUEST_URI']);
            array_shift($request);
            $class_name   = 'nexus_'.$request[0];
            $class_name   = str_replace('%20','_',$class_name);
            $method = count($request) == 2 ? $request[1] : $this->default_method;
            $_SERVER['REQUEST_URI'] = null;
            //todo check if that class exists, if not, redirect to the error page
            require_once("plugins/".$class_name."/".$class_name.".php");
            $class = new $class_name($method);
        }
        else{
          $logout_url = '';
          if (!$this->user) {
            header('Location: ' . UserService::createLoginURL($_SERVER['REQUEST_URI']));
          }
          else{
            $logout_url = UserService::createLogoutUrl('/');
          }

          //$sql = new mysqli('172.194.229.73:3306','craig.wayne','RockSteady2015!','');

            /*$conn = mysqli_connect(":/cloudsql/nexus-ga:sample-demo","craig.wayne","RockSteady2015!","");
            if (mysqli_connect_errno())
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            else{
              echo 'connection successful';
            }*/


            $content = '';
            if(!method_exists($this,$method)){
                $content .= $method ? $this->error('Method: "'.$method.'" not found') : '';
                $method = $this->default_method;
            }

            $content .= $this->$method();

            $template_data = [
                'logout_url'        => $logout_url,
                'module_method'     => $method,
                "stylesheets"       => $this->get_stylesheets(),
                "scripts"           => $this->get_scripts(),
                "head"              => $this->get_template("head.template"),
                'show_menu_flag'    => $_SERVER['REQUEST_URI'] == '/'    ? 'show_menu' : 'hide_menu',
                'admin_user_flag'   => UserService::isCurrentUserAdmin() ? 'admin' : '',
                "content"           => $content
            ];

            $template_data = array_merge($this->get_user_info(), $template_data);
            echo $this->parse_template("index.template",$template_data);
        }
    }
}

?>
