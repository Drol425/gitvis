<?php

header('Content-Type: text/html; charset=utf-8');
// Страница авторизации

include('dbcon.php');

function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
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
    // Вытаскиваем из БД запись, у которой логин равняеться введенному
    //$query = mysqli_query($db,"SELECT user_id, user_password FROM users WHERE user_login='".mysqli_real_escape_string($db,$_POST['login'])."' LIMIT 1");
    //$data = mysqli_fetch_assoc($query);
    $query = $DB->query("SELECT id,password FROM users WHERE login=?", array($_POST['email']));


    // Сравниваем пароли
    if($query[0]['password'] === md5(md5($_POST['password'])))
    {
        // Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));

        if(!empty($_POST['not_attach_ip']))
        {
            // Если пользователя выбрал привязку к IP
            // Переводим IP в строку
            $insip = ", user_ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";
        }

        // Записываем в БД новый хеш авторизации и IP
        //mysqli_query($db, "UPDATE users SET user_hash='".$hash."' ".$insip." WHERE user_id='".$data['user_id']."'");

        // Ставим куки
        setcookie("id", $query[0]['id'], time()+60*60*24*30);
        setcookie("hash", $hash, time()+60*60*24*30,null,null,null,true); // httponly !!!

        // Переадресовываем браузер на страницу проверки нашего скрипта
        header("Location: index.php"); exit();
    }
    else
    {
        print "Вы ввели неправильный email/пароль";
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
   <link rel="stylesheet" href="login--signup.css"/>
   <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
   </head>
<body>

       <form action="login.php" method="POST">
           <p class="form-title">Log In</p>
<script src="//ulogin.ru/js/ulogin.js"></script>
<div id="uLogin" data-ulogin="display=panel;theme=classic;fields=first_name,last_name;providers=vkontakte,instagram,facebook;hidden=;redirect_uri=http%3A%2F%2Femocion.lk3.ru%2Flogin.php;mobilebuttons=0;"></div>
           <p class="or">or</p>
           <div class="form-inputs" id="inputs">
               <input class="email" type="email" name="email" placeholder="Email or phone number" required/><br/>
               <input class="password" type="password" name="password" placeholder="Password" required/><br/>
               <button class="log-in" name="submit" type="submit">Log In</button>
               <a href="singup.php"><button class="sign-up" type="button">Create new account</button></a>
           </div>
       </form>

   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
</body>
</html>