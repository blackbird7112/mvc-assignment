<?php

namespace Controller;
session_start();
$_SESSION["role"] = null;


class UserLog{
    public function get(){
        echo \View\Loader::make()->render("templates/usersignin.twig", array(
            error => false
        ));
    }

    public function post(){
        $user = $_POST["user"];
        $pass = $_POST["pass"];
        $passhash = hash("sha256",$pass);
        
        if(\Models\User::login($user,$passhash)){
            $_SESSION["role"] = "user";
            $_SESSION["name"] = $user;
            header("Location: /userhome");
        }
        else{
        echo \View\Loader::make()->render("templates/usersignin.twig", array(
            error => true
        ));
    }
    }
}
