<?php

namespace Controller;
session_start();

class AdminHome{
    public function get(){
        if($_SESSION["role"]!="admin"){
            header("Location: /illegal");
        } else {
        echo \View\Loader::make()->render("templates/adminhome.twig",array(
            name => $_SESSION["name"],
        ));
    }
    }

}