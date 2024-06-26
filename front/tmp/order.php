<style>
    #select {
        width: 50%;
        margin: auto;
        text-align: center;
    }

    select {
        width: 80%;
    }

    label {
        width: 20%;
    }
</style>
<div id="select">
    <h3 class="ct">線上訂票</h3>
    <div class="order">
        <div>
            <label for="">電影:</label>
            <select name="movie" id="movie"></select>
        </div>
        <div>
            <label for="">日期:</label>
            <select name="date" id="date"></select>
        </div>
        <div>
            <label for="">場次:</label>
            <select name="session" id="session"></select>
        </div>
        <br>
        <div>
            <button onclick="$('#select,#booking').toggle()">確定</button>
            <button>重置</button>
        </div>
    </div>
</div>
<div id="booking" style="display:none">
    <button onclick="$('#select,#booking').toggle()">上一步</button>
    <button>重置</button>
</div>
<script>
    getMovies();

    function getMovies() {
        let id = <?= ($_GET['id']) ?? 0 ?>;
        $.get('./api/get_movies.php', {
            id
        }, (movies) => {
            $('#movie').html(movies);
            console.log($('#movie').val());
            getDates($('#movie').val());
        })
    }

    function getDates(id) {
        $.get('./api/get_dates.php', {
            id
        }, (dates) => {
            $('#date').html(dates)
            let movie = $('#movie').val();
            let date = $('#date').val();
            getSessions(movie, date);
        })
    }

    function getSessions(movie, date) {
        $.get('./api/get_sessions.php', {
            movie,
            date
        }, (sessions) => {
            $('#session').html(sessions);
        })

    }
    $('#movie').on('change', function() {
        getDates($(this).val());
    })
    $('#date').on('change', function() {
        getSessions($('#movie').val(), $(this).val())
    })
</script>