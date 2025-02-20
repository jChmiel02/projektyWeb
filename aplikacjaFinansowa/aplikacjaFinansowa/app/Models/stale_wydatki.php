<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\uzytkownicy;

class stale_wydatki extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'stale_wydatki';

    protected $fillable = ['uzytkownik_id','kategoria','kwota','nazwa'];

    public function uzytkownicy()
    {
        return $this->belongsTo(uzytkownicy::class);
    }
}
