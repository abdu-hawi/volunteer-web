<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Initiative extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "date_start",
        "date_end",
        'status',
        "program_id",
        "description",
    ];

    protected $hidden = ["updated_at"];

    public function programs(){
        return $this->belongsTo(Program::class);
    }

    public function volunteers(){
        return $this->belongsToMany(Volunteer::class)
            ->withPivot(['id','isAccept','isFinish','hours'])
            ->withTimestamps();
    }
}
