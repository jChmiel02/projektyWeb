<?php

namespace App\Http\Controllers;

use App\Models\stale_wydatki;
use Illuminate\Http\Request;
use App\Models\uzytkownicy;


class staleWydatkiController extends Controller{


    public function staleWydatki(Request $request)
{
    $validatedData = $request->validate([
        'kategoria' => 'required|string',
        'kwota' => 'required|numeric',
        'nazwa' => 'required|string',
    ]);

    // Pobranie aktualnie zalogowanego użytkownika
    $user = session('user');
    $uzytkownik = uzytkownicy::find($user->getKey());
    $uzytkownik->id = $user->getKey();

    $czyIstnieje = stale_wydatki::where('nazwa', $validatedData['nazwa'])
        ->where('kategoria', $validatedData['kategoria'])
        ->where('uzytkownik_id', $user->getKey())
        ->first();
    if ($czyIstnieje) {
        // Aktualizacja istniejącego rekordu
        $czyIstnieje->kwota = $validatedData['kwota'];
        $czyIstnieje->save();
    } else {

    $stale_wydatki=new stale_wydatki();
    $stale_wydatki->kategoria = $validatedData['kategoria'];
    $stale_wydatki->kwota = $validatedData['kwota'];
    $stale_wydatki->nazwa = $validatedData['nazwa'];
    $stale_wydatki->uzytkownik_id = $user->getKey();
    $stale_wydatki->save();
    }
    return redirect('staleWydatkiFormularz');
}


    public function deleteStalyWydatek($id)
    {
        $stalyWydatek = stale_wydatki::findOrFail($id);
        $stalyWydatek->delete();

        return redirect('staleWydatkiFormularz');
    }
    public function updateStalyWydatek(Request $request)
    {
        $validatedData = $request->validate([
            'editKategoria' => 'required',
            'editKwota' => 'required|numeric',
            'editNazwa' => 'required',
            'editWydatekId' => 'required|exists:stale_wydatki,id',
        ]);

        $wydatek = stale_wydatki::find($validatedData['editWydatekId']);
        $wydatek->kategoria = $validatedData['editKategoria'];
        $wydatek->kwota = $validatedData['editKwota'];
        $wydatek->nazwa = $validatedData['editNazwa'];
        $wydatek->save();

        return redirect()->back()->with('success', 'Dane wydatku zostały zaktualizowane pomyślnie.');
    }
}
