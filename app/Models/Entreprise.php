<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    protected $fillable = ['name', 'email', 'logo', 'site'];

    public function employes()
    {
        // les employés de l'entreprise (un employé ne peut être que dans une seule entreprise)
        return $this->hasMany(Employe::class);
    }
}
