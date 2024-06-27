<h3 class="ct">訂單清單</h3>
<form action="./api/del_order.php" method="post">
    <div>
        快速刪除:
        <input type="radio" name="type" value="date" checked>依日期 <input type="text" name="date">
        <input type="radio" name="type" value="movie">依電影
        <select name="movie">
            <?php
            $movies = $Order->all("group by `movie`");
            foreach ($movies as $movie) {
            ?>
            <option value="<?= $movie['movie'] ?>"><?= $movie['movie'] ?></option>
            <?php
            }
            ?>
        </select>
        <input type="submit" value="刪除">
    </div>
</form>
<br>
<style>
table {
    border-collapse: collapse;
}

td {
    border-bottom: 1px solid black;
}

th {
    background: #aaa;
}
</style>
<table style="width:100%;">
    <tr>
        <th>訂單編號</th>
        <th>電影名稱</th>
        <th>日期</th>
        <th>場次時間</th>
        <th>訂購數量</th>
        <th>訂購位置</th>
        <th>操作</th>
    </tr>
    <?php
    $ords = $Order->all("order by no");
    foreach ($ords as $ord) {
        $seats = unserialize($ord['seats']);
    ?>
    <tr>
        <td><?= $ord['no'] ?></td>
        <td><?= $ord['movie'] ?></td>
        <td><?= $ord['date'] ?></td>
        <td><?= $ord['session'] ?></td>
        <td><?= $ord['qt'] ?></td>
        <td>
            <?php
                foreach ($seats as $seat) {
                    $col = ceil($seat / 5);
                    $num = ($seat - 1) % 5 + 1;
                ?>
            <div><?= $col . "排" . $num . "號" ?></div>
            <?php
                }
                ?>
        </td>
        <td><button onclick="del('order',<?= $ord['id'] ?>)">刪除</button></td>
    </tr>
    <?php
    }
    ?>
</table>
<script>
function del(table, id) {
    $.post('./api/del.php', {
        table,
        id
    }, () => {
        location.reload();
    })
}
</script>