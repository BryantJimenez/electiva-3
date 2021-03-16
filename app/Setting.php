<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['terms', 'privacity', 'schedule', 'facebook', 'twitter', 'instagram', 'phone', 'email', 'address'];
}
