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
        $user = $_POST["usr"];
        $password = $_POST["pass"];
        $repassword = $_POST["repass"];
        if($password==$repassword && preg_match("/^[a-zA-Z0-9 ]+$/",$name) && preg_match("/^[a-zA-Z0-9]+$/",$user) && preg_match("/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/",$email) && preg_match("/^[0-9]+$/",$phone)){
            $password = hash("sha256",$password);
            if(\Models\User::user_reg($user,$name,$email,$phone,$password)){
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