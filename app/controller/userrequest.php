<?php

namespace Controller;
session_start();

class UserRequest{
    public function post(){
        $data = json_decode(file_get_contents('php://input'), true);
        $bid = $data['bid'];
        $type = $data['type'];
        $usr = $_SESSION['user'];
        $dt = date("Y-m-d h:i:sa");
        $res = \Models\User::set_req($usr,$bid,$type,$dt);
        if(res){
            echo "{\"status\":\"Request successful\"}";
        }
        else{
            echo "{\"status\":\"Request unsuccessful\"}";
        }
    }
}