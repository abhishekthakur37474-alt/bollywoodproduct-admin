<?php 


ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include "config.php";
 
include "mailer-sender.php"; 


sendEmail("iwebstechnology@gmail.com", "Copy: Test message", "Copy: Test message", "Copy: Test message");	