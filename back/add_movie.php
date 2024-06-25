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
<h3 class="ct">新增院線片</h3>
<form action="./api/add_movie.php" method="post" enctype="multipart/form-data">
    <div style="display:flex;align-items:flex-start;">
        <div style="width:15%;">影片名稱</div>
        <div style="width:85%;" class="ra">
            <table class="ts form">
                <tr>
                    <td>片名:</td>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                    <td>分級:</td>
                    <td><select name="level">
                            <option value="0">請選擇分級</option>
                            <option value="1">普遍級</option>
                            <option value="2">保護級</option>
                            <option value="3">輔導級</option>
                            <option value="4">限制級</option>
                        </select>
                        <span>(普遍級、保護級、輔導級、限制級)</span>
                    </td>
                </tr>
                <tr>
                    <td>片長:</td>
                    <td><input type="text" name="length"></td>
                </tr>
                <tr>
                    <td>上映日期:</td>
                    <td>
                        <select name="year" id="">
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>年
                        <select name="month" id="">
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                            ?>
                        </select>月
                        <select name="date" id="">
                            <?php
                            for ($i = 1; $i <= 31; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                            ?>
                        </select>日
                    </td>
                </tr>
                <tr>
                    <td>發行商</td>
                    <td><input type="text" name="publish"></td>
                </tr>
                <tr>
                    <td>導演</td>
                    <td><input type="text" name="director"></td>
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
        <div style="width:85%;"><textarea name="intro" style="width:99%;height:100px;"></textarea></div>
    </div>
    <br>
    <div class="ct">
        <input type="submit" value="新增"> <input type="reset" value="重置">
    </div>
</form>