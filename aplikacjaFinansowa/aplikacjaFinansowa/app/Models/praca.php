<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\uzytkownicy;



class praca extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'praca';

    protected $fillable = ['uzytkownik_id','nazwa','liczba_godzin','zarobki','ilosc_dni','stawka_godzinowa','typ_umowy'];

    public function uzytkownicy()
    {
        return $this->belongsTo(uzytkownicy::class);
    }
    public function wynagrodzenia()
    {
        return $this->hasMany(wynagrodzenia::class);
    }
}
