<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    protected $fillable=['cause', 'entry_date', 'state', 'person_id'];

    public function persons(){
        return $this->belongsTo(Personas::class);
    }
}
