<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dodatkowe_dochody_miesieczne extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'dodatkowe_dochody_miesieczne';

    protected $fillable = ['id_uzytkownika','miesiac','suma_dochodu','najwyzszy_dochod_nazwa','najwyzszy_dochod_kwota'];

    public function uzytkownicy()
    {
        return $this->belongsTo(uzytkownicy::class);
    }
}
