<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contracheque extends Model
{
    use HasFactory;

    protected $table = 'contracheques';

    protected $fillable = [
        'anexo',
        'visualizado',
        'mes_referencia',
        'ano_referencia',
        'funcionario_id'
    ];

    public function funcionario()
    {
        return $this->belongsTo(User::class);
    }
}
