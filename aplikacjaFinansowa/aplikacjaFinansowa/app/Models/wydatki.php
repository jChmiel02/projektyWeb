<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\uzytkownicy;


class wydatki extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'wydatki';

    protected $fillable = ['uzytkownik_id','kwota','kategoria','nazwa'];

    public function uzytkownicy()
    {
        return $this->belongsTo(uzytkownicy::class);
    }
}
