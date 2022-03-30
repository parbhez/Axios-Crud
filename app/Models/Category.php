<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    //protected $guarded = ['category_name']; //Ei filed kokhono data insert hobe na.
    //protected $fillable  = ['category_name','slug']; //Ei filed data ditei hobe && insert hobe. na hole error hobe.
}
