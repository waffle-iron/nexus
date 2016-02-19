<?php
//TODO enable caching from php headers
//with meta tags and all, also run a chrome page audit

session_start(); //todo close this session on logout
$_nexus = [];

function get_server_info(){
  global $_nexus;
  $_nexus["server"] = $_SERVER;

  //fixes for null entries
  $_nexus["server"]["QUERY_STRING"]       = !array_key_exists("QUERY_STRING",$_nexus["server"]) ? "" : $_nexus["server"]["QUERY_STRING"];
  $_nexus["server"]["PATH_INFO"]          = !array_key_exists("PATH_INFO",$_nexus["server"]) ? str_replace($_nexus["server"]["QUERY_STRING"],"",$_nexus["server"]["REQUEST_URI"]) : $_nexus["server"]["PATH_INFO"];
  $_nexus["server"]["PATH_INFO"]          = str_replace("?","",$_nexus["server"]["PATH_INFO"]);

  if(array_key_exists("QUERY_STRING",$_nexus["server"])){
    parse_str($_SERVER["QUERY_STRING"],$_nexus["server"]["query_string_array"]);
  }

  if(!array_key_exists("ajax", $_nexus["server"]["query_string_array"])){
    $_nexus["server"]["query_string_array"]["ajax"] = "false";
  }
  return $_nexus["server"];
}

function get_company_info(){
  $company = [];
  $company["name"]  = "Domestic";
  $company["logo"]  = "/images/company_logo.png"; //TODO a better way of setting the company variable
  return $company;
}

function get_url_requests(){
  global $_nexus;
  $_nexus["request"] = null;

  if($_nexus["server"]["PATH_INFO"] && $_nexus["server"]["PATH_INFO"] != "/"){
    $_nexus["request"]["array"]   = explode("/",$_nexus["server"]["PATH_INFO"]);        //converts the url requested path string into an object
    $_nexus["request"]["array"]   = array_diff($_nexus["request"]["array"],array(""));  //removes empty values from the array
    $_nexus["request"]["array"]   = array_values($_nexus["request"]["array"]);          //resets the indexes of the array

    if(count($_nexus["request"]["array"]) >= 1){
      $_nexus["request"]["module"]["name"]  = $_nexus["request"]["array"][0];
      $_nexus["request"]["module"]["path"]  = $_nexus["server"]["DOCUMENT_ROOT"]."/plugins/".$_nexus["request"]["module"]["name"]."/".$_nexus["request"]["module"]["name"].".php";
      $_nexus["request"]["method"]          = count($_nexus["request"]["array"]) > 1 ? $_nexus["request"]["array"][1] : null;
    }
  }

  return $_nexus["request"];
}

function get_file_location($filename = null){
    global $_nexus;

    if(!$filename) return null;
    $location = [];
    $folder_to_check = "templates"; //default folder to check

    switch(get_extension($filename)){
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
    //TODO this must equal the loaded class
    if(file_exists($_nexus["request"]["module"]["class"]->get_path()."/".$folder_to_check."/".$filename)){
        $location["absolute_path"] = $_nexus["request"]["module"]["class"]->get_path()."/".$folder_to_check."/".$filename;
        $location["relative_path"] = $_nexus["request"]["module"]["class"]->get_path(["relative" => true])."/".$folder_to_check."/".$filename;
        return $location;
    }

    //check parent's module folder
    $parents = $_nexus["request"]["module"]["class"]->get_parents();
    foreach($parents as $name=>$data){
        if(file_exists($data["absolute_path"]."/".$folder_to_check."/".$filename)){
            $location["absolute_path"] = $data["absolute_path"]."/".$folder_to_check."/".$filename;
            $location["relative_path"] = $data["relative_path"]."/".$folder_to_check."/".$filename;
            return $location;
        }
    }
}

function get_template($template_name = null){
    $template = [];

    $template["location"] = get_file_location($template_name);
    if(!$template["location"]) return null;

    if(array_key_exists("absolute_path",$template["location"])){
      $template["contents"] = file_get_contents($template["location"]["absolute_path"]);
    }
    else{
      error("Template name: ".$template_name,"Template not found");
    }
    //$template[]
    //fetch template
    //fetch template name
    //template size
    //template location
    //template fileextension

    return $template;
}

function parse_template($template_name = null,$template_data = []){

  if(!$template_name || !is_string($template_name)) return null;

  global $_nexus;
  // todo need a way to catch templates NOT found
  $match = "";
  $template = get_template($template_name) ?: array("contents" => $template_name);
  //TODO get public class vars into the data
  $template_data["page"]    = $_nexus["page"];
  $template_data["request"] = $_nexus["request"];
  $template_data["user"]    = !isset($_SESSION["user"]) ? [] : $_SESSION["user"];

  $template_data["company"] = get_company_info();
  $template_data["date"]["year"]    = date("Y");
  $template_data["date"]["month"]   = intval(getdate()["mon"]) < 10 ? ("0".getdate()["mon"]) : getdate()["mon"];
  $template_data["date"]["day"]     = getdate()["mday"];
  $template_data["date"]["weekday"] = getdate()["weekday"];
  debug($template_data);
  $template_regex = "/\(#(.*?)#\)/";
  $count = 0;
  while(preg_match($template_regex, $template["contents"]) && $count < 10){
    $count++;
    if (preg_match_all($template_regex,$template["contents"], $variables_found)){

      foreach ($variables_found[1] as $i => $variable_name){
        if(strpos($variable_name,"|") > 0){
          //check for (#var|var|var#)
          $lua = $template_data;
          $v = $variable_name;
          $ra = explode("|",$v);

          foreach($ra as $k){
            if(array_key_exists($k,$lua)){
              $lua = $lua[$k];
              if($k == end($ra)){
                $match = $lua;
              }
            }else{
              break;
            }
          }

        }elseif(strpos($variable_name,".widget") > -1){
          //check for (#var.widget#)
          $match = parse_template($variable_name);
        }else{
          //check for (#var#)
          $match		= array_key_exists($variable_name,$template_data) ? $template_data[$variable_name] : "";
        }

        $match = is_array($match) ? json_encode($match) : $match;
        $template["contents"]	= str_replace($variables_found[0][$i],$match, $template["contents"]);

      }
    }
  }



  return html_entity_decode($template["contents"]);
}

function display_page(){
  global $_nexus;
  ob_start();

  if($_nexus["request"]){
    $_nexus["request"]["module"]["class"] = new nexus();
    $_nexus["request"]["method"]          = "dashboard";
  }else{
    $_nexus["request"]["module"]["name"]  = "nexus";
    $_nexus["request"]["module"]["class"] = new nexus();
    $_nexus["request"]["method"]          = "dashboard";
  }

  //TODO should this get split into $_nexus["page"]["output_buffer"]???
  $_nexus["request"]["method"]  = !method_exists($_nexus["request"]["module"]["class"],$_nexus["request"]["method"]) ? "dashboard" : $_nexus["request"]["method"];
  $_nexus["page"]["content"]    = !isset($_nexus["page"]["content"]) ? "" : $_nexus["page"]["content"];
  $_nexus["page"]["content"]    .= $_nexus["request"]["module"]["class"]->$_nexus["request"]["method"]();
  $_nexus["page"]["content"]    .= ob_get_contents();

  ob_end_clean();
  $_nexus["page"]["head"] = parse_template("head.template",[
     "stylesheets" => $_nexus["request"]["module"]["class"]->get_stylesheets(),
     "scripts"     => $_nexus["request"]["module"]["class"]->get_scripts()
  ]);

  if($_nexus["server"]["query_string_array"]["ajax"] ==  "true"){
    print parse_template($_nexus["page"]["content"]);
  }else{
    print parse_template("nexus.template");
  }

  // if(count($_nexus["request"]["array"]) >= 1){
  //
  //   return null;
  //
  //   $_nexus["server"]["PATH_INFO"] = null;

  //   if(file_exists($module_path)){
  //     require_once("plugins/".$_nexus["request"]["module"]."/".$_nexus["request"]["module"].".php");
  //     if(function_exists($requested_method)){
  //       $_nexus["page"]["content"] = $requested_method();
  //     }
  //     elseif(class_exists($_nexus["request"]["module"])){
  //       $requested_module_class = new $_nexus["request"]["module"]($requested_method);
  //       if(method_exists($requested_module_class,$requested_method)){
  //         $page_data["page_content"] = $requested_module_class->$requested_method();
  //       }
  //       else{
  //         $this->error("requested method: ".$requested_method." does not exist");
  //       }
  //
  //       if(is_subclass_of($requested_module_class,"nexus")){
  //         return;
  //       }
  //     }
  //     else{
  //       $this->error("The function:<br/><i>".$requested_method."</i><br/>does not exist","Undefined");
  //     }
  //   }
  //   else{
  //     $this->error("the requested page: ".$_SERVER["REQUEST_URI"]." <br/>could not be found","page not found");
  //   }
  //
  // }else{
  //   $_nexus["request"]["module"] = $_nexus["request"]["array"][2];
  //   //$_nexus["page"]["content"] = $this->$requested_method();
  // }
  //

  //
  // $_nexus["request"]["method"]  = $requested_method;
  // $_nexus["page"]["content"]      = $this->parse_template($_nexus["page"]["content"]);
  // $_nexus["page"]["menu_items"]   = $this->generate_main_menu();
  //
  // $_nexus["page"]["content"] = $output_buffer . $_nexus["page"]["content"];
  //

}

function init(){
  get_server_info();
  get_url_requests();
  display_page();

  //debug($match);

  // //first | replace with [
  // $t = str_replace_first("|","[",$t);
  //
  // //every other pipe replace with ][
  // $t = str_replace("|","][",$t);
  // $t .= "]";
  // parse_str($t,$request_arr);
  // debug($request_arr);
  //
  // $result = array_intersect($_nexus,$request_arr);
  // debug(array_keys($result));
  //
  // if($_test[$request_arr]){
  //   print_r("the requested array was found");
  // }
  // else{
  //   print_r("not found :(");
  // }

  //debug($request_arr);

  //then append to string ]


  //parse_str($t, $request_arr);
  //debug($request_arr);
}

init();
#TODO all core classes must be in required.php
//new nexus();

$finish = $time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
print_r("Finished in ".number_format($time,2,".","")." seconds");
