<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service extends Model
{
  use HasFactory;

  protected $table = 'services';
  protected $fillable = [
    'name',
    'category_id',
    'status',
    'subtitle',
    'description',
    'conditions',
    'cover_image',
    'thumb_image',
  ];

  protected $casts = [
    'conditions' => 'array',
    'plans' => 'array',
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
