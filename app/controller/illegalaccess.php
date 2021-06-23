<?php

namespace Controller;

class IllegalAccess{
    public function get(){
        echo \View\Loader::make()->render("templates/illaccess.twig");
    }
}