<?php
$dsn=' ';
$user=' ';
$password=' ';
$pdo=new PDO($dsn,$user,$password);

$sql='SELECT*FROM registration';
$result=$pdo->query($sql);
  foreach($result as $row){
    $id=$row['id'];
    $status=$_POST[$id];
    $sql="update registration set status='$status' where id=$id";
            $result=$pdo->query($sql);
            
  }
  header('Location: http://tt-564.99sv-coco.com/mission_5_mainpage.php');
  exit;
?>
