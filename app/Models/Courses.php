<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $fillable = ['id', 'type' , 'status' , 'title', 'thumbnail', 'photo', 'file', 'link', 'text', 'subject_id', 'created_at', 'updated_at'];
    use HasFactory;
    public function subjects(){
        return $this->belongsTo(Subject::class,'subject_id');  
    }
}
