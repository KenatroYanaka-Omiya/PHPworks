<?php
    $area = array('北海道','東北','関東','中部','近畿','中国','四国','九州');
    $age = array('10代以下','20代','30代','40代','50代','60代','70代','80代以上');
    $know_froms = array('Yahoo!','Google','Facebook','Twitter','その他');

include "functions.php";
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM posts2");
$status = $stmt->execute();

//３．データ表示
$view = "";

if ($status == false) {
    sqlError($stmt);
} else {
    //Selectデータの数だけ自動でループしてくれる
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

        //https://www.techiedelight.com/ja/convert-comma-delimited-string-to-int-array-php/
        $know_from = array_map('intval', explode(',', $result["know_from"]));

        $view .= '<p>';
        $view .= $result["id"]."\r" . $result["name"]."\r" . $area[$result["area"]-1]."\r". $age[$result["age"]-1]."\r";

        foreach( $know_from as $check ) {
            $view .= $know_froms[$check - 1]."\r";
//          もし$know_from（配列）の中に1が入っていたら、$know_froms[0]（Yahoo）を$viewに追加する
//          もし$know_from（配列）の中に2が入っていたら、$know_froms[1]（Google）を$viewに追加する
//          もし$know_from（配列）の中に3が入っていたら、$know_froms[2]（Facebook）を$viewに追加する
//          もし$know_from（配列）の中に4が入っていたら、$know_froms[3]（Twitter）を$viewに追加する
//          もし$know_from（配列）の中に5が入っていたら、$know_froms[4]（その他）を$viewに追加する
        }
        $view .= $result["created_at"]."\r";
        $view .= '<a href="detail.php?id='.$result["id"].'">';
        $view .= '[編集]';
        $view .= '</a>' ;
        $view .= '<a href="delete.php?id='.$result["id"].'">';
        $view .= '[削除]';
        $view .= '</a>';
        $view .= '</p>';
    
    }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者画面</title>
</head>
<body>
    <a href="index.php">入力画面に戻る</a>
    <h1>管理者画面</h1>
    <tr>
        <!--<th>ID</th>
        <th>お名前</th>
        <th>お住まい</th>
        <th>年齢層</th>
        <th>知ったきっかけ</th>
        <th>作成日</th>
        <th>操作</th>-->
        <td><?= $view ?></td>
    </tr>
    
</body>
</html>