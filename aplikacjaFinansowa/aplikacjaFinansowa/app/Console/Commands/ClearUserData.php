<?php

namespace App\Console\Commands;

use App\Models\dochody_i_wydatki_miesieczne;
use App\Models\dodatkowe_dochody_miesieczne;
use App\Models\wydatki_miesieczne;
use Illuminate\Console\Command;
use App\Models\dodatkowe_dochody;
use App\Models\oszczednosci_miesieczne;
use App\Models\stale_dochody;
use App\Models\stale_wydatki;
use App\Models\uzytkownicy;
use App\Models\wydatki;
use App\Models\wynagrodzenia;

class ClearUserData extends Command
{
    protected $signature = 'user:clear-data {user_id}';

    protected $description = 'Clear user data and update savings for the specified user';

    public function handle()
    {
        // Znajdź użytkownika o podanym identyfikatorze
        $user = uzytkownicy::findOrFail($this->argument('user_id'));

        // Pobierz miesiąc poprzedzający datę rozliczenia
        $dataPoprzedniegoMiesiaca = now()->subMonth()->format('m');

        // Zaktualizuj dodatkowe dochody użytkownika w tabeli użytkowników
        $dodatkowe_dochody = dodatkowe_dochody::where('uzytkownik_id', $user->getKey())->sum('kwota');

        // Zaktualizuj oszczędności użytkownika w tabeli użytkowników
        $wydatki = wydatki::where('uzytkownik_id', $user->getKey())->sum('kwota');
        $stale_wydatki = stale_wydatki::where('uzytkownik_id', $user->getKey())->sum('kwota');
        $wynagrodzenia = wynagrodzenia::where('uzytkownik_id', $user->getKey())->sum('wynagrodzenie_netto');
        $zaoszczedzone = uzytkownicy::where('id', $user->getKey())->sum('zaoszczedzone');
        $stale_dochody = stale_dochody::where('uzytkownik_id', $user->getKey())->sum('kwota');
        $oszczednosci = ($wynagrodzenia + $dodatkowe_dochody + $stale_dochody) - ($wydatki + $stale_wydatki);
        $zaoszczedzone = $oszczednosci + $zaoszczedzone;

        // Zaktualizuj oszczędności miesięczne użytkownika dla miesiąca poprzedzającego datę rozliczenia
        $oszczednosciMiesieczne = oszczednosci_miesieczne::where('id_uzytkownika', $user->getKey())->first();

        if (!$oszczednosciMiesieczne) {
            $oszczednosciMiesieczne = new oszczednosci_miesieczne();
            $oszczednosciMiesieczne->id_uzytkownika = $user->getKey();
        }
        $nazwaKolumnyPoprzedniegoMiesiaca = 'oszczednosci_' . strtolower($dataPoprzedniegoMiesiaca);
        $oszczednosciMiesieczne->$nazwaKolumnyPoprzedniegoMiesiaca = $oszczednosci;
        $oszczednosciMiesieczne->save();

        // Zaktualizuj dodatkowe dochody miesięczne użytkownika dla miesiąca poprzedzającego datę rozliczenia
        $dodatkoweDochodyMiesieczne = dodatkowe_dochody_miesieczne::where('id_uzytkownika', $user->getKey())
            ->where('miesiac', $dataPoprzedniegoMiesiaca)
            ->first();

        if (!$dodatkoweDochodyMiesieczne) {
            $dodatkoweDochodyMiesieczne = new dodatkowe_dochody_miesieczne();
            $dodatkoweDochodyMiesieczne->id_uzytkownika = $user->getKey();
            $dodatkoweDochodyMiesieczne->miesiac = $dataPoprzedniegoMiesiaca;
        }

        $dodatkoweDochodyMiesieczne->suma_dochodu = $dodatkowe_dochody;

        // Znajdź i zapisz najwyższy dodatkowy dochód oraz jego nazwę dla miesiąca poprzedzającego datę rozliczenia
        $najwyzszyDochod = dodatkowe_dochody::where('uzytkownik_id', $user->getKey())
            ->orderBy('kwota', 'desc')
            ->first();

        if ($najwyzszyDochod) {
            $dodatkoweDochodyMiesieczne->najwyzszy_dochod_nazwa = $najwyzszyDochod->nazwa;
            $dodatkoweDochodyMiesieczne->najwyzszy_dochod_kwota = $najwyzszyDochod->kwota;
        }

        $dodatkoweDochodyMiesieczne->save();

        // Analogicznie dla wydatku tak jak wyżej
        $wydatkiMiesieczne = wydatki_miesieczne::where('id_uzytkownika', $user->getKey())
            ->where('miesiac', $dataPoprzedniegoMiesiaca)
            ->first();
        if (!$wydatkiMiesieczne) {
            $wydatkiMiesieczne = new wydatki_miesieczne();
            $wydatkiMiesieczne->id_uzytkownika = $user->getKey();
            $wydatkiMiesieczne->miesiac = $dataPoprzedniegoMiesiaca;
        }
        $wydatkiMiesieczne->suma_wydatkow = $wydatki;
        $najwyzszyWydatek = wydatki::where('uzytkownik_id', $user->getKey())
            ->orderBy('kwota', 'desc')
            ->first();

        if ($najwyzszyWydatek) {
            $wydatkiMiesieczne->najwyzszy_wydatek_nazwa = $najwyzszyWydatek->nazwa;
            $wydatkiMiesieczne->najwyzszy_wydatek_kwota = $najwyzszyWydatek->kwota;
        }

        $wydatkiMiesieczne->save();

        // Dochody i wydatki analogicznie jak wyżej
        $dochody_i_wydatki = dochody_i_wydatki_miesieczne::where('id_uzytkownika', $user->getKey())
            ->where('miesiac', $dataPoprzedniegoMiesiaca)
            ->first();

        if (!$dochody_i_wydatki) {
            $dochody_i_wydatki = new dochody_i_wydatki_miesieczne();
            $dochody_i_wydatki->id_uzytkownika = $user->getKey();
            $dochody_i_wydatki->miesiac = $dataPoprzedniegoMiesiaca;
        }

        $dochody_i_wydatki->suma_dochodu = $dodatkowe_dochody + $stale_dochody;
        $dochody_i_wydatki->suma_wydatku = $wydatki + $stale_wydatki;
        $dochody_i_wydatki->save();
        $user->zaoszczedzone = $zaoszczedzone;
        $user->save();

        // Wyczyść dane użytkownika z tabel dodatkowe_dochody i wydatki
        dodatkowe_dochody::where('uzytkownik_id', $user->getKey())->delete();
        wydatki::where('uzytkownik_id', $user->getKey())->delete();

        $this->info('User data cleared and savings updated successfully.');
    }
}
