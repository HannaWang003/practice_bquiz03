<form action="./api/edit_poster.php" method="post">
    <div class="ct">預告片清單</div>
    <div style="display:flex;width:100%" class="ts rb">
        <div style="width:24.5%;text-align:center">預告片海報</div>
        <div style="width:24.5%;text-align:center">預告片片名</div>
        <div style="width:24.5%;text-align:center">預告片排序</div>
        <div style="width:24.5%;text-align:center">操作</div>
    </div>
    <div style="height:250px;overflow:scroll;">
        <table style="width:100%;margin:auto;">
            <?php
            $rows = $Poster->all("order by rank");
            $max = $Poster->count() - 1;
            foreach ($rows as $idx => $row) {
            ?>
                <tr>
                    <td style="text-align:center;width:24.5%;"><img src="./img/<?= $row['img'] ?>" style="width:60px;height:80px;"></td>
                    <td style="text-align:center;width:24.5%;"><input type="text" name="name[]" value="<?= $row['name'] ?>">
                    </td>
                    <td style="text-align:center;width:24.5%;">
                        <input type="button" value="往上" data-id="<?= $row['id'] ?>" data-sw="<?= ($idx != 0) ? $rows[$idx - 1]['id'] : $row['id'] ?>"> <input type="button" value="往下" data-id="<?= $row['id'] ?>" data-sw="<?= ($idx != $max) ? $rows[$idx + 1]['id'] : $row['id'] ?>">
                    </td>
                    <td style="text-align:center;width:24.5%;">
                        <input type="checkbox" name="sh[]" value="<?= $row['id'] ?>" <?= ($row['sh'] == 1) ? "checked" : "" ?>>顯示
                        <input type="checkbox" name="del[]" value="<?= $row['id'] ?>">刪除
                        <select name="ani[]">
                            <option value="1" <?= ($row['ani'] == 1) ? "selected" : "" ?>>淡入淡出</option>
                            <option value="2" <?= ($row['ani'] == 2) ? "selected" : "" ?>>滑入滑出</option>
                            <option value="3" <?= ($row['ani'] == 3) ? "selected" : "" ?>>縮放</option>
                        </select>
                    </td>
                </tr>
                <input type="hidden" name="id[]" value="<?= $row['id'] ?>">
            <?php
            }
            ?>
        </table>
    </div>
    <div class="ct"><input type="submit" value="編輯確定">
        <input type="reset" value="重置">
    </div>
</form>
<hr>
<form action="./api/add_poster.php" method="post" enctype="multipart/form-data">
    <div class="ct">新增預告片海報</div>
    <table class="ts rb">
        <tr>
            <td class="ct">預告片海報: </td>
            <td class="ct"><input type="file" name="img"></td>
            <td class="ct">預告片片名: </td>
            <td class="ct"><input type="text" name="name"></td>
        </tr>
    </table>
    <div class="ct"><input type="submit" value="新增"> <input type="reset" value="重置"></div>
</form>
<script>
    $("input[type='button']").on('click', function() {
        let id = $(this).data('id');
        let sw = $(this).data('sw');
        let table = "poster"
        $.post('./api/sw.php', {
            id,
            sw,
            table
        }, function(res) {
            location.reload();
        })
    })
</script>