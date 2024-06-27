<?php
include_once "db.php";
$movieName = $Movie->find($_GET['movie'])['name'];
$date = $_GET['date'];
$session = $_GET['session'];
$ords = $Order->all(['movie' => $movieName, 'date' => $date, 'session' => $session]);
$seats = [];
foreach ($ords as $ord) {
    $tmp = unserialize($ord['seats']);
    $seats = array_merge($seats, $tmp);
}
?>
<style>
#room {
    width: 540px;
    height: 370px;
    margin: auto;
    padding: 19px 112px 0px 112px;
    box-sizing: border-box;
    background: url("../icon/03D04.png");
    background-repeat: no-repeat;
    background-position: center;
}

.seats {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.seat {
    width: 63px;
    height: 85px;
    position: relative;
}

.chk {
    position: absolute;
    bottom: 2px;
    right: 2px;
}

.info {
    width: 60%;
    margin: auto;
    text-align: start;
}
</style>
<div id="room">
    <div class="seats">
        <?php
        for ($i = 1; $i <= 20; $i++) {
            $col = ceil($i / 5);
            $num = ($i - 1) % 5 + 1;
        ?>
        <div class="seat">
            <div><?= $col . "排" . $num . "號" ?></div>
            <div>
                <?php
                    if (in_array($i, $seats)) {
                    ?>
                <img src="../icon/03D03.png" alt="">
                <?php
                    } else {
                    ?>
                <img src="../icon/03D02.png" alt="">
                <?php
                    }
                    ?>
            </div>
            <div>
                <?php
                    if (!in_array($i, $seats)) {
                    ?>
                <input type="checkbox" name="chk" value="<?= $i ?>" class="chk">
                <?php
                    }
                    ?>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>
<div class="info">
    <div>您選擇的電影是: <span><?= $movieName ?></span></div>
    <div>您選擇的時刻是: <span><?= $date . " " . $session ?></span></div>
    <div>您已勾選<span id="tickets">0</span>張票，最多可購買四張票</div>
</div>
<br>
<div class="ct">
    <button onclick="$('#select,#booking').toggle()">上一步</button>
    <button onclick="checkout()">訂購</button>
</div>
<script>
let seats = new Array();
$('.chk').on('change', function() {
    if ($(this).prop('checked')) {
        if (seats.length + 1 <= 4) {
            seats.push($(this).val());
        } else {
            $(this).prop("checked", false);
        }
    } else {
        seats.splice(seats.indexOf($(this).val()), 1)
    }
    $('#tickets').text(seats.length);
})

function checkout() {
    $.post('../api/checkout.php', {
        movie: '<?= $movieName; ?>',
        date: '<?= $date; ?>',
        session: '<?= $session; ?>',
        qt: seats.length,
        seats
    }, (no) => {
        location.href = `?do=result&no=${no}`
    })
}
</script>