<?php
$id = $_GET["id"];

include "functions.php";
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("DELETE FROM posts2 WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT); 
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    sqlError($stmt);
} else {
    redirect("admin.php");
}
?>