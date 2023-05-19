<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'cost', 'country_id', 'photo', 'duration'];
    public $timestamps = false;

    public function inCountry() 
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function addPhoto(UploadedFile $photo)
    {
        $name = $photo->getClientOriginalName();
        $name = rand(100000000, 999999999) . '-' . $name;
        $path = public_path() . '/hotels-photo/';
        $photo->move($path, $name);
        return $name;
    }

    public function deletePhoto()
    {
        if ($this->photo) {
            $photo = public_path() . '/hotels-photo/' . $this->photo;
            unlink($photo);
        }
        $this->update([
            'photo' => null,
        ]);
    }
}
