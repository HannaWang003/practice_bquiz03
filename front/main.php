<style>
    .lists {
        width: 200px;
        height: 240px;
        margin: auto;
        overflow: hidden;
        position: relative;
    }

    .item {
        width: 200px;
        height: 240px;
        margin: auto;
        position: absolute;
        text-align: center;
        display: none;
    }

    .item div img {
        width: 100%;
        height: 220px;
    }

    /* 按鈕 */
    .controls {
        width: 420px;
        height: 100px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: auto;
        margin-top: 10px;
        position: relative;
    }

    .left,
    .right {
        width: 0;
        border: 20px solid black;
        border-top-color: transparent;
        border-bottom-color: transparent;
    }

    .left {
        border-left-width: 0;
    }

    .right {
        border-right-width: 0;
    }

    .btns {
        width: 360px;
        height: 100px;
        display: flex;
        overflow: hidden;
    }

    .btn {
        width: 90px;
        flex-shrink: 0;
        text-align: center;
        font-size: 12px;
        position: relative;
    }

    .btn img {
        width: 60px;
        height: 80px;
    }
</style>
<?php
$posters = $Poster->all(['sh' => 1], "order by rank");
?>
<div class="half" style="vertical-align:top;">
    <h1 class="ct">預告片介紹</h1>
    <div class="rb tab" style="width:95%;">
        <div class="lists">
            <?php
            foreach ($posters as $poster) {
            ?>
                <div class="item" data-ani="<?= $poster['ani'] ?>">
                    <div><img src="./img/<?= $poster['img'] ?>" alt=""></div>
                    <div><?= $poster['name'] ?></div>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="controls">
            <div class="left"></div>
            <div class="btns">
                <?php
                foreach ($posters as $poster) {
                ?>
                    <div class="btn">
                        <div><img src="./img/<?= $poster['img'] ?>" alt=""></div>
                        <div><?= $poster['name'] ?></div>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="right"></div>
        </div>
    </div>
</div>
<div class="half">
    <h1 class="ct">院線片清單</h1>
    <div class="rb tab" style="width:95%;">
        <table>
            <tbody>
                <tr> </tr>
            </tbody>
        </table>
        <div class="ct"> </div>
    </div>
</div>
<script>
    let now = 0;
    let next = 0;
    let total = $('.item').length;
    let timer = setInterval(slide, 3000);
    let p = 0;

    function slide(n) {
        let ani = $('.item').eq(now).data('ani');
        if (typeof(n) == "undefined") {
            next = now + 1
            if (next >= total) {
                next = 0;
            }
        } else {
            next = n;
        }
        switch (ani) {
            case 1:
                $('.item').eq(now).fadeOut(1000, () => {
                    $('.item').eq(next).fadeIn(1000)
                })
                break;
            case 2:
                $('.item').eq(now).hide(1000, () => {
                    $('.item').eq(next).show(1000)
                })
                break;
            case 3:
                $('.item').eq(now).slideUp(1000, () => {
                    $('.item').eq(next).slideDown(1000)
                })
                break;
        }
        now = next;
    }
    $('.left,.right').on("click", function() {
        let arrow = $(this).attr('class');
        switch (arrow) {
            case "left":
                if (p - 1 >= 0) {
                    p--
                }
                break;
            case "right":
                if (p + 1 <= total - 4) {
                    p++
                }
                break;
        }
        $('.btn').animate({
            right: 90 * p
        });
    })
    $('.btn').hover(function() {
        clearInterval(timer);
    }, function() {
        timer = setInterval(slide, 3000)
    })
    $('.btn').on('click', function() {
        let idx = $(this).index();
        slide(idx);
    })
</script>