<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

    protected $table = 'profiles';

    protected $fillable = ['name', 'description', 'status'];

    public function user(){
        return $this->hasOne(User::class);
    }

}
