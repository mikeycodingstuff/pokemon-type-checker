<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeEffectiveness extends Model
{
    use HasFactory;

    protected $table = 'type_effectiveness';

    protected function effectiveness(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                return match ($value) {
                    '2.0' => 'super effective',
                    '1.0' => 'normal effectiveness',
                    '0.5' => 'not very effective',
                    '0.0' => 'no effect',
                };
            }
        );
    }

    public function attackingType()
    {
        return $this->belongsTo(Type::class, 'attacking_type_id');
    }

    public function defendingType()
    {
        return $this->belongsTo(Type::class, 'defending_type_id');
    }
}
