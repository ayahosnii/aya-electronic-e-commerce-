<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use

class SubCategory extends Model
{
    use HasFactory;
    protected $table = "sub_categories";
    protected $fillable = ['name', 'slug', 'photo', 'translation_lang', 'translate_of', 'parent_id', 'active', 'created_at', 'updated_at'];



    public function scopeSelection($query)
    {
        return $query -> select('name', 'slug', 'photo', 'translation_lang', 'translate_of', 'parent_id', 'active');
    }

    public function scopeActive($query)
    {
        return $query -> where('active', 1);
    }

    public function getActive()
    {
        return $this -> active == 1 ? 'مفعل' : 'غبر مفعل';
    }

    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('assets/' . $val) : "";
    }

   public function active()
   {
       return $this -> active == 1 ? 'مفعل' : 'غير مفعل';
   }

   //get main category of subcategory

    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class, 'category_id', 'id');
    }
}
