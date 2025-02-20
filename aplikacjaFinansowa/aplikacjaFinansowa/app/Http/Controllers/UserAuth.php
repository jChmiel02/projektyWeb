<?php

namespace App\Http\Controllers;

use App\Models\praca;
use App\Models\wydatki;
use Illuminate\Http\Request;
use App\Models\uzytkownicy;
use Illuminate\Support\Facades\Hash; // Importuj Hash
use Illuminate\Support\Facades\Artisan; // Importuj Artisan
use Carbon\Carbon;

class UserAuth extends Controller
{
    function login(Request $req)
    {
        $data = $req->input();
        $nazwa = $data['nazwa'];
        $haslo = $data['haslo'];

        $user = uzytkownicy::where('nazwa', $nazwa)->first(); // Szukaj użytkownika po nazwie

        if (!$user || !Hash::check($haslo, $user->haslo)) { // Porównaj zaszyfrowane hasło z bazą danych
            return redirect('login')->with('error', 'Nieprawidłowa nazwa użytkownika lub hasło.');
        }

        // Sprawdź, czy minęło 30 dni od daty utworzenia konta
        if ($user->data_rozliczenia && Carbon::now()->gte(Carbon::parse($user->data_rozliczenia)->addDays(30))) {
            // Wykonaj polecenie user:clear-data
            Artisan::call('user:clear-data', ['user_id' => $user->id]);

            // Aktualizuj datę utworzenia konta o kolejne 30 dni
            $user->data_rozliczenia = Carbon::now()->toDateString();
            $user->save();
        }

        // Pobierz dane dotyczące dni pracy użytkownika
        $dniPracy = praca::where('uzytkownik_id', $user->id)->first();

        if ($dniPracy) {
            $user->zarobki = $dniPracy->zarobki;
            $user->liczba_godzin = $dniPracy->liczba_godzin;
        } else {
            $user->zarobki = 0;
        }

        $req->session()->put('user', $user);
        return redirect('home');
    }
}
