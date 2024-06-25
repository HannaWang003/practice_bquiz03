<?php
include_once "db.php";
$_POST['ondate'] = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['date'];
unset($_POST['year'], $_POST['month'], $_POST['date']);
if (isset($_FILES['trailer']['tmp_name'])) {
    move_uploaded_file($_FILES['trailer']['tmp_name'], "../img/{$_FILES['trailer']['name']}");
    $_POST['trailer'] = $_FILES['trailer']['name'];
}
if (isset($_FILES['poster']['tmp_name'])) {
    move_uploaded_file($_FILES['poster']['tmp_name'], "../img/{$_FILES['poster']['name']}");
    $_POST['poster'] = $_FILES['poster']['name'];
}
$_POST['rank'] = $Movie->max('rank') + 1;
$Movie->save($_POST);
to("../back.php?do=movie");
