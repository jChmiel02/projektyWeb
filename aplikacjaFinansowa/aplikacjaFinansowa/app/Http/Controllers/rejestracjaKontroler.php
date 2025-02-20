<?php

namespace App\Http\Controllers;

use App\Models\praca;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\uzytkownicy;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class rejestracjaKontroler extends Controller
{
    function register(Request $req){
        // Walidacja danych wejściowych
        $validator = Validator::make($req->all(), [
            'nazwa' => 'required|string|max:255|unique:uzytkownicy',
            'haslo' => [
                'required',
                'min:9', // Minimum 9 znaków
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
            ],
            'wiek' => 'required|integer|min:1',
        ], [
            'haslo.regex' => 'Hasło musi zawierać co najmniej jedną małą literę, jedną dużą literę, jedną cyfrę oraz jeden znak specjalny.',
            'nazwa.unique' => 'Nazwa użytkownika jest już zajęta.',
        ]);

        // Sprawdź, czy walidacja zakończyła się powodzeniem
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors(['error' => $validator->errors()->first()]);
        }

        // Utwórz użytkownika
        $uzytkownicy = new uzytkownicy;
        $uzytkownicy->nazwa = $req->nazwa;
        $uzytkownicy->haslo = bcrypt($req->input('haslo'));
        $uzytkownicy->wiek = $req->wiek;
        $uzytkownicy->data_rozliczenia = Carbon::now(); // Przypisanie aktualnej daty
        $uzytkownicy->save();

        return redirect('login');
    }


    function checkUsernameAvailability(Request $req){
        $nazwa = $req->nazwa;
        $user = DB::table('uzytkownicy')->where('nazwa', $nazwa)->exists();

        return response()->json(['available' => !$user]);
    }
}
