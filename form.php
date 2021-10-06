<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Register</h2>
  <form  action="<?php echo $_SERVER['PHP_SELF'];?>"   method="post"   enctype ="multipart/form-data">

  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text"  name="name"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Name">
  </div>


  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email"   name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password"   name = "password"  class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
 
  <div class="form-group">
    <label for="exampleInputEmail1">Address</label>
    <input type="text"  name="address"  class="form-control" id="exampleInputAddress" aria-describedby="" placeholder="Enter Address">
  </div>
  Gender
  <div>
  <label class="container">Male
  <input type="radio"  name="radio">
  <span class="checkmark"></span>
</label>
<label class="container">Female
  <input type="radio" name="radio">
  <span class="checkmark"></span>
</label>
</div>

<div class="form-group">
    <label for="exampleInputEmail1">LinkedIN url</label>
    <input type="text"  name="linkedinurl"  class="form-control" id="exampleInputurl" aria-describedby="" placeholder="Enter LinkedIn url">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

</body>
</html>
<?php

function clean($input){ 

$input = stripslashes($input);
$input = htmlspecialchars($input);
$input = trim($input);

return $input;

}




if($_SERVER['REQUEST_METHOD'] == "POST"){

$name     =  clean($_POST['name']); 
$password =  clean($_POST['password']);
$email    =  clean($_POST['email']);
$address= clean($_POST['address']);
$gender=  $_POST['radio'];
$linkedinurl= clean($_POST['linkedinurl']);

$errors = [];

if(empty($name)){
$errors['Name'] = "Field Required";
}elseif(!filter_var($name,FILTER_VALIDATE_STRING)){
    $errors['Name'] = "Invalid Name";
}

# Password Validation ... 
if(empty($password)){
 $errors['Password'] = "Field Required";
}elseif(strlen($password)<6){
    $errors['Password'] = "The password should be at least 6 characters";
}

# Email Validation ... 
if(empty($email)){
 $errors['Email'] = "Field Required";
}elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
 $errors['Email'] = "Invalid Email";
}

# Address Validation ... 
if(empty($address)){
    $errors['address'] = "Field Required";
   }elseif(strlen($password)!=10){
       $errors['address'] = "The address should be 10 characters";
   }
# Gender Validation ... 
if(empty($gender)){
    $errors['gender'] = "Field Required";
}

# LinkedInUrl Validation ... 
if(empty($linkedinurl)){
    $errors['linkedinurl'] = "Field Required";
   }elseif(!filter_var($linkedinurl,FILTER_VALIDATE_URL)){
    $errors['linkedinurl'] = "Invalid URL";
   }


if(count($errors) > 0){
 foreach($errors as $key => $val ){
     echo '* '.$key.' :  '.$val.'<br>';
 }
}else{
 echo 'Valid Data';
}
}

?>