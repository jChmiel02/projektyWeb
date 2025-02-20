<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rejestracja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">
    <link href="{{ asset('/CSS/wydatkiStyle.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
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
        <h1>Tutaj uzupełnij swoje wydatki
            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#infoModal">
                <i class="fas fa-info-circle"></i>
            </button>
        </h1>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Informacje o stronie Wydatki</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body1">
                    <p>Podstrona 'Wydatki' pozwala użytkownikowi wprowadzić typ wydatków, które nie są cykliczne. Są to
                        na przykład zakupy czy wydatki na rozrywke.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                </div>
            </div>
        </div>
    </div>
</div>
@if(session()->has('user'))
    @php
        $user = session('user');
        $wydatki = \App\Models\wydatki::where('uzytkownik_id', $user->getKey())->get();

        $unikalneKategorie = $wydatki->unique('kategoria')->pluck('kategoria');

        // Oblicz sumę dochodów dla każdej kategorii
        $sumaDochodowKategorii = [];
        foreach ($unikalneKategorie as $kategoria) {
            $dochodyKategorii = $wydatki->where('kategoria', $kategoria);
            $sumaDochodowKategorii[$kategoria] = $dochodyKategorii->sum('kwota');
        }
    @endphp
    <script>
        // Przekazanie danych o sumach dochodów kategorii do JavaScript
        const sumaDochodowKategorii = {!! json_encode($sumaDochodowKategorii) !!};

        // Przekazanie kategorii do JavaScript
        const kategorie = {!! json_encode($unikalneKategorie->toArray()) !!};
    </script>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-3 styled-column">

                <form method="POST" action="{{ route('wydatki') }}" id="wydatkiForm">
                    @csrf
                    <div class="styled-box">
                        <h2 class="styled-header">Dodaj nowy wydatek</h2>
                        <div class="mb-3">
                            <label for="nazwa" class="form-label"><strong>Podaj nazwę wydatku:</strong></label>
                            <input type="text" id="nazwa" name="nazwa" class="form-control"
                                   placeholder="Podaj nazwę wydatku" required>
                        </div>
                        <div class="mb-3">
                            <label for="kategoria" class="form-label"><strong>Wpisz kategorię wydatku:</strong></label>
                            <input type="text" name="kategoria" id="kategoria" class="form-control"
                                   placeholder="Wpisz kategorię wydatku:" required>
                        </div>
                        <div class="mb-3">
                            <label for="kwota" class="form-label"><strong>Kwota wydatku:</strong></label>
                            <div class="input-group">
                                <input type="number" name="kwota" id="kwota" class="form-control"
                                       placeholder="Kwota wydatku:" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Zapisz</button>
                    </div>
                </form>


                @if(count($wydatki) > 0)
                    @foreach($wydatki as $wydatek)

                        <div id="editFormContainer" style="display: none;">
                            <h2>Edycja wydatku:</h2>
                            <form method="POST" action="{{ route('updateWydatek', ['id' => $wydatek->id]) }}"
                                  id="editWydatekForm">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="editNazwa" class="form-label"><strong>Nazwa
                                                wydatku:</strong></label>
                                        <input type="text" id="editNazwa" name="editNazwa" class="form-control"
                                               required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="editKategoria" class="form-label"><strong>Kategoria
                                                wydatku:</strong></label>
                                        <input type="text" name="editKategoria" id="editKategoria" class="form-control"
                                               required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="editKwota" class="form-label"><strong>Kwota
                                                wydatku:</strong></label>
                                        <input type="number" name="editKwota" id="editKwota" class="form-control"
                                               required>
                                    </div>
                                </div>

                                <input type="hidden" name="editWydatekId" id="editWydatekId">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                @endif

            </div>

            <div class="col-md-6 mb-3 styled-column">
                @if(count($wydatki) > 0)
                    <h2>Twoje wydatki:</h2>
                    <ul class="list-group">
                        @foreach($wydatki as $wydatek)
                            <li class="list-group-item wydatekItem" data-wydatek-id="{{ $wydatek->id }}"
                                data-kategoria="{{ $wydatek->kategoria }}" data-kwota="{{ $wydatek->kwota }}"
                                data-nazwa="{{ $wydatek->nazwa }}">
                                <div class="row">
                                    <div class="col">
                                        <h5>Nazwa:</h5>
                                        <p>{{ $wydatek->nazwa }}</p>
                                    </div>
                                    <div class="col">
                                        <h5>Kategoria:</h5>
                                        <p>{{ $wydatek->kategoria }}</p>
                                    </div>
                                    <div class="col">
                                        <h5>Kwota:</h5>
                                        <p>{{ $wydatek->kwota }}</p>
                                    </div>
                                    <div class="col">
                                        <form method="POST"
                                              action="{{ route('deleteWydatek', ['id' => $wydatek->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Usuń</button>
                                        </form>
                                        <a href="#" class="btn btn-primary editWydatek" data-id="{{ $wydatek->id }}">Edytuj</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                        <button id="toggleChartBtn" class="btn btn-primary mt-3" data-bs-toggle="modal"
                                data-bs-target="#chartModal">
                            Wykres udziału kategorii
                        </button>
                    </ul>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="chartModal" tabindex="-1" aria-labelledby="chartModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="chartModalLabel">Wykres udziału kategorii</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <canvas id="myChart" width="1220" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @endif
    </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('/JS/wydatkiScript.js') }}"></script>

@else
    <p>Musisz być zalogowany, aby zobaczyć tę stronę.</p>
    <p><a href="/login">Zaloguj się</a></p>
@endif
