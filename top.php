<?php
include "lib/constants.php";
?>
<head>
    <title>Longboard Base</title>
    <link href="https://csandvik.w3.uvm.edu/lbbase/newstyle.css" type="text/css" rel="stylesheet" media="screen" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:500' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://csandvik.w3.uvm.edu/lbbase/print.css" type="text/css" media="print" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" 
          type="image/ico" 
          href="https://csandvik.w3.uvm.edu/lbbase/favicon.ico">
    <meta charset="UTF-8">
    <meta name="description" content="A general source of information for
          all things longboarding related including a gear database,
          hill finder, guides, etc.">
    <meta name="author" content="Christopher Sandvik">
    <?php
    
    $includeDBPath = "bin/";
        $includeLibPath = "lib/";
        
        
        //require_once($includeLibPath . 'mailMessage.php');

       // require_once('lib/security.php');
        
        require_once($includeDBPath . 'Database.php');
    
    
    $host = 'https://csandvik.w3.uvm.edu/lbbase';
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// PATH SETUP
//
//  $domain = "https://www.uvm.edu" or http://www.uvm.edu;
    $domain = "http://";
    if (isset($_SERVER['HTTPS'])) {
        if ($_SERVER['HTTPS']) {
            $domain = "https://";
        }
    }

    $server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, "UTF-8");

    $domain .= $server;

    $phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");

    $path_parts = pathinfo($phpSelf);
    if ($path_parts['filename'] == "form") {
        include "lib/validation-functions.php";
        include "lib/mail-message.php";
        include "lib/securityForm.php";
    }
    if ($path_parts['filename'] == "newForm") {
        include "lib/validation-functions.php";
        include "lib/mail-message.php";
        include "lib/securityForm.php";
    }

    if ($debug) {
        print "<p>Domain" . $domain;
        print "<p>php Self" . $phpSelf;
        print "<p>Path Parts<pre>";
        print_r($path_parts);
        print "</pre>";
    }
    
    // Set up database connection
        //
        
        $dbUserName = get_current_user() . '_reader';
        $whichPass = "r"; //flag for which one to use.
        $dbName = DATABASE_NAME;

        $thisDatabaseReader = new Database($dbUserName, $whichPass, $dbName);
        
        $dbUserName = get_current_user() . '_writer';
        $whichPass = "w";
        $thisDatabaseWriter = new Database($dbUserName, $whichPass, $dbName);
        
        $dbUserName = get_current_user() . '_admin';
        $whichPass = "a";
        $thisDatabaseAdmin = new Database($dbUserName, $whichPass, $dbName);
        ?>	

</head>

