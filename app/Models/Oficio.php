<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficio extends Model
{
    use HasFactory;

    protected $fillable = [
        'oficio', 
        'fecha_oficio', 
        'destinatario_id', 
        'asunto', 
        'remitente_id', 
        'departamento_id',
        'fecha_recepcion',
        'archivado_en',
        'seguimiento',
        'imagen',
        'status_oficios_id',
        'user_id'
    ];

    public function destinatario()
    {
        return $this->belongsTo(Destinatario::class);
    }

    public function remitente()
    {
        return $this->belongsTo(Remitente::class);
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function status_oficios()
    {
        return $this->belongsTo(StatusOficio::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'fecha_oficio' => 'datetime:d-m-Y',
        'fecha_recepcion' => 'datetime:d-m-Y',
    ];
}
