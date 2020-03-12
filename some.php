<?php

    include('dbcon.php');
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

$id_us = $_POST['name'];

$name = $_POST['title'];

$text = $_POST['text'];


$DB->query("INSERT INTO `tasks` (`id`, `id_user`, `name`, `text`) VALUES (?,?,?,?)",array(NULL,$id_us,$name,$text));
//INSERT INTO `h6072_diplo`.`tasks` (`id`, `id_user`, `name`, `text`) VALUES (NULL, '1', '1', '1');
	