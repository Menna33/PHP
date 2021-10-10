<?php  

require './helpers/dbConnection.php';
require './helpers/validator.php';


if($_SERVER['REQUEST_METHOD'] == "POST"){

$title     =  clean($_POST['title']); 
$content   =  clean($_POST['content']);
$insert_img="";



   $errors = [];
#Title validation
  if(!validate($title,1)){
     $errors['title'] = "Field Required";
  }
  if(!validate($title,2)){
    $errors['title'] = "Title must be string";
 }

#Content validation

    if(!validate($content,1)){
      $errors['content'] = "Field Required";
  }elseif(!validate($content,3)){
      $errors['content'] = "The Content must be longer than 50 char";
  }
#Image Validation
if(!empty($_FILES['image']['name'])){

    $ImageTmp   =  $_FILES['image']['tmp_name'];
    $ImageName  =  $_FILES['image']['name'];
    $ImageSize  =  $_FILES['image']['size'];
    $ImageType  =  $_FILES['image']['type'];    //      image/png
    echo "mmmmmmmmmm".$ImageType;
    
     $allowdEx  = ['png','jpg'];

     $TypeArray = explode('/',$ImageType);

      if(in_array($TypeArray[1],$allowdEx)){
         // code 
      $FinalName = rand(1,100).time().'.'.$TypeArray[1];

      $disPath = './uploads/'.$FinalName;

        if(move_uploaded_file($ImageTmp,$disPath)){
            echo 'File Uploaded';
            $insert_img="insert into articals (ImgName) values ('$FinalName')";
        }else{
            echo 'Error Try Again';
            $insert_img="";
        }         

      }else{
          echo 'Not Allowed Extension';
          $insert_img="";
      }

    }else{

         echo 'Image Required';
         $insert_img="";

     }

  
  if(count($errors) > 0){
      foreach($errors as $key => $val ){
          echo '* '.$key.' :  '.$val.'<br>';
      }}
     
  else{
      
     // db code .... 

     $sql = "insert into articals (title,content) values ('$title','$content')";

     $op  =  mysqli_query($con,$sql);
     $op1  =  mysqli_query($con,$insert_img); //for inserting img

     if($op){
         echo 'Data Inserted';
     }else{
         echo 'Error in DB Try Again';
     }

     if($op1){
        echo 'Image Inserted';
    }else{
        echo 'Error in DB Try Again';
    }
     # close connection ... 
     mysqli_close($con);

     }
    }



?>




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
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">



            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" name="title" class="form-control" id="exampleInputName" aria-describedby=""
                    placeholder="Enter Title">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail1">content</label>
                <input type="text" name="content" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Enter content">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Image</label>
                <input type="file" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>