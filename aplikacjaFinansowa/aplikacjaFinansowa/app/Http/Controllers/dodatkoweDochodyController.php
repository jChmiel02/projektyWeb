<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\uzytkownicy;
use App\Models\dodatkowe_dochody;

class dodatkoweDochodyController extends Controller
{
    public function dodatkoweDochody(Request $request)
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

        $dodatkowe_dochody = new dodatkowe_dochody();
        $dodatkowe_dochody->kwota = $validatedData['kwota'];
        $dodatkowe_dochody->kategoria = $validatedData['kategoria'];
        $dodatkowe_dochody->nazwa = $validatedData['nazwa'];
        $dodatkowe_dochody->uzytkownik_id = $user->getKey();
        $dodatkowe_dochody->save();

        return redirect('dodatkoweDochodyFormularz');
    }
    public function deleteDodatkoweDochody($id)
    {
        $dodatkowe = dodatkowe_dochody::findOrFail($id);
        $dodatkowe->delete();

        return redirect('dodatkoweDochodyFormularz');
    }
    public function updateDodatkoweDochody(Request $request)
    {
        $validatedData = $request->validate([
            'editKategoria' => 'required',
            'editKwota' => 'required|numeric',
            'editNazwa' => 'required',
            'editDochodId' => 'required|exists:dodatkowe_dochody,id',
        ]);

        $dochody = dodatkowe_dochody::find($validatedData['editDochodId']);
        $dochody->kategoria = $validatedData['editKategoria'];
        $dochody->kwota = $validatedData['editKwota'];
        $dochody->nazwa = $validatedData['editNazwa'];
        $dochody->save();

        return redirect()->back()->with('success', 'Dane wydatku zostały zaktualizowane pomyślnie.');
    }
}
