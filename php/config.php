<?php 
 
 $con = mysqli_connect("localhost","root","","petanipintar_db") or die("Couldn't connect");
 if (!defined('API_KEY')) {
        define('API_KEY', '');
    }
    
?>