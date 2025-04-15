<?php
require 'config.php';
$pdostmt= $pdo->prepare ("DELETE FROM todo WHERE id=".$_GET['id']);
$pdostmt->execute();

echo "<script>alert('Task deleted successfully!'); window.location.href='index.php';</script>";
?>