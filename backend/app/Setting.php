<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
   public $timestamps = false;

   protected $fillable = [
     'address', 'phone', 'company_name', 'description', 'keywords', 'logo', 'email',
 ];
}
