<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  protected $fillable = ['title', 'description', 'event_from', 'event_to'];
}
