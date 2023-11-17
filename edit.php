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
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>入力フォーム</title>
  </head>
  <body>
    レシピの投稿<br>
    <form method="post" action="update.php?id=<?= htmlspecialchars($result['id'], ENT_QUOTES) ?>">
      料理名：<input type="text" name="recipe_name" value="<?php echo htmlspecialchars($result['recipe_name'], ENT_QUOTES); ?>"><br>
      カテゴリ：
      <select name="category">
        <option hidden>選択してください</option>
        <option value="1" <?php if ($result['category'] == 1) echo 'selected' ?>>和食</option>
        <option value="2" <?php if ($result['category'] == 2) echo 'selected' ?>>中華</option>
        <option value="3" <?php if ($result['category'] == 3) echo 'selected' ?>>洋食</option>
      </select><br>
    </form>
  </body>
</html>