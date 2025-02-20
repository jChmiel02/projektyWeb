<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\uzytkownicy;
use App\Models\praca;
use App\Models\Wynagrodzenia;

class pracaController extends Controller
{
    public function zapiszDane(Request $request)
    {
        $validatedData = $request->validate([
            'nazwa' => 'required|string',
            'liczba_godzin' => 'required|numeric|positive',
            'ilosc_dni' => 'required|numeric|positive',
            'stawka_godzinowa' => 'required|numeric|positive',
            'typ_umowy' => 'required|string',
        ]);

        $user = session('user');
        $isStudent = $request->has('student_uczen');

        $uzytkownik = $this->getOrCreateUser($user);

        // Tworzenie nowego rekordu pracy dla użytkownika
        $praca = new praca();
        $praca->uzytkownik_id = $user->getKey();
        $praca->nazwa = $validatedData['nazwa'];
        $praca->stawka_godzinowa = $validatedData['stawka_godzinowa'];
        $praca->typ_umowy = $validatedData['typ_umowy'];
        $praca->liczba_godzin = $validatedData['liczba_godzin'];
        $praca->ilosc_dni = $validatedData['ilosc_dni'];
        $praca->zarobki = $validatedData['liczba_godzin'] * $validatedData['ilosc_dni'] * $validatedData['stawka_godzinowa'];
        $praca->save();

        $wynagrodzenie = new Wynagrodzenia();
        $wynagrodzenie->uzytkownik_id = $user->getKey();
        $wynagrodzenie->id_pracy = $praca->getKey();
        $wynagrodzenie->save();

        $this->calculateAndSavePracaData($praca, $validatedData, $wynagrodzenie, $isStudent, $user);

        return redirect('pracaFormularz');
    }

    private function getOrCreateUser($user)
    {
        $uzytkownik = uzytkownicy::find($user->getKey());

        if (!$uzytkownik) {
            $uzytkownik = new uzytkownicy();
            $uzytkownik->id = $user->getKey();
            $uzytkownik->save();
        }

        return $uzytkownik;
    }

    private function calculateAndSavePracaData($praca, $validatedData, $wynagrodzenie, $isStudent, $user)
    {
        $ubezpieczenie_emerytalne = 9.76;
        $ubezpieczenie_rentowe = 1.5;
        $chorobowe = 2.45;
        $ubezpieczenie_zdrowotne = 7.766;

        $praca->stawka_godzinowa = $validatedData['stawka_godzinowa'];
        $praca->nazwa = $validatedData['nazwa'];
        $praca->typ_umowy = $validatedData['typ_umowy'];
        $praca->liczba_godzin = $validatedData['liczba_godzin'];
        $praca->ilosc_dni = $validatedData['ilosc_dni'];
        $praca->zarobki = $validatedData['liczba_godzin'] * $validatedData['ilosc_dni'] * $validatedData['stawka_godzinowa'];

        $wynagrodzenie_brutto = $praca->zarobki;
        $wynagrodzenie->id_pracy = $praca->id;


        // Obliczenia składek na ubezpieczenia
        $ubezpieczenie_emerytalne = round($ubezpieczenie_emerytalne * $wynagrodzenie_brutto / 100, 2);
        $ubezpieczenie_rentowe = round($ubezpieczenie_rentowe * $wynagrodzenie_brutto / 100, 2);
        $chorobowe = round($chorobowe * $wynagrodzenie_brutto / 100, 2);
        $ubezpieczenie_zdrowotne = round($ubezpieczenie_zdrowotne * $wynagrodzenie_brutto / 100, 2);

        // Obliczenia podatku dochodowego
        $dochod = $wynagrodzenie_brutto - $ubezpieczenie_emerytalne - $ubezpieczenie_rentowe - $chorobowe - 250;
        $podatek = round($dochod * 0.12 - 300);
        $zaliczka_na_pit = ($user->wiek < 26 && !$isStudent) ? 0 : $podatek; // Dodany warunek dla zaliczki na PIT
        $wynagrodzenie_netto = $wynagrodzenie_brutto - ($ubezpieczenie_emerytalne + $ubezpieczenie_rentowe + $chorobowe + $ubezpieczenie_zdrowotne + $zaliczka_na_pit);

        // Jeśli umowa to "umowa o pracę"
        if ($validatedData['typ_umowy'] === 'umowa_o_prace') {
            $wynagrodzenie->ubezpieczenie_emerytalne = $ubezpieczenie_emerytalne;
            $wynagrodzenie->ubezpieczenie_rentowe = $ubezpieczenie_rentowe;
            $wynagrodzenie->chorobowe = $chorobowe;
            $wynagrodzenie->ubezpieczenie_zdrowotne = $ubezpieczenie_zdrowotne;
            $wynagrodzenie->zaliczka_na_pit = $zaliczka_na_pit;
            $wynagrodzenie->wynagrodzenie_netto = $wynagrodzenie_netto;
            $wynagrodzenie->save();
            $praca->save();
        }
        // Jeśli umowa to "umowa zlecenie"
        elseif ($validatedData['typ_umowy'] === 'umowa_zlecenie') {
            if ($isStudent && $user->wiek < 26) {
                // Jeśli jest studentem i ma mniej niż 26 lat
                $wynagrodzenie->ubezpieczenie_emerytalne = 0;
                $wynagrodzenie->ubezpieczenie_rentowe = 0;
                $wynagrodzenie->chorobowe = 0;
                $wynagrodzenie->ubezpieczenie_zdrowotne = 0;
                $wynagrodzenie->zaliczka_na_pit = 0;
                $wynagrodzenie->wynagrodzenie_netto = $wynagrodzenie_brutto;
                $wynagrodzenie->save();
                $praca->save();
            }
            else if($user->wiek < 26) {
                // Obliczenia składek społecznych
                $spoleczne = round($wynagrodzenie_brutto - $ubezpieczenie_emerytalne - $chorobowe - $ubezpieczenie_rentowe, 2);
                $spoleczne1 = round($spoleczne * 0.2, 2);
                $zus = round($spoleczne * 0.09, 2);
                $zaliczka_na_pit = 0;
                $wynagrodzenie_netto = $wynagrodzenie_brutto - $ubezpieczenie_rentowe - $chorobowe - $ubezpieczenie_emerytalne - $zus - $zaliczka_na_pit;

                $wynagrodzenie->ubezpieczenie_emerytalne = $ubezpieczenie_emerytalne;
                $wynagrodzenie->ubezpieczenie_rentowe = $ubezpieczenie_rentowe;
                $wynagrodzenie->chorobowe = $chorobowe;
                $wynagrodzenie->ubezpieczenie_zdrowotne = $ubezpieczenie_zdrowotne;
                $wynagrodzenie->zaliczka_na_pit = $zaliczka_na_pit;
                $wynagrodzenie->wynagrodzenie_netto = $wynagrodzenie_netto;
                $wynagrodzenie->save();
                $praca->save();
            }
            else {
                // Obliczenia składek społecznych
                $spoleczne = round($wynagrodzenie_brutto - $ubezpieczenie_emerytalne - $chorobowe - $ubezpieczenie_rentowe, 2);
                $spoleczne1 = round($spoleczne * 0.2, 2);
                $zus = round($spoleczne * 0.09, 2);
                $zaliczka_na_pit = round(($spoleczne - $spoleczne1) * 0.12, 2);
                $wynagrodzenie_netto = $wynagrodzenie_brutto - $ubezpieczenie_rentowe - $chorobowe - $ubezpieczenie_emerytalne - $zus - $zaliczka_na_pit;

                $wynagrodzenie->ubezpieczenie_emerytalne = $ubezpieczenie_emerytalne;
                $wynagrodzenie->ubezpieczenie_rentowe = $ubezpieczenie_rentowe;
                $wynagrodzenie->chorobowe = $chorobowe;
                $wynagrodzenie->ubezpieczenie_zdrowotne = $ubezpieczenie_zdrowotne;
                $wynagrodzenie->zaliczka_na_pit = $zaliczka_na_pit;
                $wynagrodzenie->wynagrodzenie_netto = $wynagrodzenie_netto;
                $wynagrodzenie->save();
                $praca->save();
            }
        }
    }
    public function usunPraca($id)
    {
        $praca = praca::findOrFail($id);
        $user = session('user');

        // Znajdź związany z pracą rekord Wynagrodzenia
        $wynagrodzenie = Wynagrodzenia::firstOrNew(['uzytkownik_id' => $user->getKey(), 'id_pracy' => $praca->id]);

        if ($wynagrodzenie) {
            // Jeśli znaleziono, usuń rekord Wynagrodzenia
            $wynagrodzenie->delete();
        }

        // Na koniec usuń pracę
        $praca->delete();

        return redirect('pracaFormularz');
    }


    public function edytujPraca(Request $request)
    {
        $validatedData = $request->validate([
            'nazwa' => 'required|string',
            'liczba_godzin' => 'required|numeric|positive',
            'ilosc_dni' => 'required|numeric|positive',
            'stawka_godzinowa' => 'required|numeric|positive',
            'typ_umowy' => 'required|string',
            'editPracaId' => 'required|exists:praca,id',
        ]);

        $praca = praca::find($validatedData['editPracaId']);

        // Aktualizacja danych o pracy
        $praca->nazwa = $validatedData['nazwa'];
        $praca->stawka_godzinowa = $validatedData['stawka_godzinowa'];
        $praca->typ_umowy = $validatedData['typ_umowy'];
        $praca->liczba_godzin = $validatedData['liczba_godzin'];
        $praca->ilosc_dni = $validatedData['ilosc_dni'];
        $praca->zarobki = $validatedData['liczba_godzin'] * $validatedData['ilosc_dni'] * $validatedData['stawka_godzinowa'];
        $praca->save();

        $user = session('user');
        $isStudent = $request->has('student_uczen');
        $uzytkownik = $this->getOrCreateUser($user);

        $wynagrodzenie = Wynagrodzenia::firstOrNew(['uzytkownik_id' => $user->getKey(), 'id_pracy' => $praca->id]);

        $this->calculateAndSavePracaData($praca, $validatedData, $wynagrodzenie, $isStudent, $user);

        return redirect()->back()->with('success', 'Dane pracy zostały zaktualizowane pomyślnie.');
    }
}
