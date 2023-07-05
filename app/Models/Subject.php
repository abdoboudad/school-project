<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable=['name','level_id'];
    public function levels(){
        return $this->belongsTo(Level::class,'level_id');  
    }
    public function courses(){
        return $this->hasMany(Courses::class,'subject_id');  
    }
}
