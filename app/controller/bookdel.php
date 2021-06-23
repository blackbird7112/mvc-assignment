<?php

namespace Controller;
session_start();

class BookDel{
    public function get(){
        if($_SESSION["admin"]==null){
            header("Location: /illegal");
        }else{
            echo \View\Loader::make()->render("templates/bookdel.twig");
        }
        }
    public function post(){
        $bid = $_POST['bid'];
        if(\Models\Admin::book_del($bid)){
            echo \View\Loader::make()->render("templates/bookdel.twig",array(
                stat => 1
            ));
        }else{
            echo \View\Loader::make()->render("templates/bookdel.twig",array(
                stat => 2
            ));
        }
    }
}