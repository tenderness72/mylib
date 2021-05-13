<?php
require_once('./db_accesse.php');
ini_set('display_errors', "On");
error_reporting(E_ALL);

try {
  $db = new DB();
  $sql = "SELECT *FROM details";
  $res = $db->executeSQL($sql,null);

  $recordlist = "<table border='2' class='table_01'><th class='th_01'>ID</th><th class='th_01'>題名</th><th class='th_01'>著者</th><th class='th_01'>出版社</th><th class='th_01'>出版年</th>\n";
  while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
    $recordlist .= "<tr class='tr_01'><td>{$row['id']}</td>";
    $recordlist .= "<td><a href='book_information.php?id={$row['id']}'>{$row['title']}</td>";
    $recordlist .= "<td>{$row['author']}</td>";
    $recordlist .= "<td>{$row['publisher']}</td>";
    $recordlist .= "<td>{$row['pubdate']}</a></td></tr>";
  }
  $recordlist .= "</table>\n";
} catch (Exception $e) {
  $res = $e->getMssage();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>蔵書一覧</title>
  <script>
     $('tr[data-href]').addClass('clickable')
       .click(function (e) {
         if (!$(e.target).is('a')) {
           window.location = $(e.target).closest('tr').data('href');
         };
     });
 </script>
</head>
<body>
  <nav>
       <div class="logo">
            <h1><a href="./"> 書籍管理＜簡易＞</a></h1>
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
  <div class="search">
    <h2>蔵書検索</h2>
    <form action="search.php?=" method="get">
      <input type="search" name="search">
      <input type="submit">
  </div>
  <div class="books">
  <h1>蔵書一覧</h1><br />
  <?php echo $recordlist;?>
</div>
</body>
</html>
<html></html>
