<?php

namespace App\Http\Controllers;

use App\Models\dodatkowe_dochody;
use App\Models\stale_dochody;
use App\Models\stale_wydatki;
use App\Models\uzytkownicy;
use App\Models\wydatki;
use App\Models\wynagrodzenia;
use Illuminate\Http\Request;

class limitController extends Controller
{
    public function limit()
    {
        // Pobranie aktualnie zalogowanego użytkownika
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
        $zaoszczedzoneAktualne=$oszczednosci+$zaoszczedzone;

        return view('limit', compact('oszczednosci','zaoszczedzoneAktualne', 'uzytkownik'));
    }

    public function ustawLimit(Request $request)
    {
        $walidacjaDanych = $request->validate([
            'limit' => 'required|numeric|min:0',
        ]);
        $user = session('user');

        // Ustawienie limitu oszczędnościowego dla użytkownika
        $uzytkownik = uzytkownicy::find($user->getKey());
        $uzytkownik->limit_oszczednosciowy = $walidacjaDanych['limit'];
        $uzytkownik->save();

        return redirect()->route('limit')->with('success', 'Limit oszczędnościowy został pomyślnie ustawiony.');
    }

}
