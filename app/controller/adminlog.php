<?php

namespace Controller;
session_start();
$_SESSION["user"] = null;
$_SESSION["admin"] = null ;


class AdminLog{
    public function get(){
        echo \View\Loader::make()->render("templates/adminsignin.twig", array(
            error => false
        ));
    }
    public function post(){
        $usr = $_POST["usr"];
        $pass = $_POST["pass"];
        $passhash = hash("sha256",$pass);
        
        if(\Models\Admin::login($usr,$passhash)){
            $_SESSION["admin"] = $usr;
            header("Location: /adminhome");
        }
        else{
        echo \View\Loader::make()->render("templates/adminsignin.twig", array(
            error => true
        ));
    }
    }
}