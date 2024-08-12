<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';

    protected $fillable = [
        'nome',
        'cnpj'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function funcionarios()
    {
        return $this->hasMany(User::class);
    }
}
