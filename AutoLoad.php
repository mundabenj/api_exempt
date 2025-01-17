<?php
session_start();
require "includes/constants.php";
require "includes/dbConnection.php";
require "lang/en.php";

// Class Auto Load
function classAutoLoad($classname){

    $directories = ["contents", "layouts", "menus", "forms", "processes", "global", "tables"];

    foreach($directories AS $dir){
        $filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $classname . ".php";
        if(file_exists($filename) AND is_readable($filename)){
            require_once $filename;
        }
    }
}

    spl_autoload_register('classAutoLoad');

    $ObjGlob = new fncs();
    $ObjSendMail = new SendMail();

// Create instances of all classes
    $ObjLayouts = new layouts();
    $ObjMenus = new menus();
    $ObjHeadings = new headings();
    $ObjCont = new contents();
    $ObjForm = new user_forms();
    $ObjTable = new fetch_lists();
    $conn = new dbConnection(DBTYPE, HOSTNAME, DBPORT, HOSTUSER, HOSTPASS, DBNAME);

// Create process instances

    $ObjAuth = new auth();
    $ObjAuth->signup($conn, $ObjGlob, $ObjSendMail, $lang, $conf);
    $ObjAuth->verify_code($conn, $ObjGlob, $ObjSendMail, $lang, $conf);
    $ObjAuth->set_passphrase($conn, $ObjGlob, $ObjSendMail, $lang, $conf);
    $ObjAuth->signin($conn, $ObjGlob, $ObjSendMail, $lang, $conf);
    $ObjAuth->signout($conn, $ObjGlob, $ObjSendMail, $lang, $conf);
    $ObjAuth->save_details($conn, $ObjGlob, $ObjSendMail, $lang, $conf);
