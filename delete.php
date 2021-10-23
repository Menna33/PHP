<?php 

require './classes/validator.php';
require './classes/blogClass.php';



# Fetch id .... 
$id = $_GET['id'];
$validate = new validator;

# Validate Id ... 

 if($validate->validate($id,5)){
  # code 
  $blog = new blog;
  $blog->delete($id);

 }else{

       $message =  'invalid id';
 }

    $_SESSION['Message'] = $message;
    header("Location: display.php");



?>