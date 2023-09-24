<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeEffectiveness extends Model
{
    use HasFactory;

    protected $table = 'type_effectiveness';

    public function attackingType()
    {
        return $this->belongsTo(Type::class, 'attacking_type_id');
    }

    public function defendingType()
    {
        return $this->belongsTo(Type::class, 'defending_type_id');
    }
}
