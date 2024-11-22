<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'area'; 
    public $timestamps = false; 

    protected $fillable = ['nombre_area']; 
    protected $primaryKey = 'id_area';

    public $incrementing = true; 
}