<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    protected $fillable=['name'];
    public function sections(){
        return $this->hasMany(Section::class,'level_id');
    }
    public function subjects(){
        return $this->hasMany(Subject::class,'level_id');
    }
}
