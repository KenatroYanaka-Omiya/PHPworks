<?php


//1. POSTデータ取得
$name   = $_POST["name"];
$area  = $_POST["area"];
$age    = $_POST["age"];
$know_from = $_POST["know_from"];
$comment = $_POST["comment"];

$checkbox = implode(",",$know_from);

//2. DB接続します
include "functions.php";
$pdo = db_con();


//３．データ登録SQL作成
$sql = "INSERT INTO posts2(name,area,age,know_from,comment,created_at)VALUES(:name,:area,:age,:know_from,:comment,sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':area', $area, PDO::PARAM_STR);   
$stmt->bindValue(':age', $age, PDO::PARAM_STR);
$stmt->bindValue(':know_from', $checkbox, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$status = $stmt->execute();
if ($status == false) {
    sqlError($stmt);
    $error = $stmt->errorInfo();
    exit("ErrorSQL:".$error[2]);
} else {
    echo("送信しました");
    redirect("submit.php");
    exit;
}
