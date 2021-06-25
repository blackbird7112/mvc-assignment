<?php

namespace Controller;
session_start();

class UserRequest{
    public function post(){
        $data = json_decode(file_get_contents('php://input'), true);
        $bookid = $data['bid'];
        $reqtype = $data['type'];
        $user = $_SESSION['name'];
        $datetime = date("Y-m-d h:i:sa");
        $response = \Models\User::set_req($user,$bookid,$reqtype,$datetime);
        if($response){
            echo "{\"status\":\"Request successful\"}";
        }
        else{
            echo "{\"status\":\"Request unsuccessful\"}";
        }
    }
}