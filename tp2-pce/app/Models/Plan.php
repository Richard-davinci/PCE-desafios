<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
  use HasFactory;

  protected $fillable = [
    'service_id',
    'name',
    'price',
    'type',
    'features',
    'highlight',   // para marcar si es más vendido
  ];

  protected $casts = [
    'features' => 'array', // ✅ para que se maneje como array automáticamente
  ];

  // cada plan pertenece a un servicio
  public function service()
  {
    return $this->belongsTo(Service::class);
  }
}
