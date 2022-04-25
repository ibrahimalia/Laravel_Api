<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;
    protected $table = "flights" ;
    protected $fillable=["id","name","value"];
    protected $hidden =["updated_at","created_at"];
}
