<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\subscription;


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

// En app/Models/Plan.php
  public function subscriptions()
  {
    return $this->hasMany(\App\Models\Subscription::class);
  }

}
