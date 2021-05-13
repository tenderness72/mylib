<?php
//準備
#include "db_accesse.php";
#require_once('db_accesse.php');
ini_set('display_errors', "On");
error_reporting(E_ALL);
$id = 0;
//接続用
$USER = 'LibAdmin';
$PW ='MyLib120';
$dnsinfo = "mysql:dbname=MyLibraly;host=localhost;charset=utf8";


//入力が確認された場合に処理を実行
if(isset($_POST["ISBN"])){
	$ISBN = $_POST["ISBN"];
	$data = "https://api.openbd.jp/v1/get?isbn={$ISBN}";
	$json = file_get_contents($data);
	$json_decode = json_decode($json,true);

//変数へ格納
	$BookTitle = $json_decode[0]['summary']['title'];
	$author = $json_decode[0]['summary']['author'];
	$publisher = $json_decode[0]['summary']['publisher'];
	$pubdate = $json_decode[0]['summary']['pubdate'];
	$CoverUrl = $json_decode[0]['summary']['cover'];

if ($BookTitle == "") {
	echo "情報を取得できませんでした。\nデータを追加できません。";
	$recordlist ="";
}else {
//データベースへの接続及び
	try {
	  $pdo = new PDO($dnsinfo,$USER,$PW);
		$sql = "INSERT INTO details VALUES(?,?,?,?,?,?)";
	  $stmt = $pdo->prepare($sql);
	  $array = array($id,$BookTitle,$author,$publisher,$pubdate,$CoverUrl);
	  $res = $stmt->execute($array);

		$sql2 ="SELECT *FROM details";
		$stmt2 = $pdo->prepare($sql2);
		$stmt2->execute(null);
	  $recordlist = "<table border='2'><th>ID</th><th>題名</th><th>著者</th><th>出版社</th><th>出版年</th>\n";
	  while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
	    $recordlist .= "<tr><td>{$row['id']}</td>";
	    $recordlist .= "<td>{$row['title']}</td>";
	    $recordlist .= "<td>{$row['author']}</td>";
	    $recordlist .= "<td>{$row['publisher']}</td>";
	    $recordlist .= "<td>{$row['pubdate']}</td></tr>";
	  }
	  $recordlist .= "</table>\n";
	} catch (Exception $e) {
	  $res = $e->getMssage();
	}
}
/*
$sql = "INSERT INTO details VALUES(0,?,?,?,?,?)";
$array = array($BookTitle,$author,$publisher,$pubdate,$CoverUrl);
$DB->executeSQL($sql,$array);
*/


if ($CoverUrl == "") {
	$CoverUrl = "書影が見つかりませんでした";
}

//表示するものども
	$result = "----------------検索結果はこちらです----------------<br/>";
	$table =  "<table border='1'>";
	$table .= "<tr><th colspan='2'>書籍情報</th></tr>";
	$table .= "<tr><td colspan='2'><img src='{$CoverUrl}'></td></tr>";
	$table .= "<tr><td>タイトル</td><td>{$BookTitle}</td></tr>";
	$table .= "<tr><td>著者</td><td>{$author}</td></tr>";
	$table .= "<tr><td>出版社</td><td>{$publisher}</td></tr>";
	$table .= "<tr><td>出版年</td><td>{$pubdate}</td></tr>";
	$table .= "</table>";

/*
//エラー処理
//後でやりますううううううううう
	if ($ISBN = "null") {
		$table = "書籍情報が見つかりませんでした。";
	}
	*/
}else {
	$result = "";
	$table = "";
	$recordlist ="";
}
/*
$sql = "SELECT *FROM details";
$res = $DB->executeSQL($sql,null);
$recordlist = "<table>\n";
while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
	$recordlist .= "<tr><td>{$row['id']}</td>";
	$recordlist .= "<td>{$row['title']}</td>";
	$recordlist .= "<td>{$row['author']}</td>";
	$recordlist .= "<td>{$row['publisher']}</td>";
	$recordlist .= "<td>{$row['pubdate']}</td>";
	$recordlist .= "<td>{$row['cover']}</td></tr>";
}
$recordlist .= "</table>\n";
*/
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title>書籍管理システム</title>
	<script>document.book_info.ISBN.focus();</script>
	</head>
<body>
	<nav>
			 <div class="logo">
						<h1><a href="./index.php"> 書籍管理＜簡易＞</a></h1>
			 </div>

			 <div class="menu">
						<div class="bar bar1"></div>
						<div class="bar bar2"></div>
						<div class="bar bar3"></div>
			 </div>

			 <ul class="nav-links">
						<li><a href="http://clinical-psycho.sub.jp/wordpress">本拠地</a></li>
						<li><a href="regist.php">書籍追加</a></li>
						<li><a href="BookList.php">蔵書一覧</a></li>
						<li><a href="#">工事中</a></li>
			 </ul>
	</nav>
	<h1>書籍追加</h1>
	<form action="" method="post">
		<b>ISBNを入力：<input type="textarea" name="ISBN" id=book_info autofocus></b>
		<input type="submit" name="submit">
	</form>
	<?php echo $result;?>
	<?php echo $table;?>
	<button name='regist'>登録</button>
	<h1>追加データ一覧</h1>
	<?php echo $recordlist;?>
</body>
</html>
