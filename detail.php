<?php
$id = $_GET["id"];

include "functions.php";
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM posts2 WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
   sqlError($stmt);
} else {
   $result = $stmt->fetch();
}
//index.php（登録フォームの画面ソースコードを全コピーして、このファイルをまるっと上書き保存）
?>

<?php
   $area = array('北海道','東北','関東','中部','近畿','中国','四国','九州');
   $age = array('10代以下','20代','30代','40代','50代','60代','70代','80代以上');
   $know_froms = array('Yahoo!','Google','Facebook','Twitter','その他');
?>



<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>アンケートフォーム</title>
</head>
<body>
   <h1>アンケート入力画面</h1>
   <form method="post" action="update.php">
      <label hidden>ID</label>
      <input hidden type="text" name="id" value="<?=$result["id"]?>"><br>
      <label>お名前</label><br>
      <input type="text" name="name" value="<?=$result["name"]?>" placeholder="例）山田　太郎" required></label><br>

      <label>お住まい</label><br>
      <select name="area" id="area" required>
         <?php
            for($i=0; $i<count($area); $i++){
               $j = (int)$i+1;
               if($result["area"] == $j){
                  echo "<option value='$j' selected>{$area[$i]}\n";
               }else{
               echo "<option value='$j'>{$area[$i]}\n";
               }
            }
         ?>
      </select><br>

      <label>年代</label><br>
      <?php
         for($i=0; $i<count($age); $i++){
            $j = (int)$i+1;
            if($result["age"] == $j){
               echo "<input type='radio' name='age' value='$j' checked>{$age[$i]}<br>\n";
            }else{
               echo "<input type='radio' name='age' value='$j'>{$age[$i]}<br>\n";
            }
            }
      ?>

      <label>当社の製品をどこでお知りになりましたか？</label><br>
      <?php
         $know_from = array_map('intval', explode(',', $result["know_from"]));
         for($i=0; $i<count($know_froms); $i++){
            $j = (int)$i+1;
            if(isset($know_from[$i])){
               echo "<input type='checkbox' class='check' name='know_from[]' value='$j' checked>{$know_froms[$i]}<br>\n";
            }else{
               echo "<input type='checkbox' class='check' name='know_from[]' value='$j'>{$know_froms[$i]}<br>\n";
            }
         }
      ?>

      <label>ご意見・ご要望<br><textArea name="comment" rows="20" cols="40"><?=$result["comment"]?></textArea></label><br>

      <button type="submit">送信する</button>
   </form>
   
</body>
</html>