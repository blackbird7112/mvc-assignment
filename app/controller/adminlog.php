<?php

namespace Controller;
session_start();
$_SESSION["role"] = null;


class AdminLog{
    public function get(){
        echo \View\Loader::make()->render("templates/adminsignin.twig", array(
            error => false
        ));
    }
    public function post(){
        $user = $_POST["user"];
        $pass = $_POST["pass"];
        $passhash = hash("sha256",$pass);
        
        if(\Models\Admin::login($user,$passhash)){
            $_SESSION["role"] = "admin";
            $_SESSION["name"] = $user;
            header("Location: /adminhome");
        } else {
        echo \View\Loader::make()->render("templates/adminsignin.twig", array(
            error => true
        ));
    }
    }
}