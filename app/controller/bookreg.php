<?php

namespace Controller;
session_start();

class BookReg{
    public function get(){
        if($_SESSION["role"]!="admin"){
            header("Location: /illegal");
        }else{
            echo \View\Loader::make()->render("templates/bookreg.twig");
        }
        }
    public function post(){
        $name = $_POST['name'];
        $author = $_POST['author'];
        $publisher = $_POST['publisher'];
        $maxqty = $_POST['qty'];
        if(\Models\Admin::book_reg($name,$author,$publisher,$maxqty)){
            echo \View\Loader::make()->render("templates/bookreg.twig",array(
                status => 2
            ));
        } else {
            echo \View\Loader::make()->render("templates/bookreg.twig",array(
                status => 1
            ));
        }
    }
}