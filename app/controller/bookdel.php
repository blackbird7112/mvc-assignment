<?php

namespace Controller;
session_start();

class BookDel{
    public function get(){
        if($_SESSION["role"]!="admin"){
            header("Location: /illegal");
        } else {
            echo \View\Loader::make()->render("templates/bookdel.twig");
        }
        }
    public function post(){
        $bookid = $_POST['bid'];
        if(\Models\Admin::book_del($bookid)){
            echo \View\Loader::make()->render("templates/bookdel.twig",array(
                status => 1
            ));
        } else {
            echo \View\Loader::make()->render("templates/bookdel.twig",array(
                status => 2
            ));
        }
    }
}