<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id', 'fillable','support_ticket_id'];

    //set relationship between user & post
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
