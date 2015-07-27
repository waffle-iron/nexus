<?php
require_once("core/nexus_forms/nexus_forms.php");

class nexus_fleet_management extends nexus_forms{

  

  function test_dashboard(){
    /*$data = ['data' => 'this', 'data2' => 'that'];
    $data = http_build_query($data);
    $context = [
    'http' => [
    'method' => 'GET',
    'header' => "custom-header: custom-value\r\n" .
                "custom-header-two: custom-value-2\r\n",
    'content' => $data
    ]
    ];
    $context = stream_context_create($context);
    $result = file_get_contents('https://my.tracker.co.za/Login.aspx', false, $context);
    $this->debug($result);

    /*https://my.tracker.co.za/Login.aspx*/
    /*$username = 'geyser68';
    $password = 'dom123';
    $loginUrl = 'https://my.tracker.co.za/Login.aspx';

    //init curl
    $ch = curl_init();

    //Set the URL to work with
    curl_setopt($ch, CURLOPT_URL, $loginUrl);

    // ENABLE HTTP POST
    curl_setopt($ch, CURLOPT_POST, 1);

    //Set the post parameters
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'user='.$username.'&pass='.$password);

    //Handle cookies for the login
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');

    //Setting CURLOPT_RETURNTRANSFER variable to 1 will force cURL
    //not to print out the results of its query.
    //Instead, it will return the results as a string return value
    //from curl_exec() instead of the usual true/false.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    //execute the request (the login)
    $store = curl_exec($ch);

    //the login is now done and you can continue to get the
    //protected content.

    curl_setopt($ch, CURLOPTURL,'https://my.tracker.co.za/Skytrax/ControlCentre.aspx');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  	$data = curl_exec($ch);
  	curl_close($ch);
  	$this->debug($data);
    /*

    //set the URL to the protected file
    curl_setopt($ch, CURLOPT_URL, 'http://www.example.com/protected/download.zip');

    //execute the request
    $content = curl_exec($ch);
    */
    //curl_close($ch);

    //save the data to disk
    //file_put_contents('~/download.zip', $content);
  }

  function get_data($url) {
  	$ch = curl_init();
  	$timeout = 5;
  	curl_setopt($ch, CURLOPT_URL, $url);
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  	$data = curl_exec($ch);
  	curl_close($ch);
  	return $data;
  }

}

?>
