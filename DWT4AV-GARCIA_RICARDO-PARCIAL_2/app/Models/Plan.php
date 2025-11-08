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
    'type',
    'price',
    'discount',
    'features',
  ];

  protected $casts = [
    'price' => 'decimal:2',
    'discount' => 'integer',
    'features' => 'array',
  ];

  public function service()
  {
    return $this->belongsTo(Service::class);
  }
}
