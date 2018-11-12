<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<form action="mission_4-1.php"method="post">
<body>

<?php
//DB接続
$dsn = 'データベース名';
$user ='ユーザー名';
$password='パスワード';
$pdo = new PDO($dsn,$user,$password);

//DB内にテーブル作成
$sql ="CREATE TABLE tb_mission4"
."("
."id INT PRIMARY KEY AUTO_INCREMENT,"//オートカウント
."name char(32),"
."comment TEXT,"
."date DATE,"
."pass TEXT"
.");";
$stmt = $pdo->query($sql);

//入力フォーム送信時
if(!empty($_POST['name']) && !empty($_POST['comment']) && !empty($_POST['pass']) && empty($_POST['editcon'])){
    $sql = $pdo->prepare("INSERT INTO tb_mission4 (id,name,comment,date,pass) VALUES (:id,:name,:comment,:date,:pass)");
    $sql->bindParam(':id',$id,PDO::PARAM_INT);
    $sql->bindParam(':name',$name,PDO::PARAM_STR);
    $sql->bindParam(':comment',$comment,PDO::PARAM_STR);
    $sql->bindParam(':date', $date, PDO::PARAM_STR);
    $sql->bindParam(':pass',$pass,PDO::PARAM_STR);
    //データ受け取り
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $date = date('Y/m/d H:i:s');
    $pass = $_POST['pass'];
    $sql->execute();
}

//削除フォーム送信時
$sql='SELECT*FROM tb_mission4';
if(!empty($_POST['delete']) && !empty($_POST['delpass'])){
	$result=$pdo->query($sql);
	foreach($result as $row){
		if($_POST['delete'] == $row['id'] && $_POST['delpass'] == $row['pass']){
			$deleteid=$_POST['delete'];
		}elseif($_POST['delete'] == $row['id'] && $_POST['delpass'] != $row['pass']){
			echo "パスワードが違います"."<br />";
		}
	}
}

//Mysqlの処理(削除)
if(!empty($deleteid)) {
	$sql="delete from tb_mission4 where id=$deleteid";
	$result=$pdo->query($sql);
}

//編集フォーム送信時
$sql='SELECT*FROM tb_mission4';
if(!empty($_POST['editnum']) && !empty($_POST['edipass'])){
	$result=$pdo->query($sql);
	foreach($result as $row){
		if($_POST['editnum'] == $row['id'] && $_POST['edipass'] == $row['pass']){
			$pre_name=$row['name'];
			$pre_comment=$row['comment'];
			$pre_hidden=$row['id'];
			$pre_pass=$row['pass'];
			$editid=$_POST['editnum'];
		}elseif($_POST['editnum'] == $row['id'] && $_POST['edipass'] != $row['pass']){
			echo "パスワードが違います"."<br />";
		}
		}
	}

	//Mysqlの処理(編集）
$sql='SELECT*FROM tb_mission4';
if(!empty($_POST['name']) && !empty($_POST['comment']) &&!empty($_POST['editcon']) && !empty($_POST['pass'])){
	$result=$pdo->query($sql);
	foreach($result as $row){
		if($_POST['editcon'] == $row['id'] && $_POST['pass'] == $row['pass']){
	$nm=$_POST['name'];
	$kome=$_POST['comment'];
	$editid=$_POST['editcon'];
	$sql="update tb_mission4 set name='$nm',comment='$kome'where id=$editid";
	$result=$pdo->query($sql);
		}
}
}

?>

 <!--フォーム作成-->
<input type="text"name="name"placeholder="名前"value=<?php echo $pre_name ?>><br>
<input type="text"name="comment"placeholder="コメント"value=<?php echo $pre_comment ?>><br>
<input type="text" name="pass" placeholder="パスワード"><br>
<input type="hidden"name="editcon"value=<?php echo $pre_hidden ?>>
<input type="submit"value="送信">
<br>
<br>
<input type="text"name="delete"placeholder="削除対象番号"><br>
<input type="text" name="delpass" placeholder="パスワード"><br>
<input type="submit"value="削除">
<br>
<br>
<input type="text"name="editnum"placeholder="編集対象番号"><br>
<input type="text" name="edipass" placeholder="パスワード"><br>
<input type="submit"value="編集"></form>

<?php

//表示
$sql='SELECT*FROM tb_mission4';
$results=$pdo->query($sql);
$date=date('Y/m/d H:i:s');
foreach($results as $row){
	echo $row['id'].',';
	echo $row['name'].',';
	echo $row['comment'].',';
	echo $row['date'].'<br>';
	}
?>

</body>
</html>