<?php
include_once "db.php";
$today = date("Y-m-d");
//取得2天前的日期
$ondate = date("Y-m-d", strtotime("-2 days"));
//找出資料庫符合條件的電影
$movies = $Movie->all("where `ondate` between '$ondate' AND '$today'");
foreach ($movies as $movie) {
?>
    <option value='<?= $movie['id'] ?>' <?= ($movie['id'] == $_GET['id']) ? "selected" : "" ?>><?= $movie['name'] ?>
    </option>
<?php
}
