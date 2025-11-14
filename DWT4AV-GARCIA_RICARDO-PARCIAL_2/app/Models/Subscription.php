<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'service_id',
    'plan_id',
    'price',
    'status',
    'started_at',
    'next_renewal_at',
    'canceled_at',
  ];

  protected $casts = [
    'price'            => 'decimal:2',
    'started_at'       => 'datetime',
    'next_renewal_at'  => 'datetime',
    'canceled_at'      => 'datetime',
  ];

  // Relaciones
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function service()
  {
    return $this->belongsTo(Service::class);
  }

  public function plan()
  {
    return $this->belongsTo(Plan::class);
  }


}
