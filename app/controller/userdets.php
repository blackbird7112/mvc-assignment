<?php

namespace Controller;
session_start();

class UserDets{
    public function get(){
        if($_SESSION["admin"]==null){
            header("Location: /illegal");
        }else{
        echo \View\Loader::make()->render("templates/userdets.twig");
    }
    }
    public function post(){
        $usr = $_POST["usr"];
        $row = \Models\Admin::user_dets($usr);
        if($row==false){
            echo \View\Loader::make()->render("templates/userdets.twig",array(
                stat => 2,
            ));
        }else{
        echo \View\Loader::make()->render("templates/userdets.twig",array(
            stat => 1,
            dat => $row
        ));
    }
    }

}