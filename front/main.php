<?php
$posters = $Poster->all(['sh' => 1], "order by rank");
?>
<div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <div class="rb tab" style="width:95%;">
        <style>
        .lists {
            width: 200px;
            height: 240px;
            margin: auto;
            overflow: hidden;
        }

        .item {
            width: 200px;
            height: 240px;
            text-align: center;
            display: none;
        }

        .item div img {
            width: 100%;
        }
        </style>
        <div class="lists">
            <?php
            foreach ($posters as $poster) {
            ?>

            <div class="item" data-ani=<?= $poster['ani'] ?>>
                <div><img src="./img/<?= $poster['img'] ?>" alt=""></div>
                <div><?= $poster['name'] ?></div>
            </div>
            <?php
            }
            ?>
        </div>
        <style>
        .controls {
            width: 420px;
            height: 100px;
            margin: auto;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btns {
            width: 360px;
            height: 100px;
            margin: auto;
            overflow: hidden;
            display: flex;
            align-items: center;
            position: relative;
        }

        .btn {
            width: 90px;
            height: 60px;
            text-align: center;
            font-size: 12px;
            flex-shrink: 0;
            position: relative;
        }

        .btn div img {
            width: 60px;
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
        </style>
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
<script>
let p = 0;
let now = 0;
let next = 0;
let total = $('.item').length;
let timer = setInterval(slide, 3000);

function slide(n) {
    let ani = $('.item').eq(now).data('ani');
    if (typeof(n) == "undefined") {
        next = now + 1;
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
            $('.item').eq(now).slideUp(1000, () => {
                $('.item').eq(next).slideDown(1000)
            })
            break;
        case 3:
            $('.item').eq(now).hide(1000, () => {
                $('.item').eq(next).show(1000)
            })
            break;
    }
    now = next;
}
$('.left,.right').on('click', function() {
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
$('.btns').hover(() => {
    clearInterval(timer);
}, () => {
    timer = setInterval(slide, 3000)
})
$('.btn').on('click', function() {
    let idx = $(this).index();
    slide(idx);
})
</script>
<style>
.movies {
    display: flex;
    flex-wrap: wrap;
}

.movie {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin: 0.5%;
    padding: 2%;
    width: 49%;

}
</style>
<div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;">
        <div class="movies">
            <?php
            $ondate = date("Y-m-d", strtotime("-2 days"));
            $today = date("Y-m-d");
            $div = 4;
            $total = $Movie->count("where `sh`=1 && `ondate` between '$ondate' and '$today'");
            $pages = ceil($total / $div);
            $now = ($_GET['p']) ?? 1;
            $start = ($now - 1) * $div;
            $movies = $Movie->all("where `sh`=1 && `ondate` between '$ondate' and '$today'", "order by rank limit $start,$div");
            foreach ($movies as $movie) {

            ?>
            <div class="movie">
                <div style="width:33%"><img src="./img/<?= $movie['poster'] ?>"
                        style="width:100%;border:3px solid #ccc"></div>
                <div style="width:63%">
                    <div><?= $movie['name'] ?></div>
                    <div style="font-size:13px">分級: <img src="./icon/03C0<?= $movie['level'] ?>.png"
                            style="width:25px;"></div>
                    <div style="font-size:13px">上映日期: <?= $movie['ondate'] ?></div>
                </div>
                <div style="width:100%;margin:10px auto;"><button
                        onclick="location.href='?do=intro&id=<?= $movie['id'] ?>'">劇情簡介</button> <button
                        onclick="location.href='?do=order&id=<?= $movie['id'] ?>'">線上訂票</button></div>
            </div>
            <?php
            }
            ?>
        </div>
        <br>
        <div class="ct">
            <?php
            for ($i = 1; $i <= $pages; $i++) {
                $style = ($i == $now) ? "font-size:20px" : "";
            ?>
            <a href="?do=main&p=<?= $i ?>" style="color:#ccc;text-decoration:none;<?= $style ?>"><?= $i ?></a>
            <?php
            }
            ?>
        </div>
    </div>
</div>