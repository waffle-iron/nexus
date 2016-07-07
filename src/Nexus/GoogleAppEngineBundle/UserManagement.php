<?php
/**
 * Created by PhpStorm.
 * User: craigiswayne
 * Date: 2016/07/05
 * Time: 20:45
 */

namespace Nexus\GoogleAppEngineBundle;
use google\appengine\api\users\UserService;

class UserManagement{

    public function getUserId(){
        return UserService::getCurrentUser()->getUserId();
    }

    public function getNickname(){
        return UserService::getCurrentUser()->getNickname();
    }

    public function getEmail(){
        return UserService::getCurrentUser()->getEmail();;
    }

    public function getLogoutUrl(){
        return UserService::createLogoutUrl('/');
    }

    public function getProfileUrl(){
        return "https://aboutme.google.com/u/".self::getEmail();
    }
}