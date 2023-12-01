<?php
//1. POSTデータ取得
$name   = $_POST["name"];
$area  = $_POST["area"];
$age    = $_POST["age"];
$know_from = $_POST["know_from"];
$comment = $_POST["comment"];

//2. DB接続します
include "functions.php";
$pdo = db_con();


//３．データ登録SQL作成
$sql = "INSERT INTO post(name,area,age,know_from,comment,created_at)VALUES(:name,:area,:age,:know_from,:comment,sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':area', $area, PDO::PARAM_STR);   
$stmt->bindValue(':age', $age, PDO::PARAM_STR);
$stmt->bindValue(':know_from', $know_from, PDO::PARAM_STR);
$stmt->bindValue(':commnet', $comment, PDO::PARAM_STR);
$status = $stmt->execute();
if ($status == false) {
    sqlError($stmt);
    $error = $stmt->errorInfo();
    exit("ErrorSQL:".$error[2]);
} else {
    redirect("submit.php");
    exit;
}
