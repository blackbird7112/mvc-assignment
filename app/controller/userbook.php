<?php

namespace Controller;
session_start();

class UserBook{
    public function get(){
        if($_SESSION["user"]==null){
            header("Location: /illegal");
        }else{
        echo \View\Loader::make()->render("templates/userbook.twig",array(
            books => \Models\User::get_books()
        ));
    }
    }
}