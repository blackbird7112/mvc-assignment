<?php

namespace Models;
session_start();


class Admin{
    public static function login($usr,$passhash){
        $db = \DB::get_instance();
        $sql = $db->prepare("select * from admin where usr = ?;");
        $sql->execute([$usr]);
        $row = $sql->fetch();
        if($row["pass"]==$passhash){
            return true;
        }
        else{
            return false;
        }
    }
    public static function user_dets($usr){
        $db = \DB::get_instance();
        $sql = $db->prepare("select * from users where usr = ?;");
        $sql->execute([$usr]);
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
        }else{
            return true;
        }
    }
    public static function book_del($bid){
        $db = \DB::get_instance();
        $sql = $db->prepare("select * from book where bid = ?;");
        $sql->execute([$bid]);
        if($sql->rowCount()){
            $sql1 = $db->prepare("delete from book where bid = ?;");
            $sql1->execute([$bid]);
            if($sql1->rowCount()){
                $sql2 = $db->prepare("delete from request where bid= ? and status='P';");
                $sql2->execute([$bid]);
                if($sql2->rowCount()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }

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
            $usr = $row["usr"];
            $bid = $row["bid"];
            $reqtype = $row["reqtype"];
            if($reqtype == "out"){
                $sql1 = $db->prepare("select * from book where bid= ? and avail>0;");
                $sql1->execute([$bid]);
                if($sql1->rowCount()){
                    $row1 = $sql1->fetch();
                    $prevUser = $row1["users"];
                    $prevUser1 = explode(";",$prevUser);
                    if(in_array($usr,$prevUser1)){
                        $action = "D";
                    }
                    $avail = (int) $row1["avail"];
                    $sql2 = $db->prepare("update request set status= ? where reqid= ?;");
                    $sql2 -> execute([$action,$reqid]);
                    if($sql2->rowCount()){
                        if($action=="A"){
                            $avail -= 1;
                            array_push($prevUser1,$usr);
                            $prevUser2 = implode(";",$prevUser1);
                            $sql3 = $db -> prepare("update book set avail= ?,users = ? where bid= ?;");
                            $sql3->execute([$avail,$prevUser2,$bid]);
                            if($sql3->rowCount()){
                                return true;
                            }else{
                                return false;
                            }
                        }
                        else if($action=="D"){
                            return true;
                        }
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }
            if($reqtype=="in"){
                $sql1 = $db->prepare("select * from book where bid= ?;");
                $sql1->execute([$bid]);
                if($sql1->rowCount()){
                    $row1 = $sql1->fetch();
                    $prevUser = $row1["users"];
                    $prevUser = explode(";",$prevUser);
                    if(!in_array($usr,$prevUser)){
                        $action = "D";
                    }
                    $avail = (int) $row1["avail"];
                    $sql2 = $db->prepare("update request set status= ? where reqid= ?;");
                    $sql2 -> execute([$action,$reqid]);
                    if($sql2->rowCount()>0){
                        if($action == "A"){
                            $key = array_search($usr,$prevUser);
                            unset($prevUser[$key]);
                            $prevUser = implode(";",$prevUser);
                            $avail += 1;
                            $sql3 = $db -> prepare("update book set avail= ?,users = ? where bid= ?;");
                            $sql3->execute([$avail,$prevUser,$bid]);
                            if($sql3->rowCount()){
                                return true;
                            }else{
                                return false;
                            }
                        }else if($action == "D"){
                            return true;
                        }
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
    }

}