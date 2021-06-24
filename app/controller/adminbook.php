<?php

namespace Controller;
session_start();

class AdminBook{
    
        public function get(){
            if($_SESSION["role"]!="admin"){
                header("Location: /illegal");
            } else {
                $books = \Models\Admin::get_books();
                echo \View\Loader::make()->render("templates/adminbook.twig", array(
                    books => $books
                ));
            }
        }
}