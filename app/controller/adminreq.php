<?php

namespace Controller;
session_start();

class AdminReq{
    public function get(){
        if($_SESSION["admin"]==null){
            header("Location: /illegal");
        }else{
            echo \View\Loader::make()->render("templates/adminreq.twig",array(
                requests => \Models\Admin::get_req()
            ));
        }
    }
    public function post(){
        $data = json_decode(file_get_contents('php://input'), true);
        $reqid = $data["reqid"];
        $action = $data["action"];
        if(\Models\Admin::admin_req($reqid,$action)){
            echo "{\"status\":\"Request processed successful\"}";
        }else{
            echo "{\"status\":\"Request has failed\"}";
        }
    }
}