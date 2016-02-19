<?php

function str_replace_first($needle,$replace,$haystack){
  $pos = strpos($haystack, $needle);
  $newstring = $haystack;
  if ($pos !== false) {
      $newstring = substr_replace($haystack, $replace, $pos, strlen($needle));
  }
  return $newstring;
}

function get_extension($filename = ""){

    if(strpos($filename,".") < 0 ){return null;}
    $parts = explode('.',$filename);

    return $parts[count($parts)-1];
}

function alert($message = null){
  if($message != null)
  print '<script>alert("'.$message.'")</script>';
}

function debug($object){
  //TODO  change this to a javascript debug
  //TODO change this to a template call
  $title = (func_num_args() == 2) ? func_get_arg(1) : 'Debug';

  if(is_array($object) && func_num_args() == 1){
      $title = "Debugging Array(".sizeof($object).")";
  }

  $object = is_string($object) ? htmlentities($object) : $object;

  //print "<noscript>";
  print "<details class='debug' closed>";
  print "<summary>".$title."</summary>";
  print "<pre>";
  print_r($object);
  print "</pre>";

  if(is_object($object) || is_array($object)){
    //print "<script>var nexus = nexus || {}; nexus.debug = []; nexus.debug.push(".$object."); console.debug(nexus.debug);";
    //print "</script>";
  }
  print "<details closed>";
  print "<summary>StackTrace</summary>";
  print "<pre>";
  $backtrace = debug_backtrace();
  array_shift($backtrace);
  print_r($backtrace);
  print "</pre>";
  print "</details>";

  print "</details>";
  //print "</noscript>";
}




?>
