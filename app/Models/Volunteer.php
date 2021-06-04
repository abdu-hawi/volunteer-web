<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "age",
        "mobile",
        "gender",
        "national_id",
        "points"
    ];

    protected $hidden = ["created_at"];

    public function programs(){
        return $this->belongsToMany(Program::class);
    }
    public function prog(){
        return $this->belongsToMany(Program::class)
            ->withPivot('program_id')
            ->using(ProgramVolunteer::class);
    }
    public function initiatives(){
        return $this->belongsToMany(Initiative::class,
            'initiative_volunteer',
            'initiative_id',
            'volunteer_id');
    }
}
