<?php 

echo "I am here";
if(isset($_POST['submit'])){
    $file = $_FILES['material_file'];
    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_error = $file['error'];
    $file_size = $file['size'];
    $file_type = $file['type'];

    if($file_error === 0){
        $new_file_name = uniqid('', true) . "." . strtolower(end(explode('.' , $file_name)));
        $destination = "../files/". $new_file_name ;
        move_uploaded_file($file_tmp_name, $destination);
        echo "here"; 
        header("Location: ../academic/material.php");
    }else{
        echo "Something Went Wrong";        
    }
    
}

?>