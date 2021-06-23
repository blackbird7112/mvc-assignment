<?php

namespace Controller;
session_start();

class AdminBook{
    
        public function get(){
            if($_SESSION["admin"]==null){
                header("Location: /illegal");
            }else{
                $books = \Models\Admin::get_books();
                foreach($books as $b){
                    $b["users"] = str_replace(";",",",$b["users"]);
                }
                echo \View\Loader::make()->render("templates/adminbook.twig", array(
                    books => $books
                ));
            }
        }
}