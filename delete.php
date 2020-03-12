<?php

    include('dbcon.php');
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

$id_us = $_POST['name'];

$id = $_POST['deletes'];


	$DB->query("DELETE FROM `tasks` WHERE `id` = ? AND id_user=?",array($id,$id_us));