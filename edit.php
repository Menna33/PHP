
 <?php  

require './classes/blogClass.php';
require './classes/validator.php';
$blog=new blog;
$data=$blog->read();
$validate = new validator;


# Fetch id .... 
$id = $_GET['id'];


# Validate Id ... 
 if($validate->validate($id,5)){
  # code 
   $blog_data = mysqli_fetch_assoc($blog->readById($id));

 }else{

       $message =  'invalid id';
       $_SESSION['Message'] = $message;
       header("Location: display.php");
 }

if($_SERVER['REQUEST_METHOD'] == "POST"){

$title       =  $validate->clean($_POST['title']); 
$content      =  $validate->clean($_POST['content']); 
$insert_img="";
      
          # Image Validation
          if($validate->validate($_FILES['image']['name'],1)){

            # Image Details ..... 
            $ImageTmp   =  $_FILES['image']['tmp_name'];
            $ImageName  =  $_FILES['image']['name'];
            $ImageSize  =  $_FILES['image']['size'];
            $ImageType  =  $_FILES['image']['type']; 
            $TypeArray = explode('/',$ImageType);
        
        
        
                    
                       if(!$validate->validate($ImageName,1)){
                        $errors['image'] = "Image Field Required";
                        }elseif(!$validate->validate( $TypeArray[1],6)){
                        $errors['image'] = "Invalid Extension";
                        }
        
                    }
        
        
           if(count($errors) > 0){
               $_SESSION['Message'] = $errors;
           }else{
        
        
            if($validate->validate($_FILES['image']['name'],1)){
                    
                $FinalName = rand(1,100).time().'.'.$TypeArray[1];
         
                $disPath = './uploads/'.$FinalName;
        
                if(move_uploaded_file($ImageTmp,$disPath)){  unlink('./uploads/'.$_POST['oldImage']); }
        
             }else{
             
                 $FinalName = $_POST['oldImage'];
             
             }
   $errors = [];


  if(count($errors) > 0){
      foreach($errors as $key => $val ){
          echo '* '.$key.' :  '.$val.'<br>';
      }
  }else{
      
     // db code .... 

     $blog->update($id,$title,$content,$FinalName);

     
     if($op){
        header("Location: display.php");

     }else{
         echo 'Error Try Again';
     }
     # close connection ... 
     mysqli_close($con);

     }
}
}

// CRUD   C >>> Create 

?>




<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Edit</h2>
        <form action="edit.php?id=<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">


 
        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputName"
                                aria-describedby="" placeholder="Enter Title" value="<?php echo $blog_data['title'];?>">
                        </div>


                   

                        <div class="form-group">
                            <label for="exampleInputPassword1">Content</label>
                            <textarea name="content" class="form-control" > <?php echo $blog_data['content'];?> </textarea>
                        </div>

            
                        <div class="form-group">
                            <label for="exampleInputEmail1">Image </label>
                            <input type="file" name="image">
                            <br> 

                            <img src="./uploads/<?php echo $blog_data['image'];?>" width="50 px">
                        </div>

                          <input type="hidden" value="<?php echo $blog_data['image'];?>"  name="oldImage" >






                        <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

</body>

</html>
