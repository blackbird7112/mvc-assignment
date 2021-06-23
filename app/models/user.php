<?php

namespace Models;
session_start();


class User{
    
    public static function login($usr,$passhash){
        $db = \DB::get_instance();
        $sql = $db->prepare("select * from users where usr = ?;");
        $sql->execute([$usr]);
        $row = $sql->fetch();
        if($row["pass"]==$passhash){
            return true;
        }
        else{
            return false;
        }
    }
    public static function get_checkout($usr){
        $db = \DB::get_instance();
        $sql = $db->prepare("select * from book;");
        $sql->execute([$usr]);
        $rows = $sql->fetchall();
        $senddat = array();
        foreach($rows as $row){
            $users = explode(";",$row["users"]);
            if(in_array($usr,$users)){
                array_push($senddat,$row);
            }
        }
        return $senddat; 
    }

    public static function get_pendreq($usr){
        $db = \DB::get_instance();
        $sql = $db->prepare("select * from request where usr= ? and status='P';");
        $sql->execute([$usr]);
        $rows = $sql->fetchall();
        return $rows; 
    }

    public static function set_req($usr,$bid,$type,$dt)
    {
        $db = \DB::get_instance();
        $sql = $db->prepare("insert into request (usr,bid,reqtype,dt,status) values (?,?,?,?,?);");
        $sql->execute([$usr,$bid,$type,$dt,'P']);
        
        if($sql->rowCount()){
           return true; 
        }else{
            return false;
        }
    }
    public static function get_books(){
        $db = \DB::get_instance();
        $sql = $db->prepare("select * from book;");
        $sql->execute();
        $rows = $sql->fetchall();
        return $rows; 
    }

    public static function user_reg($usr,$name,$email,$phone,$pass){
        $db = \DB::get_instance();

        $sql = $db->prepare("select * from users where usr = ?;");
        $sql->execute([$usr]);
        
        if($sql->rowCount()==0){
            $sql1 = $db->prepare("insert into users (usr,name,email,phone,pass) values (?,?,?,?,?);");
            $sql1->execute([$usr,$name,$email,$phone,$pass]);
            if($sql1->rowCount()==1){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}