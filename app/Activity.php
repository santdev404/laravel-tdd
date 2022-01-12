<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded =  [];

    
    public function subject(){
        return $this->morphTo();
    }

    protected $casts = [
        'changes' => 'array'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
