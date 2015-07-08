<?php
use google\appengine\api\users\User;
use google\appengine\api\users\UserService;
$user = UserService::getCurrentUser();
if ($user) {}
else {
  //header('Location: ' . UserService::createLoginURL($_SERVER['REQUEST_URI']));
  header("Location: https://accounts.google.com/Login#identifier");
}

?>