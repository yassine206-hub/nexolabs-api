<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'prenom', 'nom', 'contact',
        'secteur', 'service', 'message', 'is_read'
    ];
}