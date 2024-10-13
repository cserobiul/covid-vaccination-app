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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nid',
        'email',
        'phone',
        'dob',
        'gender',
        'vaccine_center_id',
        'scheduled_date',
        'vaccinated',
    ];

    public function vaccineCenter()
    {
        return $this->belongsTo(VaccineCenter::class);
    }

    protected $casts = [
        'scheduled_date' => 'date',
    ];
}
