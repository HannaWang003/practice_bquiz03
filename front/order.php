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
    <div><label>電影 </label><select name="movie" id="movie"></select></div>
    <div><label>日期 </label><select name="date" id="date"></select></div>
    <div><label>場次 </label><select name="session" id="session"></select></div>
    <br>
    <div class="ct"><button onclick="$('#select,#booking').toggle()">確定</button> <button>重置</button></div>
</div>
<div id="booking" style="display:none">
    <div class="ct"><button onclick="$('#select,#booking').toggle()">上一步</button> <button>確定</button></div>
</div>
<script>
getMovies();

function getMovies() {
    let id = <?= ($_GET['id']) ?? 0 ?>;
    $.get('./api/get_movies.php', {
        id
    }, function(movies) {
        $('#movie').html(movies);
        getDates($('#movie').val());
    })
}

function getDates(movie) {
    $.get('./api/get_dates.php', {
        movie
    }, function(dates) {
        $('#date').html(dates);
        getSessions($('#movie').val(), $('#date').val())
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
$("#movie").on("change", function() {
    getDates($(this).val());
})
$('#date').on('change', function() {
    getSessions($('#movie').val(), $(this).val())
})
</script>