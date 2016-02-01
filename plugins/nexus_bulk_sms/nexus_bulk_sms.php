<?php
  class nexus_bulk_sms{

  }
    $url = "http://bulksms.2way.co.za/eapi/user/get_credits/1/1.1?username=domesticindustries&password=24peterroad";

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url
    ));
    $result = explode("|",curl_exec($curl));
    curl_close($curl);
    var_dump($result);


?>
