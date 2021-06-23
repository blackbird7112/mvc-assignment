<?php

namespace Controller;

class UserSignUp{
    public function get(){
        echo \View\Loader::make()->render("templates/usersignup.twig", array(
            error => false
        ));
    }

    public function post(){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $usr = $_POST["usr"];
        $pass = $_POST["pass"];
        $repass = $_POST["repass"];
        if($pass==$repass && preg_match("/^[a-zA-Z0-9 ]+$/",$name) && preg_match("/^[a-zA-Z0-9]+$/",$usr) && preg_match("/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/",$email) && preg_match("/^[0-9]+$/",$phone)){
            $pass = hash("sha256",$pass);
            if(\Models\User::user_reg($usr,$name,$email,$phone,$pass)){
                echo \View\Loader::make()->render("templates/usersignup.twig", array(
                    error => 1
                ));
            }else{
                echo \View\Loader::make()->render("templates/usersignup.twig", array(
                    error => 2
                ));    
            }
        }else{
            echo \View\Loader::make()->render("templates/usersignup.twig", array(
                error => 2
            ));
        }
    }
}