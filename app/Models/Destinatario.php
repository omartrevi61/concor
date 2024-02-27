<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinatario extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'puesto', 'telefono', 'email'];

    public function oficios()
    {
      return $this->hasMany(Oficio::class);
    }
}
