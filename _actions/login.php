<?php

session_start();
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;
use Helpers\Auth;

$table= new UsersTable(new MySQL);

$email= $_POST['email'];
$conPassword=$_POST['password'];

$user= $table->findByEmailAndPassword($email, $conPassword);
// password methods might have something wrong.
if($user){
    if($user->suspended){
        HTTP::redirect("/index.php", "suspended=1");
    }
    $_SESSION['user']= $user;
    HTTP:: redirect("/profile.php");
}
else {
    HTTP::redirect("/index.php", "incorrect=1");
}
