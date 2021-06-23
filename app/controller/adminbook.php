<?php

namespace Controller;
session_start();

class AdminBook{
    
        public function get(){
            if($_SESSION["admin"]==null){
                header("Location: /illegal");
            }else{
                $books = \Models\Admin::get_books();
                $books["users"] = str_replace(";",",",$books["users"]);
                echo \View\Loader::make()->render("templates/adminbook.twig", array(
                    books => $books
                ));
            }
        }
}