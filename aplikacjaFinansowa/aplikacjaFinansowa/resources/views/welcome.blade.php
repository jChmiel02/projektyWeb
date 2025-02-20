<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje Finanse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">
    <link href="{{ asset('/CSS/welcomeStyle.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6 text-center">
            <h1>Witaj w aplikacji do wspomagania finansów osobistych</h1>
            <p>Aby korzystać z aplikacji, zaloguj się lub załóż konto:</p>
            <a href="/login" class="btn btn-login">Login</a>
            <a href="/rejestracja" class="btn btn-register">Załóż konto</a>
        </div>
        <div class="col-md-6">
            <canvas id="myChart" style="width: 100%; height: auto;"></canvas>
        </div>
    </div>
</div>

<script>
    var chartData = {
        type: 'pie',
        data: {
            datasets: [{
                data: [12, 10, 3, 5, 2, 3],
                backgroundColor: [
                    'red',
                    'blue',
                    'yellow',
                    'green',
                    'purple',
                    'orange'
                ],
                borderWidth: 1
            }]
        },
        options: {}
    };

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, chartData);

    var chartTypes = ['pie', 'doughnut'];
    var currentIndex = 0;

    setInterval(function() {
        currentIndex = (currentIndex + 1) % chartTypes.length;
        chartData.type = chartTypes[currentIndex];
        myChart.destroy();
        myChart = new Chart(ctx, chartData);
    }, 10000);
</script>

</body>
</html>
