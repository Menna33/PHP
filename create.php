
 <?php  

require './classes/validator.php';
require './classes/blogClass.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){

  # Create Validator Obj .. 
  $validate = new validator;

 $title       =  $validate->clean($_POST['title']); 
 $content   =  $validate->clean($_POST['content']);
 $insert_img="";
 $errors = [];

 if(!$validate->validate($title,1)){
     $errors['Title'] = "Field Required";
 }

   # content Validation ... 
 if(!$validate->validate($content,1)){
     $errors['Content'] = "Field Required";
 }elseif(!$validate->validate($content,3) ){
     $errors['Content'] = "Content Length Must >= 50 ch";
 }

 #Image Validation
 if(!$validate->validate($_FILES['image']['name'],1)){

    $ImageTmp   =  $_FILES['image']['tmp_name'];
    $ImageName  =  $_FILES['image']['name'];
    $ImageSize  =  $_FILES['image']['size'];
    $ImageType  =  $_FILES['image']['type'];    //      image/png
    
     $TypeArray = explode('/',$ImageType);
   if(!$validate->validate($TypeArray[1],6)){
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
     }
 }else{

      // db Logic ... 

      $blog = new blog($title,$content,$FinalName);

      $reuslt = $blog->create();

      if($reuslt){
          echo 'data inserted';
      }else{
          echo 'error try again';
      }
 
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
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>