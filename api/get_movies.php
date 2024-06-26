<?php
include_once "db.php";
$id = $_GET['id'];
$today = date("Y-m-d");
$ondate = date("Y-m-d", strtotime("-2 days"));
$movies = $Movie->all("where `ondate` between '$ondate' and '$today'", "order by rank");
foreach ($movies as $movie) {
?>
    <option value="<?= $movie['id'] ?>" <?= ($movie['id'] == $id) ? "selected" : "" ?>><?= $movie['name'] ?></option>
<?php
}
