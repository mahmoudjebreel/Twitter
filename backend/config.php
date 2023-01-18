<?php
    define("DB_HOST", "localhost");
    define("DB_NAME", "twitter");
    define("DB_USER", "root");
    define("DB_PASS", "");

    // Output => Get URL Path 
    $public_end = strpos($_SERVER['SCRIPT_NAME'], "/frontend") + 8;
    $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
    define("WWW_ROOT", $doc_root);
    // echo WWW_ROOT;


?>