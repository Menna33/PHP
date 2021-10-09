<?php 
session_start();
echo 'Name: '.$_SESSION['name'].'<br>';
echo 'Email: '.$_SESSION['mail'].'<br>';
echo 'Password: '.$_SESSION['password'].'<br>';
echo 'Address: '.$_SESSION['address'].'<br>';
echo 'LinkedIn Url: '.$_SESSION['linkedinurl'].'<br>';
echo 'Gender: '.$_SESSION['gender'].'<br>';
?>