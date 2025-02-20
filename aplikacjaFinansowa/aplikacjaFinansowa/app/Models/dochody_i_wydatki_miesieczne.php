<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dochody_i_wydatki_miesieczne extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'dochody_i_wydatki_miesieczne';

    protected $fillable = ['uzytkownik_id','miesiac','suma_dochodu','suma_wydatku'];

    public function uzytkownicy()
    {
        return $this->belongsTo(uzytkownicy::class);
    }
}
