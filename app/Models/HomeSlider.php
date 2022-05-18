<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSlider extends Model
{
    use HasFactory;

    protected $table = "home_sliders";
    protected $fillable = ['id','title', 'subtitle', 'price', 'link', 'image', 'active', 'created_at', 'updated_at'];

    public function getActive()
    {
        return $this -> active == 1 ? 'مفعل' : 'غبر مفعل';
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

        public function scopeSelection($query){
            return $query -> select('id','title', 'subtitle', 'price', 'link', 'image', 'active', 'created_at', 'updated_at');
        }
    }

