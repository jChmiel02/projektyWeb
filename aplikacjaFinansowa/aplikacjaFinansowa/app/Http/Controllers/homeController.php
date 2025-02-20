<?php

namespace App\Http\Controllers;

use App\Models\dodatkowe_dochody;
use App\Models\stale_dochody;
use App\Models\stale_wydatki;
use App\Models\uzytkownicy;
use App\Models\wydatki;
use App\Models\wynagrodzenia;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function wyswietl()
    {
        $user = session('user');
        $uzytkownik = uzytkownicy::find($user->getKey());
        $uzytkownik->id = $user->getKey();
        $wydatki = wydatki::where('uzytkownik_id', $user->getKey())->sum('kwota');
        $stale_wydatki = stale_wydatki::where('uzytkownik_id', $user->getKey())->sum('kwota');
        $dodatkowe_dochody = dodatkowe_dochody::where('uzytkownik_id', $user->getKey())->sum('kwota');
        $wynagrodzenia = wynagrodzenia::where('uzytkownik_id', $user->getKey())->sum('wynagrodzenie_netto');
        $zaoszczedzone = uzytkownicy::where('id', $user->getKey())->sum('zaoszczedzone');
        $stale_dochody = stale_dochody::where('uzytkownik_id', $user->getKey())->sum('kwota');
        $oszczednosci = ($wynagrodzenia + $dodatkowe_dochody  + $stale_dochody) - ($wydatki + $stale_wydatki);

        // Przekazujemy do widoku home zmienne zadeklarowane wyżej zaoszczedzone i uzytkownik
        return view('home', compact('oszczednosci','zaoszczedzone', 'uzytkownik'));

    }
}
