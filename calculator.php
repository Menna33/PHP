<?php
$num1=10;
$num2=5;
//to try specific operation comment all other and uncomment it
$operation="addition";
//$operation="subtraction";
//$operation="multiplication";
//$operation="division";

switch($operation)
{
    case "addition":
        $sum=$num1+$num2;
        echo "The addition result is: ";
        echo $sum;
        break;

    case "subtraction":
        $sub=$num1-$num2;
        echo "The subtraction result is: ";
        echo $sub;
        break;

    case "multiplication":
        $res=$num1*$num2;
        echo "The multiplication result is: ";
        echo $res;
        break;

    case "division":
        $res=$num1/$num2;
        echo "The division result is: ";
        echo $res;
        break;
    default:
    break;
    
}
/*$sum=$num1+$num2;
echo $sum;
//subtraction
$sub=$num1-$num2;
echo $sub;
//multiplication
$sub=$num1*$num2;
echo $sub;
//division
$sub=$num1/$num2;
echo $sub;*/


?>
