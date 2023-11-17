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
  $sql = 'SELECT * FROM recipes WHERE id = ?';
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(1, $id, PDO::PARAM_INT);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $dbh = null;
} catch (PDOException $e) {
  echo 'エラー発生: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
  exit;
}
?>