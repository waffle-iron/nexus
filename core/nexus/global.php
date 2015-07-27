<?php

function is_assoc(array $array){
  return (bool)count(array_filter(array_keys($array), 'is_string'));
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

//["menu 1","menu 2"]

function generate_menu($menu_array=[]){

  if(is_assoc($menu_array)){
    debug('associative');
  }
  else{
    debug('not associative');
  }

  $menu = '<div class=menu>';
  foreach($menu_array as $key=>$value){
    if(is_assoc($menu_array)){
      $text = $key;
    }
    else{
      $text = $value;
    }


    $parent_flag = is_array($value) ? 'parent' : '';

    $menu .= '<div class="item '.$parent_flag.'">'.$text;

    if(is_array($value)){
      $menu .= generate_menu($value);
    }

    $menu .= '</div>';
  }
  $menu .= '</div>';
  return $menu;
}

?>
