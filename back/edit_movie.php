<?php
$row = $Movie->find($_GET['id']);
$year = explode("-", $row['ondate'])[0];
$month = explode("-", $row['ondate'])[1];
$day = explode("-", $row['ondate'])[2];
?>
<style>
.form td:nth-child(1) {
    width: 20%;
    text-align-last: justify;
    padding: 3px;
}

.ra {
    background: #999;
}
</style>
<h3 class="ct">編輯院線片</h3>
<form action="./api/edit_movie.php" method="post" enctype="multipart/form-data">
    <div style="display:flex;align-items:flex-start;">
        <div style="width:15%;">影片名稱</div>
        <div style="width:85%;" class="ra">
            <table class="ts form">
                <tr>
                    <td>片名:</td>
                    <td><input type="text" name="name" value="<?= $row['name'] ?>"></td>
                </tr>
                <tr>
                    <td>分級:</td>
                    <td><select name="level">
                            <option value="1" <?= ($row['level'] == 1) ? "selected" : "" ?>>普遍級</option>
                            <option value="2" <?= ($row['level'] == 2) ? "selected" : "" ?>>保護級</option>
                            <option value="3" <?= ($row['level'] == 3) ? "selected" : "" ?>>輔導級</option>
                            <option value="4" <?= ($row['level'] == 4) ? "selected" : "" ?>>限制級</option>
                        </select>
                        <span>(普遍級、保護級、輔導級、限制級)</span>
                    </td>
                </tr>
                <tr>
                    <td>片長:</td>
                    <td><input type="text" name="length" value="<?= $row['length'] ?>"></td>
                </tr>
                <tr>
                    <td>上映日期:</td>
                    <td>
                        <select name="year" id="">
                            <option value="2024" <?= ($year == 2024) ? "selected" : "" ?>>2024</option>
                            <option value="2025" <?= ($year == 2025) ? "selected" : "" ?>>2025</option>
                        </select>年
                        <select name="month" id="">
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                $selected = ($month == $i) ? "selected" : "";
                                echo "<option value='$i' $selected>$i</option>";
                            }
                            ?>
                        </select>月
                        <select name="day" id="">
                            <?php
                            for ($i = 1; $i <= 31; $i++) {
                                $selected = ($day == $i) ? "selected" : "";
                                echo "<option value='$i' $selected>$i</option>";
                            }
                            ?>
                        </select>日
                    </td>
                </tr>
                <tr>
                    <td>發行商</td>
                    <td><input type="text" name="publish" value="<?= $row['publish'] ?>"></td>
                </tr>
                <tr>
                    <td>導演</td>
                    <td><input type="text" name="director" value="<?= $row['director'] ?>"></td>
                </tr>
                <tr>
                    <td>預告影片:</td>
                    <td><input type="file" name="trailer"></td>
                </tr>
                <tr>
                    <td>電影海報:</td>
                    <td><input type="file" name="poster"></td>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <div style="display:flex;align-items:flex-start;">
        <div style="width:15%;">劇情簡介</div>
        <div style="width:85%;"><textarea name="intro" style="width:99%;height:100px;"><?= $row['intro'] ?></textarea>
        </div>
    </div>
    <br>
    <div class="ct">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <input type="submit" value="修改"> <input type="reset" value="重置">
    </div>
</form>