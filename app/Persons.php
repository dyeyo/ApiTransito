<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persons extends Model
{
    protected $fillable=['name', 'last_name', 'document', 'plate_car', 'model_car'];

    public function multas(){
        return $this->hasMany(Multas::class);
    }
}
