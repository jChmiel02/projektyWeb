<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\uzytkownicy;
use App\Models\praca;



class wynagrodzenia extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'wynagrodzenia';

    protected $fillable = ['uzytkownik_id','ubezpieczenie_emerytalne','ubezpieczenie_rentowe','chorobowe',
        'ubezpieczenie_zdrowotne','zaliczka_na_pit','wynagrodzenie_netto','id_pracy'];

    public function uzytkownicy()
    {
        return $this->belongsTo(uzytkownicy::class);
    }
    public function praca()
    {
        return $this->belongsTo(praca::class);
    }
}
