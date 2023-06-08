<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogError extends Model
{
    public $table      = 'logs_error';

    protected $guarded = [];
    /*
      限制資料進出資料庫的格式限制
    */
    protected $casts = [
      'trace'       => 'array',
      'params'      => 'array',
      'header'      => 'array',
  ];
}
