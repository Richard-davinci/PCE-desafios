<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service extends Model
{
  /** @use HasFactory<\Database\Factories\ServiceFactory> */
  use HasFactory;

  protected $table = 'services';
  protected $fillable = [
    'name',
    'category',
    'status',
    'subtitle',
    'description',
    'conditions',
    'cover_image',
    'thumb_image',
    'plans',
  ];

  protected $casts = [
    'conditions' => 'array',
    'plans' => 'array',
  ];
}
