<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusOficio extends Model
{
    use HasFactory;

    protected $fillable = ['status'];
    
    public function status()
    {
      return $this->hasMany(Oficio::class);
    }
}
