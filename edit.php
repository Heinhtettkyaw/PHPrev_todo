<?php
require 'config.php';
if ($_POST){
$title=$_POST['title'];
$description=$_POST['description'];
$id=$_POST['id'];
$pdostmt=$pdo->prepare("UPDATE todo SET title=:title, description=:description WHERE id=:id");
$pdostmt->execute(['title'=>$title, 'description'=>$description, 'id'=>$id]);
if ($pdostmt){
    echo "<script>alert('Task updated successfully!'); window.location.href='index.php';</script>";
}
else{
    echo "<script>alert('Failed to update task.'); window.location.href='index.php';</script>";
}
}
else{
    $pdostmt=$pdo->prepare("SELECT * FROM todo WHERE id=".$_GET['id']);
    $pdostmt->execute();
    $results=$pdostmt->fetchAll();
}
?>