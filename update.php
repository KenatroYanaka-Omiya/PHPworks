<?php
//1.POSTでParamを取得
$name   = $_POST["name"];
$area  = $_POST["area"];
$age    = $_POST["age"];
$know_from = $_POST["know_from"];
$comment = $_POST["comment"];

$checkbox = implode(",",$know_from);

//2.DB接続など
include "functions.php";
$pdo = db_con();

//3.更新(bindValue)
//　基本的にinsert.phpの処理の流れです。
$sql = "UPDATE posts2 SET name=:name,area=:area,age=:age,Know_from=:know_from,comment=:comment WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':area', $area, PDO::PARAM_INT);   
$stmt->bindValue(':age', $age, PDO::PARAM_INT);
$stmt->bindValue(':know_from', $checkbox, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$status = $stmt->execute();
if ($status == false) {
    sqlError($stmt);
    $error = $stmt->errorInfo();
    exit("ErrorSQL:".$error[2]);
} else {
    redirect("index.php");
}

?>
