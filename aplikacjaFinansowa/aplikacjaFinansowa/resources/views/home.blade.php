<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikacja Finansowa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">
    <link href="{{ asset('/CSS/homeStyle.css') }}" rel="stylesheet">

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

@if(session()->has('user'))
    @php
        $user = session('user');
        $dodatkoweDochody = \App\Models\dodatkowe_dochody::where('uzytkownik_id', $user->getKey())->get();
        $staleDochody = \App\Models\stale_dochody::where('uzytkownik_id', $user->getKey())->get();
        $wynagrodzenia = \App\Models\wynagrodzenia::where('uzytkownik_id', $user->getKey())->get();
        $wydatki = \App\Models\wydatki::where('uzytkownik_id', $user->getKey())->get();
        $staleWydatki = \App\Models\stale_wydatki::where('uzytkownik_id', $user->getKey())->get();
        $dodatkoweDochodyMiesieczne= \App\Models\dodatkowe_dochody_miesieczne::where('id_uzytkownika', $user->getKey())->get();
        $dochody_i_wydatki=\App\Models\dochody_i_wydatki_miesieczne::where('id_uzytkownika', $user->getKey())->get();
        $oszczednosciMiesieczne=\App\Models\oszczednosci_miesieczne::where('id_uzytkownika', $user->getKey())->get();
        $wydatkiMiesieczne=App\Models\wydatki_miesieczne::where('id_uzytkownika', $user->getKey())->get();

        // Sumowanie danych dochodów z różnych tabel
        $sumaDodatkowychDochodow = $dodatkoweDochody->sum('kwota');
        $sumaStalychDochodow = $staleDochody->sum('kwota');
        $sumaWynagrodzen = $wynagrodzenia->sum('wynagrodzenie_netto');

        // Sumowanie danych wydatków z różnych tabel
        $sumaDodatkowcyhWydatkow = $wydatki->sum('kwota');
        $sumaStalychWydatkow = $staleWydatki->sum('kwota');

$sumyDochodowMiesieczne = [];
for ($i = 1; $i <= 12; $i++) {
    // Inicjalizacja sumy dochodu dla danego miesiąca
    $sumaDochodu = 0;

    // Iteracja przez dane, aby dodać dochody dla danego miesiąca
    foreach ($dodatkoweDochodyMiesieczne as $dochod) {
        if ($dochod->miesiac == $i) {
            $sumaDochodu += $dochod->suma_dochodu;
        }
    }

    // Dodanie sumy dochodu dla danego miesiąca do tablicy
    $sumyDochodowMiesieczne[] = $sumaDochodu;
}

// Przetwarzanie danych do postaci, która będzie odpowiednia do wygenerowania wykresu
$najwyzszeDochodyNazwy = [];
$najwyzszeDochodyKwoty = [];
for ($i = 1; $i <= 12; $i++) {
    // Inicjalizacja danych dla danego miesiąca
    $nazwaNajwyzszegoDochodu = '';
    $kwotaNajwyzszegoDochodu = 0;

    // Szukanie najwyższego dochodu dla danego miesiąca
    foreach ($dodatkoweDochodyMiesieczne as $dochod) {
        if ($dochod->miesiac == $i && $dochod->najwyzszy_dochod_kwota > $kwotaNajwyzszegoDochodu) {
            $nazwaNajwyzszegoDochodu = $dochod->najwyzszy_dochod_nazwa;
            $kwotaNajwyzszegoDochodu = $dochod->najwyzszy_dochod_kwota;
        }
    }

    // Dodanie danych dla danego miesiąca do tablic
    $najwyzszeDochodyNazwy[] = $nazwaNajwyzszegoDochodu;
    $najwyzszeDochodyKwoty[] = $kwotaNajwyzszegoDochodu;
}

// Wydatki miesieczne
// Przetwarzanie danych do postaci, która będzie odpowiednia do wygenerowania wykresu
$najwyzszeWydatkiNazwy = [];
$najwyzszeWydatkiKwoty = [];
for ($i = 1; $i <= 12; $i++) {
    // Inicjalizacja danych dla danego miesiąca
    $nazwaNajwyzszegoWydatku = '';
    $kwotaNajwyzszegoWydatku = 0;

    // Szukanie najwyższego dochodu dla danego miesiąca
    foreach ($wydatkiMiesieczne as $wydatek) {
        if ($wydatek->miesiac == $i && $wydatek->najwyzszy_wydatek_kwota > $kwotaNajwyzszegoWydatku) {
            $nazwaNajwyzszegoWydatku = $wydatek->najwyzszy_wydatek_nazwa;
            $kwotaNajwyzszegoWydatku = $wydatek->najwyzszy_wydatek_kwota;
        }
    }

    // Dodanie danych dla danego miesiąca do tablic
    $najwyzszeWydatkiNazwy[] = $nazwaNajwyzszegoWydatku;
    $najwyzszeWydatkiKwoty[] = $kwotaNajwyzszegoWydatku;
}

// Przetwarzanie danych do postaci, która będzie odpowiednia do wygenerowania wykresu
$labels = [];
$sumaDochodow = [];
$sumaWydatkow = [];
$różnicaDochodowWydatkow = [];

foreach ($dochody_i_wydatki as $dane) {
    $labels[] = $dane->miesiac;
    $sumaDochodow[] = $dane->suma_dochodu;
    $sumaWydatkow[] = $dane->suma_wydatku;
    $różnicaDochodowWydatkow[] = $dane->suma_dochodu - $dane->suma_wydatku;
}



// Przetwarzanie danych oszczędności miesięcznych do postaci odpowiedniej do wygenerowania wykresu
$oszczednosciMiesieczneLabels = [];
$oszczednosciMiesieczneKwoty = [];

// Tablica z nazwami miesięcy
$miesiace = [
    'Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec',
    'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'
];

// Iteracja przez nazwy miesięcy i pobranie odpowiednich wartości oszczędności z rekordów w tabeli
foreach ($miesiace as $index => $miesiac) {
    $nazwaKolumny = 'oszczednosci_' . str_pad($index + 1, 2, "0", STR_PAD_LEFT);

    // Sprawdzenie, czy istnieją dane dla danego miesiąca
    if (isset($oszczednosciMiesieczne[0][$nazwaKolumny])) {
        $kwotaOszczednosci = $oszczednosciMiesieczne[0][$nazwaKolumny];
        $oszczednosciMiesieczneLabels[] = $miesiac;
        $oszczednosciMiesieczneKwoty[] = $kwotaOszczednosci;
    } else {
        // Jeśli brak danych, dodaj pustą wartość do tablicy
        $oszczednosciMiesieczneLabels[] = $miesiac;
        $oszczednosciMiesieczneKwoty[] = null;
    }
}

// Przekazanie danych do JavaScript
echo "<script>
    const najwyzszeWydatkiNazwy = " . json_encode($najwyzszeWydatkiNazwy) . ";
    const najwyzszeWydatkiKwoty = " . json_encode($najwyzszeWydatkiKwoty) . ";
        const najwyzszeDochodyNazwy = " . json_encode($najwyzszeDochodyNazwy) . ";
    const najwyzszeDochodyKwoty = " . json_encode($najwyzszeDochodyKwoty) . ";
    const sumyDochodow = " . json_encode($sumyDochodowMiesieczne) . ";
const labels = " . json_encode($labels) . ";
    const sumaDochodow = " . json_encode($sumaDochodow) . ";
    const sumaWydatkow = " . json_encode($sumaWydatkow) . ";
    const różnicaDochodowWydatkow = " . json_encode($różnicaDochodowWydatkow) . ";
const oszczednosciMiesieczneLabels = " . json_encode($oszczednosciMiesieczneLabels) . ";
    const oszczednosciMiesieczneKwoty = " . json_encode($oszczednosciMiesieczneKwoty) . ";
</script>";

    @endphp
    <script>
        // Przekazanie danych dochodów do JavaScript
        const dochody = {
            dodatkoweDochody: {!! json_encode($sumaDodatkowychDochodow) !!},
            staleDochody: {!! json_encode($sumaStalychDochodow) !!},
            wynagrodzenia: {!! json_encode($sumaWynagrodzen) !!}
        };

        // Przekazanie danych wydatków do JavaScript
        const wydatki = {
            wydatki: {!! json_encode($sumaDodatkowcyhWydatkow) !!},
            staleWydatki: {!! json_encode($sumaStalychWydatkow) !!}
        };

    </script>


    <div class="container mt-5 border p-4 shadow">
        <div class="container mt-5 border p-4 shadow">
            <div class="row">
                <div class="col-md-4">
                    <h2 class="category-title">Wykresy dla dochodów i wydatków</h2>
                    <button type="button" class="btn btn-primary styled-button" data-bs-toggle="modal"
                            data-bs-target="#wykresDochodowModal">
                        Otwórz Wykres Dochodów
                    </button>
                    <button type="button" class="btn btn-primary styled-button" data-bs-toggle="modal"
                            data-bs-target="#wykresWydatkowModal">
                        Otwórz Wykres Wydatków
                    </button>
                    <button type="button" class="btn btn-primary styled-button" data-bs-toggle="modal"
                            data-bs-target="#wykresDochodowWydatkowModal">
                        Otwórz Wykres Dochodów i Wydatków miesięcznych
                    </button>
                    <button type="button" class="btn btn-primary styled-button" data-bs-toggle="modal"
                            data-bs-target="#wykresRoznicaModal">
                        Otwórz Wykres Różnicy Dochodów i Wydatków
                    </button>
                </div>
                <div class="col-md-4 border-start border-end">
                    <div class="styled-content">
                        <h1 class="styled-header">Całkowita kwota zaoszczędzona podczas korzystania z aplikacji:</h1>
                        <h2 class="styled-amount">{{ $zaoszczedzone }}</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <h2 class="category-title">Wykresy dla dodatkowych dochodów miesięcznych</h2>
                    <button type="button" class="btn btn-primary styled-button" data-bs-toggle="modal"
                            data-bs-target="#wykresDochodowMModal">
                        Otwórz Wykres Dodatkowych Dochodów Miesięcznych
                    </button>
                    <button type="button" class="btn btn-primary styled-button" data-bs-toggle="modal"
                            data-bs-target="#wykresNajwyzszychDochodowModal">
                        Otwórz Wykres Najwyższych Kwot i Nazw Dochodów
                    </button>
                    <button type="button" class="btn btn-primary styled-button" data-bs-toggle="modal"
                            data-bs-target="#wykresNajwyzszychDochodowMModal">
                        Otwórz Wykres Najwyższych Kwot Dochodów Miesięcznych
                    </button>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <h2 class="category-title">Wykresy dla najwyższych wydatków miesięcznych</h2>
                <button type="button" class="btn btn-primary styled-button" data-bs-toggle="modal"
                        data-bs-target="#wykresNajwyzszychWydatkowMModal">
                    Otwórz Wykres Najwyższych Wydatków Miesięcznych
                </button>
                <button type="button" class="btn btn-primary styled-button" data-bs-toggle="modal"
                        data-bs-target="#wykresNajwyzszychWydatkiModal">
                    Otwórz Wykres Najwyższych Kwot Wydatków i Nazw Wydatków
                </button>
                <button type="button" class="btn btn-primary styled-button" data-bs-toggle="modal"
                        data-bs-target="#wykresWydatkiMModal">
                    Otwórz Wykres Najwyższych Kwot Wydatków Miesięcznych
                </button>
            </div>
            <div class="col-md-4 border-start border-end">
                <div class="styled-content">
                    <h1 class="styled-header">Aktualna kwota zaoszczędzona z bieżącego miesiąca:</h1>
                    <h2 class="styled-amount">{{ $oszczednosci }}</h2>
                </div>
            </div>
            <div class="col-md-4">
                <h2 class="category-title">Wykres dla zaoszczędzonych kwot miesięcznych</h2>
                <button type="button" class="btn btn-primary styled-button" data-bs-toggle="modal"
                        data-bs-target="#oszczednosciMiesieczneModal">
                    Otwórz Wykres Oszczędności Miesięcznych
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="wykresDochodowModal" tabindex="-1" aria-labelledby="wykresDochodowModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wykresDochodowModalLabel">Wykres Dochodów</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <canvas id="wykresDochodow"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="wykresWydatkowModal" tabindex="-1" aria-labelledby="wykresWydatkowModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wykresWydatkowModalLabel">Wykres Wydatków</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <canvas id="wykresWydatkow"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="wykresDochodowMModal" tabindex="-1" aria-labelledby="wykresDochodowMModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wykresDochodowMModalLabel">Wykres Dochodów Miesięcznych</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <canvas id="wykresDochodowM"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="wykresWydatkiMModal" tabindex="-1" aria-labelledby="wykresWydatkiMModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wykresWydatkiMModalLabel">Wykres Wydatkow Miesięcznych</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <canvas id="wykresWydatkiM"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="wykresNajwyzszychDochodowModal" tabindex="-1"
         aria-labelledby="wykresNajwyzszychDochodowModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wykresNajwyzszychDochodowModalLabel">Wykres Najwyższych Dochodów</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <canvas id="wykresNajwyzszychDochodow"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="wykresNajwyzszychDochodowMModal" tabindex="-1"
         aria-labelledby="wykresNajwyzszychDochodowMModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wykresNajwyzszychDochodowMModalLabel">Wykres Najwyższych Dochodów
                        Miesięcznych</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <canvas id="wykresNajwyzszychDochodowM"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="wykresDochodowWydatkowModal" tabindex="-1"
         aria-labelledby="wykresDochodowWydatkowModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wykresDochodowWydatkowModalLabel">Wykres Dochodów i Wydatków</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <canvas id="wykresDochodowWydatkow"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="wykresRoznicaModal" tabindex="-1" aria-labelledby="wykresRoznicaModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wykresRoznicaModalLabel">Wykres Różnicy Pomiędzy Dochodami a
                        Wydatkami</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <canvas id="wykresRoznica"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="wykresNajwyzszychWydatkowMModal" tabindex="-1"
         aria-labelledby="wykresNajwyzszychWydatkowMModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wykresNajwyzszychWydatkowMModalLabel">Wykres Najwyższych Wydatków
                        Miesięcznych</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <canvas id="wykresNajwyzszychWydatkowM"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="wykresNajwyzszychWydatkiModal" tabindex="-1"
         aria-labelledby="wykresNajwyzszychWydatkiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wykresNajwyzszychWydatkiModalLabel">Wykres Najwyższych Wydatków</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <canvas id="wykresNajwyzszychWydatki"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="oszczednosciMiesieczneModal" tabindex="-1"
         aria-labelledby="oszczednosciMiesieczneModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="oszczednosciMiesieczneModalLabel">Wykres Oszczędności Miesięcznych</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <canvas id="oszczednosciMiesieczneChart"></canvas>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('/JS/homeScript.js') }}"></script>
