<?php
$user = '';
$pass = '';
if (empty($_GET['id'])) {
  echo 'IDを正しく入力してください。';
  exit;
}
$id = (int)$_GET['id'];
try {
  $dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $pass);
  $dbh->setAttrribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}