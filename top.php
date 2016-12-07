<?php
include "lib/constants.php";
?>
<head>
    <title>Longboard Base</title>
    <link href="https://csandvik.w3.uvm.edu/lbbase/styles/style.min.css" type="text/css" rel="stylesheet" media="screen" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:500' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:600' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bungee" rel="stylesheet">
    <link rel="stylesheet" href="https://csandvik.w3.uvm.edu/lbbase/styles/print.css" type="text/css" media="print" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon"
          type="image/ico"
          href="https://csandvik.w3.uvm.edu/lbbase/favicon.ico">
    <meta charset="UTF-8">
    <meta name="description" content="A general source of information for
          all things longboarding related including a gear database,
          hill finder, guides, etc.">
    <meta name="author" content="Christopher Sandvik">

    <!-- <script src="bower_components/webcomponentsjs/webcomponents-lite.js"></script>
    <link rel="import" href="test-element.php">
    <link rel="import" href="flip-card.php">
    <link rel="import" href="polymer/polymer.html">
    <link rel="import" href="bower_components/iron-scroll-threshold/iron-scroll-threshold.html">
    <link rel="import" href="bower_components/paper-button/paper-button.html">
    <link rel="import" href="bower_components/paper-input/paper-input.html">
    <link rel="import" href="bower_components/iron-form/iron-form.html">
    <link rel="import" href="bower_components/iron-dropdown/iron-dropdown.html">
    <link rel="import" href="bower_components/iron-label/iron-label.html">
    <link rel="import" href="bower_components/iron-overlay-behavior/iron-overlay-behavior.html">
    <link rel="import" href="bower_components/neon-animation/neon-animation-runner-behavior.html">
    <link rel="import" href="bower_components/promise-polyfill/promise-polyfill-lite.html">
    <link rel="import" href="bower_components/iron-input/iron-input.html">
    <link rel="import" href="bower_components/iron-fit-behavior/iron-fit-behavior.html">
    <link rel="import" href="bower_components/iron-meta/iron-meta.html">
    <link rel="import" href="bower_components/font-roboto/roboto.html">
    <link rel="import" href="bower_components/paper-dropdown-menu/paper-dropdown-menu.html">
    <link rel="import" href="bower_components/paper-listbox/paper-listbox.html">
    <link rel="import" href="bower_components/paper-item/paper-item.html"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/masonry.pkgd.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script>
        $(document).ready(function () {
            setContainerWidth();
        });

        $(window).resize(function () {
            setContainerWidth();
        });

        function setContainerWidth()
        {
            //deck database centering
            $('#decksBody .decks').css('width', 'auto'); //reset
            var windowWidth = $('#decksBody .background').width();
            var blockWidth = $('#decksBody .gallery').outerWidth(true);
            var maxBoxPerRow = Math.floor(windowWidth / blockWidth);
            $('#decksBody .decks').width(maxBoxPerRow * blockWidth);
            //homepage recentering
            $('#home .decks').css('width', 'auto'); //reset
            var windowWidth = $('#home .background').width();
            var blockWidth = $('#home .gallery').outerWidth(true);
            var maxBoxPerRow = Math.floor(windowWidth / blockWidth);
            $('#home .decks').width(maxBoxPerRow * blockWidth);
        }
    </script>


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
