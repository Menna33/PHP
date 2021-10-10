<?php 

function clean($input){
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    $input = trim($input);
    return $input;
}
 
function validate($input,$flag,$length = 6){
   
    $status = true;

    switch ($flag) {
        case 1:
            # code...
            if(empty($input)){
                $status = false;
            }
            break;

        case 2: 
            # code ... 
             if(filter_var($input,FILTER_VALIDATE_INT)){
                $status = false;
             }
            break;
        
        case 3: 
            #code ... 
            if(strlen($input) <= 50){
                $status = false;
            }    
            break;
    }
    return $status;

}






?>