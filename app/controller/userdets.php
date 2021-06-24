<?php

namespace Controller;
session_start();

class UserDets{
    public function get(){
        if($_SESSION["role"]!="admin"){
            header("Location: /illegal");
        } else {
        echo \View\Loader::make()->render("templates/userdets.twig");
    }
    }
    public function post(){
        $user = $_POST["user"];
        $row = \Models\Admin::user_dets($user);
        if($row == false){
            echo \View\Loader::make()->render("templates/userdets.twig",array(
                status => 2,
            ));
        } else {
        echo \View\Loader::make()->render("templates/userdets.twig",array(
            status => 1,
            data => $row
        ));
    }
    }

}