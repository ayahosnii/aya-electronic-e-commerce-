<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vendor extends Model
{
    use Notifiable;
    use HasFactory;
    protected $table = 'vendors';
    protected $fillable = ['name', 'mobile', 'logo', 'address', 'email', 'password', 'category_id', 'active', 'latitude', 'longitude', 'created_at', 'updated_at'];
    protected $hidden = ['category_id', 'password'];
    protected function scopeActive($query) {
        $query -> where ('active,1');
    }

   /* public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('assets/' . $val) : "";

    }*/

    public function getLogoAttribute($val)
    {
        return ($val !== null) ? asset('assets/' . $val) : "";

    }

    public function scopeSelection($query){
        return $query -> select('id', 'name', 'mobile', 'logo', 'address', 'email', 'category_id', 'active', 'latitude', 'longitude');
    }

    public function category(){
        return $this -> belongsTo('App\Models\MainCategory', 'category_id', 'id');
    }

    public function getActive()
    {
        return $this -> active == 1 ? 'مفعل' : 'غبر مفعل';
    }

    public function setPasswordAttribute($password)
    {
        if(!empty($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }
}
