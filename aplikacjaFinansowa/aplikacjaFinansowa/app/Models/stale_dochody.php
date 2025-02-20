<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stale_dochody extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'stale_dochody';

    protected $fillable = ['uzytkownik_id','kategoria','kwota','nazwa'];

    public function uzytkownicy()
    {
        return $this->belongsTo(uzytkownicy::class);
    }
}
