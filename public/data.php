<?php


$user = new stdclass();
$user->name = "Joe";
$user->email = "joe@gmail.com";

echo json_encode($user);
