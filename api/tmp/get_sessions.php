<?php
include_once "db.php";
$date = $_GET['date'];
$movie = $_GET['movie'];
$movieName = $Movie->find($movie)['name'];
$H = date("G");
$start = ($H >= 14 && $date == date("Y-m-d")) ? 7 - ceil((24 - $H) / 2) : 1;
for ($i = $start; $i <= 5; $i++) {
    $qt = $Order->sum('qt', ['date' => $date, 'session' => $sess[$i]]);
    $lave = 20 - $qt;
?>
    <option value="<?= $sess[$i] ?>"><?= $sess[$i] ?> 剩餘<?= $lave ?>位</option>
<?php
}
