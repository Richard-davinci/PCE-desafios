<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  /** @use HasFactory<\Database\Factories\UserFactory> */
  use HasFactory, Notifiable;

  protected $fillable = [
    'name',
    'email',
    'password',
    'phone',
    'city',
    'profile_photo',
  ];


  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  public function hasRole($role): bool
  {
    return $this->role === $role;
  }

  // Scopes
  public function scopeAdmins($query)
  {
    return $query->where('role', 'admin');
  }

  public function scopeOnlyUsers($query)
  {
    return $query->where('role', 'user');
  }

  public function scopeToday($query)
  {
    return $query->whereDate('created_at', today());
  }

  public function scopeLatestUsers($query, $limit = 5)
  {
    return $query->orderBy('created_at', 'desc')->take($limit);
  }

  // Método estático para estadísticas
  public static function getRolesStats()
  {
    $total = self::count();
    $admins = self::admins()->count();
    $users = self::onlyUsers()->count();
    return [
      'admin' => [
        'count' => $admins,
        'percent' => $total ? round(($admins / $total) * 100) : 0,
      ],
      'user' => [
        'count' => $users,
        'percent' => $total ? round(($users / $total) * 100) : 0,
      ],
    ];
  }

}
