<?php
////function to print the next character of the specific character//////
function charIncrement($char) {
 $next_char=++$char;
 if (strlen($next_char) > 1) { 
    $next_char = $next_char[0];
   }
 echo $next_char;
 echo '<br>';
}

charIncrement('a'); // call the function with 'a' character
charIncrement('z'); // call the function with 'z' character

//print the values using echo function
$students = [
    ['name' => 'Root','age' => 20] , 
    ['name' => 'Root2','age' => 25,'gpa' => 3.4] ,
    ['name' => 'Root3','age' => 30]
];

for($i=0;$i<3;$i++)
{
        echo 'Name is : ';
        echo $students[$i]['name'];
        echo '<br>';
        echo 'Age is : ';
        echo $students[$i]['age'];
        echo '<br>';
        if (array_key_exists('gpa',$students[$i]))
        {
            echo 'GPA is : ';
            echo $students[$i]['gpa'];
            echo '<br>';
        }
        
        

  
}


?>