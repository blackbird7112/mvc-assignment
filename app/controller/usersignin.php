<?php

namespace Controller;
session_start();
$_SESSION["user"] = null;
$_SESSION["admin"] = null ;


class UserLog{
    public function get(){
        echo \View\Loader::make()->render("templates/usersignin.twig", array(
            error => false
        ));
    }

    public function post(){
        $usr = $_POST["usr"];
        $pass = $_POST["pass"];
        $passhash = hash("sha256",$pass);
        
        if(\Models\User::login($usr,$passhash)){
            $_SESSION["user"] = $usr;
            header("Location: /userhome");
        }
        else{
        echo \View\Loader::make()->render("templates/usersignin.twig", array(
            error => true
        ));
    }
    }
}
