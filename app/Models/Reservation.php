<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [ 'hotel_id', 'user_id', 'approved'];
    public $timestamps = false;

    public function forHotel() 
    {
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id');
    }
}
