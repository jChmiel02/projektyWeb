<?php

namespace App\Http\Controllers;

use App\Models\wydatki;
use Illuminate\Http\Request;
use App\Models\uzytkownicy;
use Carbon\Carbon;

class wydatkiController extends Controller
{
    public function wydatki(Request $request)
    {
        $validatedData = $request->validate([
            'kwota' => 'required|numeric',
            'kategoria' => 'required|string',
            'nazwa' => 'required|string',
        ]);

        // Pobranie aktualnie zalogowanego użytkownika
        $user = session('user');
        $uzytkownik = Uzytkownicy::find($user->getKey());
        $uzytkownik->id = $user->getKey();


        $wydatki = new Wydatki();
        $wydatki->kwota = $validatedData['kwota'];
        $wydatki->kategoria = $validatedData['kategoria'];
        $wydatki->nazwa = $validatedData['nazwa'];
        $wydatki->uzytkownik_id = $user->getKey();
        $wydatki->save();


        return redirect('wydatkiFormularz');
    }
    public function deleteWydatek($id)
    {
        $wydatek = wydatki::findOrFail($id);
        $wydatek->delete();

        return redirect('wydatkiFormularz');
    }
    public function updateWydatek(Request $request)
    {
        $validatedData = $request->validate([
            'editKategoria' => 'required',
            'editKwota' => 'required|numeric',
            'editNazwa' => 'required',
            'editWydatekId' => 'required|exists:wydatki,id',
        ]);

        $wydatek = wydatki::find($validatedData['editWydatekId']);

        $wydatek->kategoria = $validatedData['editKategoria'];
        $wydatek->kwota = $validatedData['editKwota'];
        $wydatek->nazwa = $validatedData['editNazwa'];
        $wydatek->save();

        return redirect()->back()->with('success', 'Dane wydatku zostały zaktualizowane pomyślnie.');
    }
}
