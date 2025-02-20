<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\uzytkownicy;

class cel_oszczedzania extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'cel_oszczedzania';

    protected $fillable = ['uzytkownik_id','kwota_celowa','postep','nazwa_celu'];

    public function uzytkownicy()
    {
        return $this->belongsTo(uzytkownicy::class);
    }
}
