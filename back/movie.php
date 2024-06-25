<style>
    .item {
        width: 100%;
        display: flex;
        align-items: center;
    }

    .item>div:nth-child(1) {
        width: 15%;
    }

    .item>div:nth-child(2) {
        width: 12%;
        text-align: center;
    }

    .item>div:nth-child(3) {
        width: 73%;
    }
</style>
<button onclick="location.href='?do=add_movie'">新增電影</button>
<hr>
<div style="width:100%;height:415px;overflow:auto;">
    <?php
    $max = $Movie->count() - 1;
    $rows = $Movie->all("order by rank");
    foreach ($rows as $idx => $row) {
    ?>
        <div class="item">
            <div><img src="./img/<?= $row['poster'] ?>" style="width:100%"></div>
            <div>分級:<img src="./icon/03C0<?= $row['level'] ?>.png" style="width:25px;"></div>
            <div>
                <div style="display:flex;width:100%;justify-content:space-between">
                    <div>片名:<?= $row['name'] ?></div>
                    <div>片長:<?= $row['length'] ?></div>
                    <div>上映日期:<?= $row['ondate'] ?></div>
                </div>
                <div style="text-align:end;">
                    <button class="sw-btn" data-id="<?= $row['id'] ?>" data-sw="<?= ($idx != 0) ? $rows[$idx - 1]['id'] : $row['id'] ?>">往上</button>
                    <button class="sw-btn" data-id="<?= $row['id'] ?>" data-sw="<?= ($idx != $max) ? $rows[$idx + 1]['id'] : $row['id'] ?>">往下</button>
                    <button class="show-btn"><?= ($row['sh'] == 1) ? "顯示" : "隱藏" ?></button>
                    <button>編輯電影</button>
                    <button>刪除電影</button>
                </div>
            </div>
        </div>
        <hr>
    <?php
    }
    ?>
</div>
<script>
    $('.sw-btn').on('click', function() {
        let id = $(this).data('id');
        let sw = $(this).data('sw');
        let table = "movie";
        $.post('./api/sw.php', {
            id,
            sw,
            table
        }, function() {
            location.reload();
        })
    })
</script>