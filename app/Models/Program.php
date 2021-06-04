<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    protected $hidden = ["created_at","updated_at"];

    public function initiatives(){
        return $this->hasMany(Initiative::class);
    }

    public function volunteers(){
        return $this->belongsToMany(Volunteer::class);
    }
}
