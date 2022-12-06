<?php

namespace App\Models;
use App\Enums\TableStatus;
use App\Enums\TableLocation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;

class Table extends Model
{
    use HasFactory;

    protected $fillable = ['name','guest_number','status','location'];

    protected $casts = [
      'status' => TableStatus::class,
      'location' => TableLocation::class
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
