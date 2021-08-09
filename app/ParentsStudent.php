<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParentsStudent extends Model
{

    protected $table = "parents_student";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'parents_id',
    ];
    public function student()
{
    return $this->belongsTo(User::class, 'student_id');
}

public function parents()
{
    return $this->belongsTo(User::class, 'parents_id');
}
}
