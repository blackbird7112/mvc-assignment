<?php

require __DIR__."/../vendor/autoload.php";

Toro::serve(array(
    "/" => "\Controller\Home",
    "/usersignup" => "\Controller\UserSignUp",
    "/userlog" => "\Controller\UserLog",
    "/userhome" => "\Controller\UserHome",
    "/userrequest" => "\Controller\UserRequest",
    "userbook" => "\Controller\UserBook",
    "userbooksearch" => "\Controller\UserBookSearch",
    "/adminlog" => "\Controller\AdminLog",
    "/adminhome" => "\Controller\AdminHome",
    "/userdets" => "\Controller\UserDets",
    "/adminbook" => "\Controller\AdminBook",
    "/bookreg" => "\Controller\BookReg",
    "/bookdel" => "\Controller\BookDel",
    "/adminreq" => "\Controller\AdminReq",
    "/illegal" => "\Controller\IllegalAccess"
));
