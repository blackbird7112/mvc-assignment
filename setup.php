<?php


function sql_start($admin,$pass){
    include "./config/config.php";

    $db = new PDO(
        "mysql:host=".$DB_HOST.";port=".$DB_PORT.";dbname=".$DB_NAME,
        $DB_USERNAME,
        $DB_PASSWORD
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $db->exec("use ".$DB_NAME);

    $sql = file_get_contents("./schema/schema.sql");
    $db->exec($sql);

    $sql1 = $db->prepare("insert into admin (usr,pass) values (?,?);");
    $sql1->execute([$admin,$pass]);
}

$longopt = array("admin::","pass::");

$val = getopt(null,$longopt);
$admin = null;
$pass = null;
if(!isset($val["admin"]) || preg_match("/^[a-zA-Z0-9]+$/",$admin)){
    $admin="admin1";
    echo "Since a valid name has not been entered the default admin id is admin1\n";
}else{
    $admin = $val["admin"];
}
if(!isset($val["pass"])){
    $pass="12345";
    echo "Since a password has not been entered the default password is 12345\n";
}else{
    $pass = $val["pass"];
}

$pass1 = hash("sha256",$pass);
sql_start($admin,$pass1);