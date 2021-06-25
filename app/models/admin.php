<?php

namespace Models;
session_start();


class Admin{
    public static function login($user,$passhash){
        $db = \DB::get_instance();
        $sql = $db->prepare("select * from admin where usr = ?;");
        $sql->execute([$user]);
        $row = $sql->fetch();
        if($row["pass"]==$passhash){
            return true;
        }
        else{
            return false;
        }
    }
    public static function user_dets($user){
        $db = \DB::get_instance();
        $sql = $db->prepare("select * from users where usr = ?;");
        $sql->execute([$user]);
        $row = $sql->fetch();
        if($sql->rowCount()==0){
            return false;
        }
        else{
            return $row;
        }
    }
    public static function get_books(){
        $db = \DB::get_instance();
        $sql = $db->prepare("select * from book;");
        $sql->execute();
        $rows = $sql->fetchAll();
        return $rows;
    }
    public static function book_reg($name,$author,$publisher,$maxqty){
        $db = \DB::get_instance();
        $sql = $db->prepare("insert into book (name,author,publisher,maxqty,avail,users) values (?,?,?,?,?,?);");
        $sql->execute([$name,$author,$publisher,$maxqty,$maxqty,""]);
        if($sql->rowCount()==0){
            return false;
        }
        return true;
    }
    public static function book_del($bookid){
        $db = \DB::get_instance();
        $sql = $db->prepare("select * from book where bid = ?;");
        $sql->execute([$bookid]);
        if($sql->rowCount()){
            $sql1 = $db->prepare("delete from book where bid = ?;");
            $sql1->execute([$bookid]);
            if($sql1->rowCount()){
                $sql2 = $db->prepare("delete from request where bid= ? and status='P';");
                $sql2->execute([$bookid]);
                if($sql2->rowCount()){
                    return true;
                }
            }
        }
        return false;

    }
    public static function get_req(){
        $db = \DB::get_instance();
        $sql = $db->prepare("select * from request where status = 'P'");
        $sql->execute();
        return $sql->fetchAll();
    }

    public static function admin_req($reqid,$action){
    $db = \DB::get_instance();
    $sql = $db->prepare("select * from request where reqid = ? and status = 'P'");
    $sql->execute([$reqid]);
    if($sql->rowCount()){
        $row = $sql->fetch();
        $user = $row["usr"];
        $bookid = $row["bid"];
        $reqtype = $row["reqtype"];
        
        $condition = $reqtype == "out";
        
        if($reqtype!="in" && $reqtype!="out"){
            return false;
        }

        $sql1 = $db->prepare("select * from book where bid= ?;");
        $sql1->execute([$bookid]);
        
        if($sql1->rowCount()){
            $row1 = $sql1->fetch();
            $prevUser = $row1["users"];
            $prevUser1 = explode(";",$prevUser);
            $avail = (int) $row1["avail"];

            if($condition && (in_array($user,$prevUser1) || $avail==0)){
                $action = "D";
            }
            if(!$condition && !in_array($user,$prevUser1)){
                $action = "D";
            }
            $sql2 = $db->prepare("update request set status= ? where reqid= ?;");
            $sql2 -> execute([$action,$reqid]);
            if($sql2->rowCount()){
                if($condition && $action == "A"){
                    $avail -= 1;
                    array_push($prevUser1,$user);
                    $prevUser1 = implode(";",$prevUser1);
                    
                } else if(!$condition && $action == "A"){
                    $key = array_search($user,$prevUser1);
                    unset($prevUser1[$key]);
                    $prevUser1 = implode(";",$prevUser1);
                    $avail += 1;  
                }
                if($action == "A"){
                    $sql3 = $db -> prepare("update book set avail= ?,users = ? where bid= ?;");
                    $sql3->execute([$avail,$prevUser1,$bookid]);
                    if($sql3->rowCount()){
                        return true;
                    }
                }
                if($action == "D"){
                    return true;
                }

            }
        }
    }
    return false;
    }
}