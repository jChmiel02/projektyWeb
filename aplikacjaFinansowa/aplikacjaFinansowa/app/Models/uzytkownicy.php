<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\praca;
use App\Models\stale_wydatki;
use App\Models\wydatki;
use App\Models\dodatkowe_dochody;
use App\Models\cel_oszczedzania;
use App\Models\stale_dochody;

class uzytkownicy extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'uzytkownicy';

    protected $fillable = ['nazwa', 'haslo','wiek','zaoszczedzone','limit_oszczednosciowy', 'data_rozliczenia'];

    public function praca()
    {
        return $this->hasMany(praca::class);
    }
    public function stale_wydatki()
    {
        return $this->hasMany(stale_wydatki::class);
    }
    public function wydatki()
    {
        return $this->hasMany(wydatki::class);
    }
    public function dodatkowe_dochody()
    {
        return $this->hasMany(dodatkowe_dochody::class);
    }
    public function cel_oszczedzania()
    {
        return $this->hasMany(cel_oszczedzania::class);
    }
    public function stale_dochody()
    {
        return $this->hasMany(stale_dochody::class);
    }
    public function wynagrodzenia()
    {
        return $this->hasMany(wynagrodzenia::class);
    }
    public function oszczednosci_miesieczne()
    {
        return $this->hasMany(oszczednosci_miesieczne::class);
    }
    public function dodatkowe_dochody_miesieczne()
    {
        return $this->hasMany(dodatkowe_dochody_miesieczne::class);
    }
    public function wydatki_miesieczne()
    {
        return $this->hasMany(wydatki_miesieczne::class);
    }
    public function dochody_i_wydatki_miesieczne()
    {
        return $this->hasMany(dochody_i_wydatki_miesieczne::class);
    }
}

