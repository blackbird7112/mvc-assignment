<?php

namespace Controller;
session_start();

class UserHome{
    public function get(){
        if($_SESSION["user"]==null){
            header("Location: /illegal");
        }else{
        echo \View\Loader::make()->render("templates/userhome.twig",array(
            name => $_SESSION["user"],             
            checkout => \Models\User::get_checkout($_SESSION["user"]),
            pendreqs => \Models\User::get_pendreq($_SESSION["user"]),
        ));
    }
    }

}