<?php
/**
 * Created by PhpStorm.
 * User: craigiswayne
 * Date: 2016/07/12
 * Time: 10:28
 */

namespace Nexus\GoogleDriveBundle\DependencyInjection;


class GoogleDriveService{

    public function getFilesList(){
//        $session = $this->get("kernel")->get('session') || new Session();
//        $session->start();

        $auth_code = $_GET["code"];
        str_replace($auth_code,"#","");
        $client = new \Google_Client();
        $client->setApplicationName("Nexus");
        $client->addScope(\Google_Service_Drive::DRIVE_METADATA_READONLY);
        $client->setAuthConfigFile(__DIR__.'/../../../../client_secret.json');

//        $accessToken = $session->get('access_token') || null;

        if($auth_code){
            $accessToken = $client->authenticate($auth_code);
//            $session->set('access_token',$accessToken);

            $client->setAccessToken($accessToken);
            $service = new \Google_Service_Drive($client);
            $optParams = array(
                'pageSize' => 10,
                'fields' => "nextPageToken, files(id, name)"
            );
            $results = $service->files->listFiles($optParams);
            $data = array("items" => array());

            foreach($results["modelData"]["files"] as $item) {
                $data["items"][] = array(
                    "title" => $item["name"],
                    "month" => "This Month",
                    "day" => "Today",
                    "summary" => "None Yet...",
                    "url" => "#"
                );
            }
            return json_decode($data);
            //return $this->twig->render('NexusGoogleAppEngineBundle:Default:box_list_with_date_mini.html.twig',$data);

        }else {
            $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'];
            $client->setRedirectUri($redirect_uri);
            $auth_url = $client->createAuthUrl();
            return "<a href='" . $auth_url . "'>AUTHORIZATION</a>";
        }

    }
}