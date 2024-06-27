<?php
include_once "db.php";
dd($_POST);
if ($_POST['type'] == "date") {
    $Order->del(['date' => $_POST['date']]);
} elseif ($_POST['type'] == "movie") {
    $Order->del(['movie' => $_POST['movie']]);
}
to("../back.php?do=order");
