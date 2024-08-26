<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule',
        'uid',
        'name',
        'prenom',
        'date_naissance',
        'sexe'
    ];
    /* Pour le lien entre la Classe et le Student*/
}
