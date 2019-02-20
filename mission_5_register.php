<!DOCTYPE html>
<head>
<meta charset="UTF-8">
  <title>登録</title>
</head>
<body>
　 <h1>ユーザー情報登録画面</h1>
　 <div align="center">
   <table border="0"> 
　  <form action="mission_5_register.php"method="POST">
    <tr>
    <th>
        課程区分
    </th>
      <td>
        <input type="submit"value="教授"name="aa">
        <input type="submit"value="博士"name="aa">
        <input type="submit"value="修士"name="aa">
        <input type="submit"value="学部"name="aa">
      </td>
　   </tr>
    <tr>
    <th>
    </th>
      <td>
        <input type="text"name="degree"size="24"value=<?php echo $_POST['aa'];?>>
      </td>
　   </tr>
    <tr>
    <th>
        氏名
    </th>
      <td>
        <input type="text"name="name"placeholder="名前"size="24">
      </td>
　   </tr>
　　<tr>
    <th>
        メールアドレス
    </th>
      <td>
        <input type="text"name="user_id"placeholder="メアド"size="24">
      </td>
　   </tr>
　   <tr>
    <th>
        パスワード
    </th>
    　<td>
        <input type="text"name="pass"placeholder="パスワード"size="24">
    　</td>
　   </tr>
    <tr>
    <td colspan="2">
    <input type="submit"value="仮登録">
    </tr>
  </form>
  </table>
  </div>


<?php
//DB接続
$dsn=' ';
$user=' ';
$password=' ';
$pdo=new PDO($dsn,$user,$password);

// $sql="DROP TABLE registration";
// $stmt=$pdo->query($sql);

//DB内にテーブル作成
$sql="CREATE TABLE registration "
."("
."id INT PRIMARY KEY AUTO_INCREMENT,"//オートカウント
."name TEXT,"
."degree TEXT,"
."user_id char(50) UNIQUE,"
."pass TEXT,"
."reg_user_id char(50),"
."reg_pass TEXT,"
."status TEXT,"
."memo TEXT"
.");";
$stmt=$pdo->query($sql);

//入力フォーム送信時
if(!empty($_POST['name']) && !empty($_POST['degree']) && !empty($_POST['user_id']) && !empty($_POST['pass'])){
    $sql1 = $pdo->prepare("INSERT INTO registration (id,name,degree,user_id,pass) VALUES (:id,:name,:degree,:user_id,:pass)");
    $sql1->bindParam(':id',$id,PDO::PARAM_INT);
    $sql1->bindParam(':name',$name,PDO::PARAM_STR);
    $sql1->bindParam(':degree',$degree,PDO::PARAM_STR);
    $sql1->bindParam(':user_id',$user_id,PDO::PARAM_STR);
    $sql1->bindParam(':pass',$pass,PDO::PARAM_STR);
    //データ受け取り
    $user_id=$_POST['user_id'];
    $name=$_POST['name'];
    $degree=$_POST['degree'];
    $pass=$_POST['pass'];
    $result_insert=$sql1->execute();
    
    mb_language("ja");
    mb_internal_encoding("UTF-8");
    $to=$user_id;
    $subject='仮登録の案内';
    $message='仮登録状態です。下記のURLを参照してください。
    tt-564.99sv-coco.com/mission_5_confirm_registration.php';
    $headers='From: ';

    mb_send_mail($to,$subject,$message,$headers);
       
    if($result_insert){
    echo  $user_id."宛に確認メールを送信しました。";
    }else{
    echo "アドレスが重複しています。";
}
}
    
$sql2='SELECT*FROM registration';
$results=$pdo->query($sql2);
$data=$results->fetchAll();
    var_dump($data);
 ?>

</body>
</html>
