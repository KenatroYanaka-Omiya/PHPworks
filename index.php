<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<h1>アンケート入力画面</h1>
<form method="post" action="insert.php">
  <div class="jumbotron">
     <label>お名前<br>
        <input type="text" name="name" placeholder="例）山田　太郎"></label><br>
     <label>お住まい<br>
        <select name="area" id="area">
            <option value="1">北海道</option>
            <option value="2">東北</option>
            <option value="3">関東</option>
            <option value="4">中部</option>
            <option value="5">近畿</option>
            <option value="6">中国</option>
            <option value="7">四国</option>
            <option value="8">九州</option>
        </select><br>
     <label>年代<br>
        <input type="radio" name="" value="">10代以下<br>
        <input type="radio" name="" value="">20代<br>
        <input type="radio" name="" value="">30代<br>
        <input type="radio" name="" value="">40代<br>
        <input type="radio" name="" value="">50代<br>
        <input type="radio" name="" value="">60代<br>
        <input type="radio" name="" value="">70代<br>
        <input type="radio" name="" value="">80代以上<br>


     <label>当社の製品をどこでお知りになりましたか？<br>
     <label>ご意見・ご要望<br><textArea name="naiyou" rows="4" cols="40"></textArea></label>
     <input type="submit" value="送信する">
  </div>
</form>
<!-- Main[End] -->


</body>
</html>