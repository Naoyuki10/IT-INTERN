<!DOCTYPE html>
<html>
<head>
<title>研究室確認ボード</title>
<meta charset="UTF-8">
</head>
<body>
<h1>研究室用確認ボード</h1> 
 
<table border='1'>
<tr><th>id</th><th>名前</th><th>課程</th><th>在室</th><th>学内</th><th>調査</th><th>帰宅</th><th>連絡事項</th></tr>
 
<?php
//DB接続
$dsn=' ';
$user=' ';
$password=' ';
$pdo=new PDO($dsn,$user,$password);

$sql='SELECT*FROM registration';
$result=$pdo->query($sql);
  foreach($result as $row){
?> 
<tr> 
	<td><?php echo $row['id']; ?></td>
    <td><?php echo htmlspecialchars($row['name'],ENT_QUOTES,'UTF-8'); ?></td> 
    <td><?php echo htmlspecialchars($row['degree'],ENT_QUOTES,'UTF-8'); ?></td>
    <form action="mission_5_mainpage_action.php"method="post">
    <td><input type="radio"value="zaishitu"name=<?php echo $row['id']?><?php if($row['status']=='zaishitu'):?> checked="checked"<?php endif;?>></td>
    <td><input type="radio"value="gakunai"name=<?php echo $row['id']?><?php if($row['status']=='gakunai'):?> checked="checked"<?php endif;?>></td>
    <td><input type="radio"value="chousa"name=<?php echo $row['id']?><?php if($row['status']=='chousa'):?> checked="checked"<?php endif;?>></td>
    <td><input type="radio"value="huzai"name=<?php echo $row['id']?><?php if($row['status']=='huzai'):?> checked="checked"<?php endif;?>></td>
    <td><input type="text"name="memo"value=""></td>
</tr> 
<?php 
} 
?>
    <tr>
        <td><input type="submit"value="更新"></form></td>
    </tr>
</table>
 
</body>
</html>
