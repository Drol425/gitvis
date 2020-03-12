<?php
	//exit();
    header('Content-Type: text/html; charset=utf-8');
// Страница регистрации нового пользователя

// Соединямся с БД
include('dbcon.php');
function incrementalHash($len = 8){
  $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
  $base = strlen($charset);
  $result = '';

  $now = explode(' ', microtime())[1];
  while ($now >= $base){
    $i = $now % $base;
    $result = $charset[$i] . $result;
    $now /= $base;
  }
  return substr($result, -5);
}


                if(isset($_POST['token'])){
                    $s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
                    $user = json_decode($s, true);
                    //$user['network'] - соц. сеть, через которую авторизовался пользователь
                   // echo $user['identity'];
                    //$user['first_name'] - имя пользователя
                    //$user['last_name'] - фамилия пользователя


                    if(isset($user['uid'])){
                      //uid
                     // echo $user['uid'];

                      $querysss = $DB->query("SELECT id,password FROM users WHERE login=?", array($user['uid']));


                        if($querysss){
                                  setcookie("id", $querysss[0]['id'], time()+60*60*24*30);
                                  setcookie("hash", $hash, time()+60*60*24*30,null,null,null,true); // httponly !!!

                                  // Переадресовываем браузер на страницу проверки нашего скрипта
                                  header("Location: index.php"); exit();


                        }else{
                          //echo 'нет !';
                          $hash = md5(generateCode(5));
                          $DB->query("INSERT INTO users(id,login,password,name) VALUES(?,?,?,?)", array(null,$user['uid'],$hash,$user['first_name']));
                        
                           $querysss1 = $DB->query("SELECT id,password FROM users WHERE login=?", array($user['uid']));
                           $hash1 = md5(generateCode(10));
                            setcookie("id", $querysss1[0]['id'], time()+60*60*24*30);
                                  setcookie("hash", $hash1, time()+60*60*24*30,null,null,null,true); // httponly !!!

                                  // Переадресовываем браузер на страницу проверки нашего скрипта
                                  header("Location: index.php"); exit();

                        }




                    }

                 // print_r($user);
                }

if(isset($_POST['submit']))
{
    $err = [];

    // проверям логин


    // проверяем, не сущестует ли пользователя с таким именем
    //$query = mysqli_query($db, "SELECT user_id FROM users WHERE user_login='".mysqli_real_escape_string($db, $_POST['login'])."'");
     $query =  $DB->query("SELECT COUNT(id) FROM users WHERE login=?", array($_POST['email']));

   // print_r($query[0]['COUNT(user_id)']);
    if($query[0]['COUNT(id)'] > 0)
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }

    // Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    {

        $login = $_POST['email'];

        // Убераем лишние пробелы и делаем двойное хеширование
        $password = md5(md5(trim($_POST['password'])));
        $name = $_POST['name'];
       //mysqli_query($db,"INSERT INTO users SET user_login='".$login."', user_password='".$password."'");
       
        $DB->query("INSERT INTO users(id,login,password,name) VALUES(?,?,?,?)", array(null,$login, $password,$name));

        
        header("Location: login.php"); exit();
    }
    else
    {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
   <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
   <link rel="stylesheet" href="signup.css"/>
   <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
   </head>
<body>
  <form action="signup.php" method="POST">
    <p class="form-title">Create new account</p>
<script src="//ulogin.ru/js/ulogin.js"></script>
<div id="uLogin" data-ulogin="display=panel;theme=classic;fields=first_name,last_name;providers=vkontakte,instagram,facebook;hidden=;redirect_uri=http%3A%2F%2Femocion.lk3.ru%2Flogin.php;mobilebuttons=0;"></div>
    <p class="or">or</p>
    <div class="form-inputs" id="inputs">
        <input class="name" type="text" name="name" placeholder="Name" required/><br/>
        <input class="email" type="email" name="email" placeholder="Email" required/><br/>
        <input class="password" type="password" name="password" placeholder="Password" required/><br/>
        <button class="sign-up" name="submit" type="submit">Sign Up</button>
    </div>
  </form>

</body>
</html>