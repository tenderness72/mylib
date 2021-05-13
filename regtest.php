<?php
/*$USER = 'LibAdmin';
$PW = 'MyLib120';
$dnsinfo ="mysql:dbname=MyLibraly;host=localhost;charset=utf8";
try {
  $pdo = new PDO($dnsinfo,$USER,$PW);
  $sql = "INSERT INTO details VALUES(0,'応用行動分析学','島宗理／著','新曜社','20190401','https://cover.openbd.jp/9784788516229.jpg')";
  $stmt = $pdo->prepare($sql);
  $res = $stmt->execute(null);
    } catch (Exception $e) {
        $res = $e->getMessage();
    }
*/

#require_once('db_accesse.php');
$USER = 'LibAdmin';
$PW ='MyLib120';
$dnsinfo = "mysql:dbname=MyLibraly;host=localhost;charset=utf8";
try {
  $pdo = new PDO($dnsinfo,$USER,$PW);
  $sql = "INSERT INTO details VALUES(0,'応用行動分析学','島宗理／著','新曜社','20190401','https://cover.openbd.jp/9784788516229.jpg')";
  $stmt = $pdo->prepare($sql);
  $array = array(0,$BookTitle,$author,$publisher,$pubdate,$CoverUrl);
  $res = $stmt->execute($array);
/*
  $recordlist = "<table border='2'><th>ID</th><th>題名</th><th>著者</th><th>出版社</th><th>出版年</th>\n";
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $recordlist .= "<tr><td>{$row['id']}</td>";
    $recordlist .= "<td>{$row['title']}</td>";
    $recordlist .= "<td>{$row['author']}</td>";
    $recordlist .= "<td>{$row['publisher']}</td>";
    $recordlist .= "<td>{$row['pubdate']}</td></tr>";
  }
  $recordlist .= "</table>\n";
  */
} catch (Exception $e) {
  $res = $e->getMssage();
}
/*
$DB = new DB();
$sql = "INSERT INTO details VALUES(0,'応用行動分析学','島宗理／著','新曜社','20190401','https://cover.openbd.jp/9784788516229.jpg')";
$array = array(0,$BookTitle,$author,$publisher,$pubdate,$CoverUrl);
$DB->executeSQL($sql,$array);
*/

?>
<!DOCTYPE html>
<html>
  <head>
    <title>レコード追加テスト</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <nav>
         <div class="logo">
              <h1>navbar</h1>
         </div>

         <div class="menu">
              <div class="bar bar1"></div>
              <div class="bar bar2"></div>
              <div class="bar bar3"></div>
         </div>

         <ul class="nav-links">
              <li><a href="https://clinical-psycho.sub.jp/wordpress">本拠地</a></li>
              <li><a href="regist.php">書籍追加</a></li>
              <li><a href="BookList.php">蔵書一覧</a></li>
              <li><a href="#">工事中</a></li>
         </ul>
    </nav>
    <h1>レコード追加テスト</h1>
    <?php echo $res;?>
  </body>
</html>
