<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Limit oszczednosciowy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>

    <link href="{{ asset('/CSS/limitStyle.css') }}" rel="stylesheet">

</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

@if(session()->has('user'))
    @php
        $user = session('user');
    @endphp
    <nav class="navbar sticky-top navbar-expand-md menuBarContainer">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler01"
                    aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarToggler01">
                <a class="navbar-brand" href="/home">aplikacja Finansowa</a>
                <ul class="navbar-nav">

                    <li class="nav-item menuItem">
                        <a class="nav-link" href="/pracaFormularz">Praca</a>
                    </li>
                    <li class="nav-item menuItem">
                        <a class="nav-link" href="/limit">Limit</a>
                    </li>
                    <li class="nav-item menuItem">
                        <a class="nav-link" href="/celOszczedzaniaFormularz">Cel</a>
                    </li>

                    <li class="nav-item dropdown menuItem">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Dochody
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item active" href="/dodatkoweDochodyFormularz">Dodatkowe dochody</a>
                            </li>
                            <li><a class="dropdown-item" href="/staleDochodyFormularz">Stałe Dochody</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown menuItem">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Wydatki
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item active" href="/wydatkiFormularz">Dodatkowe wydatki</a></li>
                            <li><a class="dropdown-item" href="/staleWydatkiFormularz">Stałe Wydatki</a></li>

                        </ul>
                    </li>

                </ul>

            </div>
            @if(session()->has('user'))
                <div class="dropdown px-5 py-2">
                    <ul class="navbar-nav">
                        <li class="nav-item menuItem">
                            <a class="nav-link" href="/logout">Wyloguj się</a>
                        </li>
                    </ul>
                </div>
            @endif

        </div>
    </nav>
    <div class="container-fluid">
        <div class="row text-center">
            <h1>Tutaj ustal swój limit oszczędnościowy
                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#infoModal">
                    <i class="fas fa-info-circle"></i>
                </button>
            </h1>
            <!-- Przycisk otwierający modal -->

            <!-- Modal -->
            <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="infoModalLabel">Informacje o stronie Limit oszczędnościowy</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body1">
                            <p>Podstorna 'Limit oszczędnościowy' pozwala na ustawienie miesięcznej kwoty, którą
                                użytkownik planuje zaoszczędzić przez dany miesiąc</p>
                            <p>Wykres pokazujący udział ustawionego limitu oszczędnościowego w zaoszczędzonej kwocie
                                oraz dostęp do wartości zaoszczędzonej kwoty pomaga użytkownikowi w podejmowaniu
                                świadomych decyzji finansowych.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <form method="POST" action="{{ route('ustawLimit') }}">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="styled-box">
                        <label for="limit" class="form-label"><strong>Wyznacz swój limit
                                oszczędnościowy:</strong></label>
                        <input type="number" name="limit" id="limit" class="form-control"
                               value="{{ $uzytkownik->limit_oszczednosciowy ?? '' }}" placeholder="Wpisz swój limit"
                               min="0" max="{{ $oszczednosci }}" required>
                        <small class="text-muted">Musi być większy od 0 i mniejszy lub równy aktualnej kwocie
                            zaoszczędzonej.</small>
                        <br>
                        <button type="submit" class="btn btn-primary mt-3">Zapisz</button>

                        @if($oszczednosci != 0)
                            @php
                                $procent = 100 - round($uzytkownik->limit_oszczednosciowy / $oszczednosci * 100, 2);
                                $kolor = '';
                                if ($procent >= 50) {
                                    $kolor = 'text-success';
                                } elseif ($procent >= 10) {
                                    $kolor = 'text-warning';
                                } else {
                                    $kolor = 'text-danger';
                                }
                            @endphp

                            <p class="mb-0 {{ $kolor }}">Stan oszczędności: {{ $procent }}%</p>
                        @endif
                    </div>
                </div>

                <div class="col-md-4 mb-3 styled-column">
                    <div class="styled-content">
                        <h1 class="styled-header">Aktualna kwota zaoszczędzona z bieżącego miesiąca:</h1>
                        <h2 class="styled-amount">{{ $oszczednosci }}</h2>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div id="wykres">
                        <canvas id="wykres_kolowy"></canvas>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        @if($oszczednosci != 0)
        @php
            $limit_procent = round($uzytkownik->limit_oszczednosciowy / $oszczednosci * 100, 2);
            $aktualne_procent = 100 - $limit_procent;
        @endphp

        var dane = {
            labels: ['Limit oszczędnościowy', 'Aktualne oszczędności'],
            datasets: [{
                label: 'Udział w oszczędnościach',
                data: [{{ $limit_procent }}, {{ $aktualne_procent }}],
                backgroundColor: [
                    'rgba(178, 102, 255, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                ],
                hoverBackgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                ],
                borderWidth: 1
            }]
        };
        @endif

        var zapiszOpcje = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Udział limitu oszczędnościowego i aktualnych oszczędności'
                }
            }
        };

        var wykres_kolowy = document.getElementById('wykres_kolowy').getContext('2d');
        var wykres = new Chart(wykres_kolowy, {
            type: 'pie',
            data: dane,
            options: zapiszOpcje
        });
    </script>
</body>
@else
    <p>Musisz być zalogowany, aby zobaczyć tę stronę.</p>
    <p><a href="/login">Zaloguj się</a></p>
@endif
</html>
