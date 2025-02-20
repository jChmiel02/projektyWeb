@php use App\Models\uzytkownicy; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cel oszczedzania</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link href="{{ asset('/CSS/celOszczedzaniaStyle.css') }}" rel="stylesheet">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
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
                        <li><a class="dropdown-item active" href="/dodatkoweDochodyFormularz">Dodatkowe dochody</a></li>
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
        <h1>Tutaj wpisz swoje cele oszczędnościowe
            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#infoModal">
                <i class="fas fa-info-circle"></i>

            </button>
        </h1>
        <!-- Przycisk otwierający modal -->

    </div>
    <!-- Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Informacje o stronie Cel oszczędzania</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body1">
                    <p>Podstrona 'Cel oszczędzania' pozwala użytkownikowi wprowadzić swoje własne cele oszczędzania i
                        monitorować w jakim procencie je zrealizował.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                </div>
            </div>
        </div>
    </div>
</div>
@if(session()->has('user'))
    <div id="celeOszczednoscioweContainer">
        @php
            $user = session('user');
            $cele = \App\Models\cel_oszczedzania::where('uzytkownik_id', $user->getKey())->get();
            $zaoszczedzone = uzytkownicy::where('id', $user->getKey())->sum('zaoszczedzone');

        @endphp
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-3 styled-column">
                    <form method="POST" action="{{ route('tworzenieCeluOszczedzania') }}" id="celeOszczednoscioweForm">
                        @csrf
                        <div class="mb-3">
                            <label for="nazwa" class="form-label"><strong>Nazwa celu:</strong></label>
                            <input type="text" name="nazwa_celu" id="nazwa" class="form-control"
                                   placeholder="Podaj nazwe celu" required>
                        </div>

                        <div class="mb-3">
                            <label for="kwota_celowa" class="form-label"><strong>Kwota celowa:</strong></label>
                            <input type="number" name="kwota_celowa" id="kwota_celowa" class="form-control"
                                   placeholder="Podaj kwote celu" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Dodaj cel oszczędnościowy</button>
                    </form>

                    @if(count($cele) > 0)
                        <div id="editCelContainer" style="display: none;">
                            <h2>Edycja celu oszczędnościowego:</h2>
                            <form method="POST" action="{{ route('updateCelOszczedzania', ['id' => $cele[0]->id]) }}"
                                  id="editCelForm">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="editNazwa" class="form-label"><strong>Nazwa celu:</strong></label>
                                    <input type="text" name="editNazwa" id="editNazwa" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="editKwota" class="form-label"><strong>Kwota celowa:</strong></label>
                                    <input type="number" name="editKwota" id="editKwota" class="form-control" required>
                                </div>

                                <input type="hidden" name="editCelId" id="editCelId">
                                <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
                            </form>
                        </div>

                    @endif
                </div>

                <div class="col-md-6 mb-3 styled-column">
                    @if(count($cele) > 0)
                        <h2>Aktualna kwota zaoszczędzona: {{ $zaoszczedzone }}</h2>
                        <h2>Twoje cele oszczędnościowe:</h2>
                        <ul class="list-group">
                            @foreach($cele as $cel)
                                <li class="list-group-item celItem" data-cel-id="{{ $cel->id }}"
                                    data-nazwa="{{ $cel->nazwa_celu }}" data-kwota="{{ $cel->kwota_celowa }}">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5>Nazwa:</h5>
                                            <p>{{ $cel->nazwa_celu }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h5>Kwota:</h5>
                                            <p>{{ $cel->kwota_celowa }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            @php
                                                $postep = min(($zaoszczedzone / $cel->kwota_celowa) * 100, 100); // Obliczanie postępu w procentach
                                                $postep = round($postep, 2); // Zaokrąglenie do dwóch miejsc po przecinku
                                            @endphp
                                            @if($postep >= 100)
                                                <p>
                                                    Zrealizowano:
                                                <div class="progress-bar progress-bar-striped bg-success">
                                                    <div class="progress-bar" role="progressbar"
                                                         aria-valuenow="{{ $postep }}" aria-valuemin="0"
                                                         aria-valuemax="100" style="width: {{ $postep }}%;">
                                                        {{ $postep }}%
                                                    </div>
                                                </div></p>
                                                <form method="POST" action="{{ route('usunCel', ['id' => $cel->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Usuń</button>
                                                </form>
                                                <form method="POST"
                                                      action="{{ route('zrealizujCel', ['id' => $cel->id]) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Zrealizuj cel</button>
                                                </form>
                                            @else
                                                <p>
                                                    Zrealizowano:
                                                <div class="progress progress-striped active">
                                                    <div class="progress-bar" role="progressbar"
                                                         aria-valuenow="{{ $postep }}" aria-valuemin="0"
                                                         aria-valuemax="100" style="width: {{ $postep }}%;">
                                                        {{ $postep }}%
                                                    </div>
                                                </div></p>
                                                <a href="#" class="btn btn-primary editCel" data-id="{{ $cel->id }}">Edytuj</a>
                                                <form method="POST" action="{{ route('usunCel', ['id' => $cel->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Usuń</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>


    </div>

@else
    <p>Musisz być zalogowany, aby zobaczyć tę stronę.</p>
    <p><a href="/login">Zaloguj się</a></p>
@endif
</body>
</html>
<script src="{{ asset('/JS/celOszczedzaniaScript.js') }}"></script>
