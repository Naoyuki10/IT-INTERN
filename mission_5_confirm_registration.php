<!DOCTYPE html>
<head>
<meta charset="utf-8">
  <title>登録</title>
</head>
<body>
　 <h1>ユーザー登録情報確認</h1>
　 <div align="center">
   <table border="0"> 
　  <form action="mission_5_confirm_registration.php"method="POST">
     <tr>
    <th>
        登録メールアドレス
    </th>
      <td>
        <input type="text"name="reg_user_id"placeholder="メアド"size="24">
      </td>
　   </tr>
　   <tr>
    <th>
        パスワード確認
    </th>
    　<td>
        <input type="password"name="reg_pass"placeholder="パスワード"size="24">
    　</td>
　   </tr>
    <tr>
    <td colspan="2">
    <input type="submit"value="本登録">
    </tr>
  </form>
  </table>
  </div>
</body>
</html>

<?php
//DB接続
$dsn = ' ';
$user =' ';
$password='';
$pdo = new PDO($dsn,$user,$password);

if(!empty($_POST['reg_user_id'])&&!empty($_POST['reg_pass'])){
    $sql='SELECT*FROM registration';
     $result=$pdo->query($sql);
       foreach($result as $row){
            if($_POST['reg_user_id']==$row['user_id']&&$_POST['reg_pass']==$row['pass']){
            $id=$row['id'];
            $reg_user_id=$_POST['reg_user_id'];
            $reg_pass=$_POST['reg_pass'];
            $sql="update registration set reg_user_id='$reg_user_id',reg_pass='$reg_pass' where id= $id";
            $result=$pdo->query($sql);
            echo"本登録が完了しました。";
                header("HTTP/1.1 301 Moved Permanently");
			    header("Location: http://tt-564.99sv-coco.com/mission_5_login.php");
			    exit();
            }else{
                echo"ユーザー名、又はパスワードが違います。";
            }
        }}

?>

