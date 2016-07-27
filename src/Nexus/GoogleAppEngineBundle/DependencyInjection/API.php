<?php

/**
 * Created by PhpStorm.
 * User: craigiswayne
 * Date: 2016/07/09
 * Time: 01:59
 */

namespace Nexus\GoogleAppEngineBundle\DependencyInjection;

use Nexus\GoogleDriveBundle\DependencyInjection\GoogleDriveService;

class API{

    protected $twig;

    function __construct(\Twig_Environment $twig){
        $this->twig = $twig;
    }

    //TODO Fix me
    function getClient($application_name, $scopes = array()) {
        if(!$application_name || size($scopes) < 1)
            return false;

        $client_secret_path = $this->get("kernel")->getRootDir().'/../client_secret.json';

        $client = new \Google_Client();
        $client->setApplicationName($application_name);
        $client->setScopes($scopes);
        $client->setAuthConfigFile($client_secret_path);
        $client->setAccessType('offline');

        // Load previously authorized credentials from a file.
        $session = new Session();
        $session->start();
        if ($session->get('access_token')) {
            $accessToken = $session->get('access_token');
        } else {
            //TODO send client to authorization process
            $accessToken = $client->authenticate($authCode);
            $session->set('access_token',$accessToken);
        }
        $client->setAccessToken($accessToken);

        // Refresh the token if it's expired.
        if ($client->isAccessTokenExpired()) {
            $client->refreshToken($client->getRefreshToken());
            $session->set('access_token',$client->getAccessToken());
        }

        return $client;
    }

    

    public function getTest(){
//        $engine = $this->container->get('templating');
//        $content = $engine->render('article/index.html.twig');
        return GoogleDriveService::getFilesList();
//        return "test";
    }

}