<?php
require 'config.php';
if ($_POST){
    $title=$_POST['title'];
    $description=$_POST['description'];
    $sql="INSERT INTO todo (title, description) VALUES (:title, :description)";
    $stmt=$pdo->prepare($sql);
    $result=$stmt->execute(['title'=>$title, 'description'=>$description]); 
    if ($result){
        echo "<script>alert('Task added successfully!'); window.location.href='index.php';</script>";
        
    } else {
        echo "<script>alert('Failed to add task.'); window.location.href='index.php';</script>";
    }
  

    
}

?>
