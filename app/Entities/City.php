<?php

namespace Theater\Entities;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'region_id'];
}