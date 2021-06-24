<?php

namespace Models;
session_start();


class User{
    
    public static function login($user,$passhash){
        $db = \DB::get_instance();
        $sql = $db->prepare("select * from users where usr = ?;");
        $sql->execute([$user]);
        $row = $sql->fetch();
        if($row["pass"]==$passhash){
            return true;
        }
        return false;
    }
    public static function get_checkout($user){
        $db = \DB::get_instance();
        $sql = $db->prepare("select * from book;");
        $sql->execute([$user]);
        $rows = $sql->fetchall();
        $senddat = array();
        foreach($rows as $row){
            $users = explode(";",$row["users"]);
            if(in_array($user,$users)){
                array_push($senddat,$row);
            }
        }
        return $senddat; 
    }

    public static function get_pendreq($user){
        $db = \DB::get_instance();
        $sql = $db->prepare("select * from request where usr= ? and status='P';");
        $sql->execute([$user]);
        $rows = $sql->fetchall();
        return $rows; 
    }

    public static function set_req($user,$bookid,$type,$datetime)
    {
        $db = \DB::get_instance();
        $sql = $db->prepare("insert into request (usr,bid,reqtype,dt,status) values (?,?,?,?,?);");
        $sql->execute([$user,$bookid,$type,$datetime,'P']);        
        if($sql->rowCount()){
           return true; 
        }
        return false;
    }
    public static function get_books(){
        $db = \DB::get_instance();
        $sql = $db->prepare("select * from book;");
        $sql->execute();
        $rows = $sql->fetchall();
        return $rows; 
    }

    public static function user_reg($user,$name,$email,$phone,$pass){
        $db = \DB::get_instance();

        $sql = $db->prepare("select * from users where usr = ?;");
        $sql->execute([$user]);
        
        if($sql->rowCount()==0){
            $sql1 = $db->prepare("insert into users (usr,name,email,phone,pass) values (?,?,?,?,?);");
            $sql1->execute([$user,$name,$email,$phone,$pass]);
            if($sql1->rowCount()==1){
                return true;
            }
        }
        return false;
    }
}