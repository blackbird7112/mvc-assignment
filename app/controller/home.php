<?php

namespace Controller;
session_start();

$_SESSION["role"] = null;
$_SESSION["name"] = null;

class Home{
    public function get(){
        echo \View\Loader::make()->render("templates/welcome.twig");
    }
}
