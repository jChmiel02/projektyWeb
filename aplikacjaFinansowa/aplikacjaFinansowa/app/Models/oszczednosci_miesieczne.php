<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\uzytkownicy;

class oszczednosci_miesieczne extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'oszczednosci_miesieczne';

    protected $fillable = ['uzytkownik_id','oszczednosci_01','oszczednosci_02', 'oszczednosci_03',
        'oszczednosci_04', 'oszczednosci_05', 'oszczednosci_06', 'oszczednosci_07',
        'oszczednosci_08', 'oszczednosci_09', 'oszczednosci_10', 'oszczednosci_11',
        'oszczednosci_12'];

    public function uzytkownicy()
    {
        return $this->belongsTo(uzytkownicy::class);
    }
}
