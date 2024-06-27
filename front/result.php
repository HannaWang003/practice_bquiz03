<style>
#result {
    width: 50%;
    margin: auto;
    border: 1px solid black;

}

.bor {
    border: 1px solid black;
    padding: 2px;
}

.bor span {
    background: #999;
}

table {
    width: 100%;
}

td:nth-child(2) {
    width: 80%;
}

table,
tr,
td {
    border: 1px solid black;
}
</style>
<?php
$no = $Order->find(['no' => $_GET['no']]);
$seats = unserialize($no['seats']);
?>
<div id="result">
    <h3>感謝您的訂購，你的訂單編號是: <?= $no['no'] ?></h3>
    <table>
        <tr>
            <td>電影名稱:</td>
            <td><?= $no['movie'] ?></td>
        </tr>
        <tr>
            <td>電影名稱:</td>
            <td><?= $no['movie'] ?></td>
        </tr>
        <tr>
            <td>日期:</td>
            <td><?= $no['date'] ?></td>
        </tr>
        <tr>
            <td>場次時間:</td>
            <td><?= $no['session'] ?></td>
        </tr>
    </table>
    <div class="bor">
        <?php
        foreach ($seats as $seat) {
            $col = ceil($seat / 5);
            $num = ($seat - 1) % 5 + 1;
            echo "<div>{$col}排{$num}號</div>";
        }
        ?>
    </div>
</div>
<br>
<div class="ct"><button onclick="location.href='index.php'">確認</button></div>