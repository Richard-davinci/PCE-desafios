<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'subtitle',
    'description',
    'conditions',
    'image',
    'category_id',
    'status',
  ];

  protected $casts = [
    'conditions' => 'array',
  ];

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function plans()
  {
    return $this->hasMany(Plan::class);
  }


}
