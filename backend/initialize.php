<?php

// To Start Connection 
ob_start();

// This function returns the default timezone
date_default_timezone_set('Africa/Cairo');

require_once 'config.php';

spl_autoload_register(function($class){
    require_once "classes/{$class}.php";
});

session_start();

// $db = new Database;
$account = new Account;

include_once 'functions.php';

