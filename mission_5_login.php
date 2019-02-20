<!DOCTYPE html>
<head>
<meta charset="utf-8">
  <title>ログイン</title>
</head>
<body>
　 <h1>ログイン</h1>
　 <div align="center">
   <table border="0"> 
　  <form action="mission_5_login.php"method="POST">
　　<tr>
    <th>
        ユーザーID
    </th>
      <td>
        <input type="text"name="inputted_user_id"placeholder="ユーザーID"size="30">
      </td>
　   </tr>
　   <tr>
    <th>
        パスワード
    </th>
    　<td>
        <input type="password"name="inputted_pass"placeholder="パスワード"size="30">
    　</td>
　   </tr>
    <tr>
    <td colspan="2">
    <input type="submit"name="login"value="ログイン">
    </td>
    </tr>
    <tr>
    <td colspan="2">
    <input type="button"value="登録"onclick="location.href='./mission_5_register.php'">
    </tr>
  </form>
  </table>
  </div>
</body>
</html>

<?php 
    $dsn = ' ';
    $user =' ';
    $password=' ';
    $pdo = new PDO($dsn,$user,$password);

    if(!empty($_POST['inputted_user_id'])&&!empty($_POST['inputted_pass'])){
        $sql='SELECT*FROM registration';
         $result=$pdo->query($sql);
           foreach($result as $row){
            if($_POST['inputted_user_id']==$row['reg_user_id']&&$_POST['inputted_pass']==$row['reg_pass']){
                //メインページへ
                header("HTTP/1.1 301 Moved Permanently");
			    header("Location: http://tt-564.99sv-coco.com/mission_5_mainpage.php");
			    exit();
            
              }}}
    ?>   


