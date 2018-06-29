<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Previlege extends Model
{
  protected $fillable = ['description'];

  protected $casts = ['id'];

  public  function user()
  {
    return $this->belongsTo('App\User');
  }
}
