<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Praca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link href="{{ asset('/CSS/pracaStyle.css') }}" rel="stylesheet">

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
        <h1>Tutaj wpisz swoje prace
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
                        <h5 class="modal-title" id="infoModalLabel">Informacje o stronie Praca</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body1">
                        <p>Podstrona 'Praca' umożliwia użytkownikowi dodanie wszystkich jego miejsc pracy.
                            Dzięki przyciskowi wykresu, znajdującemu się na początku każdej pracy, możliwe
                            jest wizualne przedstawienie kwot podatków, które użytkownik płaci za pracę.</p>
                        <p>Poprzez wypełnienie formularza zawierającego nazwę pracy, jej typ, ilość
                            przepracowanych dni w miesiącu, miesięczną liczbę przepracowanych godzin
                            oraz stawkę godzinową, użytkownik może dodać swoją pracę</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session()->has('user'))
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div id="pracaContainer">
        @php
            $user = session('user');
            $praca = \App\Models\praca::where('uzytkownik_id', $user->getKey())->get();
            $wynagrodzenia = [];
            foreach ($praca as $pracaItem) {
                $wynagrodzeniaPraca = \App\Models\wynagrodzenia::where('uzytkownik_id', $user->getKey())
                    ->where('id_pracy', $pracaItem->id)
                    ->get();
                foreach ($wynagrodzeniaPraca as $wynagrodzenie) {
                    $wynagrodzenie->id_pracy = $pracaItem->id;
                    $wynagrodzenia[] = $wynagrodzenie;
                }
            }
        @endphp
        <script>
            const wynagrodzenia = {!! json_encode($wynagrodzenia) !!};
        </script>
        <div class="container">
            <form method="POST" action="{{ route('zapiszDane') }}" id="dodajPracaForm">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nazwa" class="form-label"><strong>Nazwa pracy:</strong></label>
                            <input type="text" name="nazwa" id="nazwa" placeholder="Nazwa pracy" class="form-control"
                                   required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="typ_umowy" class="form-label"><strong>Typ umowy:</strong></label>
                            <select name="typ_umowy" id="typ_umowy" class="form-select" required
                                    onchange="showStudentCheckbox()">
                                <option value="" disabled selected>Wybierz typ umowy</option>
                                <option value="umowa_o_prace">Umowa o pracę</option>
                                <option value="umowa_zlecenie">Umowa-zlecenie</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="ilosc_dni" class="form-label"><strong>Ilość dni:</strong></label>
                            <input type="number" name="ilosc_dni" id="ilosc_dni"
                                   placeholder="Ilość przepracowanych dni miesiącu" class="form-control" required/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="liczba_godzin" class="form-label"><strong>Liczba godzin:</strong></label>
                            <input type="number" name="liczba_godzin" id="liczba_godzin"
                                   placeholder="Dzienna liczba godzin" class="form-control" required/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="stawka_godzinowa" class="form-label"><strong>Stawka godzinowa:</strong></label>
                            <input type="number" name="stawka_godzinowa" id="stawka_godzinowa"
                                   placeholder="Stawka godzinowa" class="form-control" required/>
                        </div>
                    </div>
                </div>
                <div id="student_uczen_block" class="mb-3" style="display: none;">
                    <input type="checkbox" id="student_uczen" name="student_uczen" class="form-check-input">
                    <label for="student_uczen" class="form-check-label">Jestem studentem/ucznem</label>
                    <br>
                </div>
                <button type="submit" class="btn btn-primary">Zapisz</button>
            </form>

            @if(count($praca) > 0)
                <h2>Twoje prace:</h2>
                <ul class="list-group">
                    @foreach($praca as $prace)
                        <li class="list-group-item pracaItem" data-praca-id="{{ $prace->id }}"
                            data-nazwa="{{ $prace->nazwa }}"
                            data-liczba_godzin="{{ $prace->liczba_godzin }}"
                            data-stawka_godzinowa="{{ $prace->stawka_godzinowa }}"
                            data-ilosc_dni="{{ $prace->ilosc_dni }}" data-typ_umowy="{{ $prace->typ_umowy }}"
                            data-student_uczen="{{ $prace->student_uczen }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <button type="button" class="btn btn-info viewChart rounded-circle"
                                            data-praca-id="{{ $prace->id }}" data-bs-toggle="modal"
                                            data-bs-target="#chartModal" title="Wyświetl wykres wynagrodzenia">
                                        <i class="fas fa-chart-pie"></i>
                                    </button>
                                </div>
                                <div>
                                    <h5>Nazwa:</h5>
                                    <p>{{ $prace->nazwa }}</p>
                                </div>
                                <div>
                                    <h5>Typ umowy:</h5>
                                    <p>{{ $prace->typ_umowy }}</p>
                                </div>
                                <div>
                                    <h5>Ilość dni:</h5>
                                    <p>{{ $prace->ilosc_dni }}</p>
                                </div>
                                <div>
                                    <h5>Liczba godzin:</h5>
                                    <p>{{ $prace->liczba_godzin }}</p>
                                </div>
                                <div>
                                    <h5>Stawka godzinowa:</h5>
                                    <p>{{ $prace->stawka_godzinowa }}</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <form method="POST" action="{{ route('usunPraca', ['id' => $prace->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mr-2">Usuń</button>
                                </form>
                                <a href="#" class="btn btn-primary editPraca" data-id="{{ $prace->id }}">Edytuj</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="chartModal" tabindex="-1" aria-labelledby="chartModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="chartModalLabel">Wykres wynagrodzenia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <canvas id="salaryChart" width="400" height="400"></canvas>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="editFormContainer" style="display: none;">
            <h2>Edycja wydatku:</h2>
            <form method="POST" action="{{ route('edytujPraca', ['id' => $prace->id]) }}" id="editPracaForm">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="edit_nazwa" class="form-label"><strong>Podaj nazwę:</strong></label>
                            <input type="text" id="edit_nazwa" name="nazwa" placeholder="Podaj nazwę"
                                   class="form-control" required>
                            <span id="edit-nazwa-feedback" class="mt-2"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="edit_typ_umowy" class="form-label"><strong>Typ umowy:</strong></label>
                            <select name="typ_umowy" id="edit_typ_umowy" class="form-select" required
                                    onchange="showStudentCheckboxEdit()">
                                <option value="" disabled selected>Wybierz typ umowy</option>
                                <option value="umowa_o_prace">Umowa o pracę</option>
                                <option value="umowa_zlecenie">Umowa-zlecenie</option>
                            </select>
                            <span id="edit-typ-umowy-feedback" class="mt-2"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="edit_ilosc_dni" class="form-label"><strong>Liczba dni:</strong></label>
                            <input type="number" name="ilosc_dni" id="edit_ilosc_dni" class="form-control" required>
                            <span id="edit-ilosc-dni-feedback" class="mt-2"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="edit_liczba_godzin" class="form-label"><strong>Ilość godzin:</strong></label>
                            <input type="number" name="liczba_godzin" id="edit_liczba_godzin" class="form-control"
                                   required>
                            <span id="edit-liczba-godzin-feedback" class="mt-2"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="edit_stawka_godzinowa" class="form-label"><strong>Stawka
                                    godzinowa:</strong></label>
                            <input type="number" name="stawka_godzinowa" id="edit_stawka_godzinowa"
                                   placeholder="Stawka godzinowa" class="form-control" required>
                            <span id="edit-stawka-godzinowa-feedback" class="mt-2"></span>
                        </div>
                    </div>
                </div>
                <div id="student_uczen_block_edit" class="mb-3" style="display: none;">
                    <input type="checkbox" id="edit_student_uczen" name="student_uczen" class="form-check-input">
                    <label for="edit_student_uczen" class="form-check-label">Jestem studentem/ucznem</label>
                    <br>
                </div>
                <input type="hidden" name="editPracaId" id="editPracaId">
                <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
            </form>

        </div>
    </div>
@endif
@else
    <p>Musisz być zalogowany, aby zobaczyć tę stronę.</p>
    <p><a href="/login">Zaloguj się</a></p>
@endif
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('/JS/pracaScript.js') }}">
    const wynagrodzenia = {!! json_encode($wynagrodzenia) !!};
</script>

