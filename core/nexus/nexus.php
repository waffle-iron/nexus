<?php
//use google\appengine\api\users\User;
use google\appengine\api\users\UserService;

//set_include_path('my_additional_path' . PATH_SEPARATOR . get_include_path()); //todo auto load here

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

    function info($message = "No information provided",$title = "Info"){
        print parse_template("info.template",['title'=>$title, 'message'=>$message]);
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

    function get_user_info(){
      //TODO logout must clear session
      //TODO login must reassign session to nulls and start again
      $_SESSION["user"] = null;
      $user = UserService::getCurrentUser();

      if($user){
        $_SESSION["user"]["nickname"]   = $user->getNickname();
        $_SESSION["user"]["logout_url"] = UserService::createLogoutUrl('/');
        $_SESSION["user"]['email']      = $user->getEmail();
      }

      return $_SESSION["user"];
    }

    function save_user_info(){
      //var_dump($_GET);
      //todo once the google script has loaded call this function
      //then do a check to see if profile name and profile exists, if so dont load the gplus script
      return null;
    }

    function get_path($options = []){
        $options = is_array($options) ? $options : array("relative");
        $reflector = new ReflectionClass(get_class($this));
        $fn = $reflector->getFileName();
        $filepath = dirname($fn);

        $filepath = (array_key_exists("relative",$options) && $options["relative"] == true) ? str_replace($_SERVER["DOCUMENT_ROOT"],"",$filepath) : $filepath;
        return $filepath;
    }

    function get_stylesheets(){
      //TODO:maybe link this function with the other get_scripts tag
      $stylesheets = [];

      if(file_exists(get_file_location(get_class($this).".min.css")["absolute_path"])){
        $stylesheets[] = parse_template("link_tag.template",[
          "href"    => get_file_location(get_class($this).".min.css")["relative_path"],
          "rel"     => "stylesheet",
          "module"  => get_class($this)
        ]);
      }

      $parents = $this->get_parents();
      foreach($parents as $name=>$data){
        if(file_exists(get_file_location($name.".min.css")["absolute_path"])){
            $stylesheets[] = parse_template("link_tag.template",[
              "href"    => get_file_location($name.".min.css")["relative_path"],
              "rel"     => "stylesheet",
              "module"  => $name
            ]);
        }
      }
      $stylesheets = array_reverse($stylesheets);
      $stylesheets = implode("",$stylesheets);
      return $stylesheets;
    }

    function get_scripts(){

      $scripts = [];

      if(file_exists(get_file_location(get_class($this).".min.js")["absolute_path"])){
        $scripts[] = parse_template("script_tag.template",[
          "src"     => get_file_location(get_class($this).".min.js")["relative_path"],
          "module"  => get_class($this)
        ]);

      }

      $parents = $this->get_parents();
      foreach($parents as $name=>$data){
        if(file_exists(get_file_location($name.".min.js")["absolute_path"])){
            $scripts[] = parse_template("script_tag.template",[
              "src" => get_file_location($name.".min.js")["relative_path"],
              "module"  => get_class($this)
            ]);
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
      return parse_template("dashboard.template");
    }

    //TODO catch template not found

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
        $menu_items .= parse_template("menu_item.template",[
          "url" => $module["url"],
          "text" => $module["name"],
          "icon" => $module["icon"]
        ]);
      }

      return $menu_items;
    }

    function __construct($requested_method = "dashboard"){
      //$this->name = $this->get_name();
    }
}

?>
