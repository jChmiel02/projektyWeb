<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\uzytkownicy;


class dodatkowe_dochody extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'dodatkowe_dochody';

    protected $fillable = ['uzytkownik_id','kwota','kategoria','nazwa'];

    public function uzytkownicy()
    {
        return $this->belongsTo(uzytkownicy::class);
    }
}
