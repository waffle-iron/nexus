<?php

  class bulksms extends nexus{

    var $username = "domesticindustries";
    var $password = "24peterroad";
    var $credits;

    function get_credits(){
      //REF: http://developer.bulksms.com/eapi/account/get_credits/
      $error_message = "Could not fetch credits";
      $result = $this->curl([
        "url" => "http://bulksms.2way.co.za/eapi/user/get_credits/1/1.1?username=".$this->username."&password=".$this->password,
        "explode" => "|"
      ]);


      if(!empty($result)){
        $this->credits = $result[0] == "0" ? "R ".$result[1] : "R 0.00";
      }else{
        $this->error("Could not fetch credits");
      }
      return $this->credits;
    }

    //TODO find a way to allow another plugin to declare page_data

    function topup(){
      return "this will be the topup page";
    }

    function __construct($method = "dashboard"){
      global $page_data;
      $this->get_credits();
      $page_data["stat_block_balance"] = $this->parse_template("stat_block.template",[
        "stat_block_type" => "info",
        "icon"            => "balance-scale",
        "label"           => "Available Credits",
        "credits"         => $this->credits,
        "link_text"       => "Top Up"
      ]);
      $page_data["chart"] = $this->get_template("chart.template");
      //TODO allow all module data to be available on the page if they are public variables... maybe prefix the template call with module_
      parent::__construct($method);
    }
  }

?>
