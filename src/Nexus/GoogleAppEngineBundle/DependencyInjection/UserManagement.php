<?php
/**
 * Created by PhpStorm.
 * User: craigiswayne
 * Date: 2016/07/05
 * Time: 20:45
 */

namespace Nexus\GoogleAppEngineBundle\DependencyInjection;

use google\appengine\api\users\UserService;

class UserManagement{


    const KEY_UNIQUE_ID        = "id";
    const KEY_PRIMARY_EMAIL    = "email";
    const KEY_EMAIL_ALIAS      = "alias";

    public function getAvatar(){
        return "/bundles/nexusgentelella/images/img.jpg";
    }

    public function getKey($type = self::KEY_UNIQUE_ID){

        switch($type){
            case self::KEY_EMAIL_ALIAS;
                return null;

            default:
                return self::getId();
        }
    }

    public function getId(){
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

    public function getPermissionsUrl(){
        return "https://security.google.com/settings/security/permissions/";
    }

}