<?php

namespace Controller;
session_start();

$_SESSION["user"] = null;
$_SESSION["admin"] = null;

class Home{
    public function get(){
        echo \View\Loader::make()->render("templates/welcome.twig");
    }
}
