<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script>
    if(location.hostname != "localhost"){
        if(location.protocol != "https:"){
            const httpsURL = 'https://' + location.href.split('//')[1]
            location.replace(httpsURL)
        }
    }
    </script> 
  
    <link rel="dns-prefetch" href="//in.hotjar.com" />
    <link rel="dns-prefetch" href="//script.hotjar.com" />
    <link rel="dns-prefetch" href="//vars.hotjar.com" />
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>

    

    
  
    <!--<link rel="canonical" href="https://romanoapp.herokuapp.com/"/>-->
    <!-- https://www.w3schools.com/icons/icons_reference.asp -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="assets/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="assets/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon-16x16.png">
    <link rel="manifest" href="assets/manifest.json">
    <meta name="msapplication-TileColor" content="#f0f0f0">
    <meta name="msapplication-TileImage" content="assets/ms-icon-144x144.png">
    <meta name="theme-color" content="#f0f0f0">
    <meta name="description" content="Um aplicativo quiz com QRcode">
    <title>Quiz App</title>
</head>
<body> 
