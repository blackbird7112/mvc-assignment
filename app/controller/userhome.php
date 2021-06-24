<?php

namespace Controller;
session_start();

class UserHome{
    public function get(){
        if($_SESSION["role"]!="user"){
            header("Location: /illegal");
        } else {
        echo \View\Loader::make()->render("templates/userhome.twig",array(
            name => $_SESSION["name"],             
            checkout => \Models\User::get_checkout($_SESSION["name"]),
            pendreqs => \Models\User::get_pendreq($_SESSION["name"]),
        ));
    }
    }

}