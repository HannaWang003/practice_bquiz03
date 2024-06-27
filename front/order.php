<style>
#select {
    width: 50%;
    margin: auto;
}

#select label {
    width: 20%;
}

#select select {
    width: 80%;
}
</style>
<h3 class="ct">線上訂票</h3>
<div id="select">
    <div><label>電影: </label><select name="movie" id="movie"></select></div>
    <div><label>日期: </label><select name="date" id="date"></select></div>
    <div><label>場次: </label><select name="session" id="session"></select></div>
    <br>
    <div class="ct"><button onclick="booking()">確定</button> <input type="reset" value="重置"></div>
</div>
<script>
getMovies();

function getMovies() {
    let id = <?= ($_GET['id']) ?? 0 ?>;
    $.get('./api/get_movies.php', {
        id
    }, function(movies) {
        $('#movie').html(movies);
        let movie = $('#movie').val();
        getDates(movie);
    })
}

function getDates(movie) {
    $.get('./api/get_dates.php', {
        movie
    }, function(dates) {
        $('#date').html(dates);
        let movie = $('#movie').val();
        let date = $('#date').val();
        getSessions(movie, date);
    })
}

function getSessions(movie, date) {
    $.get('./api/get_sessions.php', {
        movie,
        date
    }, function(sessions) {
        $('#session').html(sessions)
    })
}
$('#movie').on('change', function() {
    getDates($(this).val())
})
$('#date').on('change', function() {
    getSessions($('#movie').val(), $(this).val())
})
</script>
<div class="ct" id="booking" style="display:none">

</div>
<script>
function booking() {
    let order = {
        movie: $('#movie').val(),
        date: $('#date').val(),
        session: $('#session').val()
    }
    $.get('./api/booking.php', order, (booking) => {
        $('#booking').html(booking);
    })
    $('#select').hide();
    $('#booking').show();
}
</script>