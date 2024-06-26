<?php
include_once "db.php";
$id = $_GET['id'];
$ondate = strtotime($Movie->find($id)['ondate']);
$end = strtotime("+2 days", $ondate);
$today = strtotime(date("Y-m-d"));
$diff = ($end - $today) / (60 * 60 * 24);
for ($i = 0; $i <= $diff; $i++) {
    $date = date("Y-m-d", strtotime("+$i days"))
?>
    <option value="<?= $date ?>"><?= $date ?></option>
<?php
}
