<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use HasFactory;

    protected $fillable=[
       'user_id',
       'image',
       'title',
       'description',
       'slug',
       'close_to_comment',
       'is_live',
       'upload_successfule',
       'disk'
    ];

     public function user(){
         return $this->belongsTo(User::class);
     }
}
