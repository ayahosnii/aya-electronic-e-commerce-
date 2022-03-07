<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory;
    protected $table = 'main_categories';
    protected $fillable = [
        'id', 'translation_lang', 'translate_of', 'name', 'slug', 'photo', 'active', 'created_at',	'updated_at'
    ];

    public function scopeActive($query){
        return $query ->where('active', 1);
    }

    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('assets/' . $val) : "";

    }

    public function scopeSelection($query)
    {

        return $query ->select('id', 'translation_lang', 'name', 'slug', 'photo', 'active', 'translate_of');
    }

    public function getActive()
    {
        return $this -> active == 1 ? 'مفعل' : 'غبر مفعل';
    }

    public function categories()
    {
        return $this->hasMany(self::class, 'translate_of');
    }
}
