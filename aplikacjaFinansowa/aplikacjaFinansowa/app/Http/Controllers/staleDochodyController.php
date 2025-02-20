<?php

namespace App\Http\Controllers;

use App\Models\stale_dochody;
use App\Models\uzytkownicy;
use Carbon\Carbon;
use Illuminate\Http\Request;

class staleDochodyController extends Controller
{
    public function staleDochody(Request $request)
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

        $stale_dochody = new stale_dochody();
        $stale_dochody->kwota = $validatedData['kwota'];
        $stale_dochody->kategoria = $validatedData['kategoria'];
        $stale_dochody->nazwa = $validatedData['nazwa'];
        $stale_dochody->uzytkownik_id = $user->getKey();
        $stale_dochody->save();

        return redirect('staleDochodyFormularz');
    }
    public function deleteStaleDochody($id)
    {
        $stale = stale_dochody::findOrFail($id);
        $stale->delete();

        return redirect('staleDochodyFormularz');
    }
    public function updateStaleDochody(Request $request)
    {
        $validatedData = $request->validate([
            'editKategoria' => 'required',
            'editKwota' => 'required|numeric',
            'editNazwa' => 'required',
            'editDochodId' => 'required|exists:stale_dochody,id',
        ]);

        $stale = stale_dochody::find($validatedData['editDochodId']);
        $stale->kategoria = $validatedData['editKategoria'];
        $stale->kwota = $validatedData['editKwota'];
        $stale->nazwa = $validatedData['editNazwa'];
        $stale->save();

        return redirect()->back()->with('success', 'Dane wydatku zostały zaktualizowane pomyślnie.');
    }
}
