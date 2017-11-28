<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PersonalChat extends Model
{
    protected $fillable = ['message','from_id','to_id'];


    public function to_user()
    {
        return $this->hasOne(User::class,'id','to_id');
    }
    public function user()
    {
        return $this->hasOne(User::class,'id','from_id');
    }
    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('H:i A');
    }
}
