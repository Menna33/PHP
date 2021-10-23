<?php 
require './classes/dbclass.php';
class Blog
{
private $title;
private $content;
private $image;

/*public function __construct($val1,$val2,$val3){

    $this->title     = $val1;
    $this->content    = $val2;
    $this->image = $val3;   

}*/

public function create(){
 # Create Db Obj 
 $dbObj = new DataBase;

 $sql = "insert into articales (title,content,image) values ('$this->title','$this->content','$this->image')";

 $result = $dbObj->DoQuery($sql);
 
 return $result;
}

public function delete($id){
    # Create Db Obj 
    $dbObj = new DataBase;
   
    $sql = "delete from articales where id=$id";
   
    $result = $dbObj->DoQuery($sql);
    
    return $result;
   }
   

 public function update($id,$title,$content,$image){
    # Create Db Obj 
    $dbObj = new DataBase;
    $sql = "update articales set title = '$title',content='$content',image='$image' where id = $id";
   
    $result = $dbObj->DoQuery($sql);
    
    return $result;
   }
   
public function read(){
    # Create Db Obj 
    $dbObj = new DataBase;
   
    $sql = "select * from articales";
   
    $result = $dbObj->DoQuery($sql);
    
    return $result;
   }
   public function readById($id)
   {
    $dbObj = new DataBase;
   
    $sql = "select * from articales where id=$id";
   
    $result = $dbObj->DoQuery($sql);
    
    return $result; 
   }
   
}
?>