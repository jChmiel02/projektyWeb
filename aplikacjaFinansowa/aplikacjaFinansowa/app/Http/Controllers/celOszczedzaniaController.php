<?php

namespace App\Http\Controllers;

use App\Models\cel_oszczedzania;
use App\Models\Uzytkownicy;
use Illuminate\Http\Request;

class celOszczedzaniaController extends Controller
{
    public function tworzenieCeluOszczedzania(Request $request)
    {
        $validatedData = $request->validate([
            'kwota_celowa' => 'required|numeric',
            'nazwa_celu' => 'required|string',
        ]);

        // Pobranie aktualnie zalogowanego użytkownika
        $user = session('user');
        // Pobranie lub utworzenie obiektu użytkownicy
        $uzytkownik = uzytkownicy::find($user->getKey());
        $uzytkownik->id = $user->getKey();

        $cel_oszczedzania = new cel_oszczedzania();
        $cel_oszczedzania->kwota_celowa = $validatedData['kwota_celowa'];
        $cel_oszczedzania->nazwa_celu = $validatedData['nazwa_celu'];
        $cel_oszczedzania->uzytkownik_id = $user->getKey();
        $cel_oszczedzania->save();
        $zaoszczedzone = uzytkownicy::where('id', $user->getKey())->sum('zaoszczedzone');

        if ($zaoszczedzone >= $validatedData['kwota_celowa']) {
            $cel_oszczedzania->postep = 100;
            $cel_oszczedzania->save();
            return redirect()->route('celOszczedzaniaFormularz')->with('success', 'Nowy cel oszczędzania został dodany. Możesz teraz zrealizować ten cel.');
        }
        else {
            $progress = ($zaoszczedzone / $validatedData['kwota_celowa']) * 100;
            $cel_oszczedzania->postep = $progress;
            $cel_oszczedzania->save();

            return redirect()->route('celOszczedzaniaFormularz')->with('success', 'Nowy cel oszczędzania został dodany.');
        }
    }

    public function showCreateForm()
    {
        $user = session('user');
        $zaoszczedzone = Uzytkownicy::where('id', $user->getKey())->sum('zaoszczedzone');
        $cele = cel_oszczedzania::where('uzytkownik_id', $user->getKey())->get();
        return view('celOszczedzaniaFormularz', compact('zaoszczedzone', 'cele'));
    }

    public function zrealizujCel($id)
    {
        $cel = cel_oszczedzania::find($id);
        $user = session('user');
        $uzytkownik = uzytkownicy::find($user->getKey());

        $uzytkownik->zaoszczedzone -= $cel->kwota_celowa;
        $uzytkownik->save();
        $this->usunCel($id);

        return redirect()->back()->with('success', 'Cel oszczędzania został zrealizowany.');
    }


    public function usunCel($id)
    {
        cel_oszczedzania::destroy($id);
        return redirect()->back()->with('success', 'Cel oszczędzania został usunięty.');
    }
    public function updateCelOszczedzania(Request $request, $id)
    {
        $validatedData = $request->validate([
            'editNazwa' => 'required|string',
            'editKwota' => 'required|numeric',
            'editCelId' => 'required|exists:cel_oszczedzania,id',
        ]);

        $cel = cel_oszczedzania::find($validatedData['editCelId']);
        $cel->nazwa_celu = $validatedData['editNazwa'];
        $cel->kwota_celowa = $validatedData['editKwota'];
        $cel->save();

        return redirect()->back()->with('success', 'Cel oszczędzania został zaktualizowany.');
    }

}
