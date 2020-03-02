<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $fillable = ['firstname', 'lastname', 'entreprise_id', 'email', 'tel' ];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
}
