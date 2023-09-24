<?php

namespace App\Livewire;

use App\Models\Type;
use App\Models\TypeEffectiveness;
use Livewire\Component;

class PokemonTypeChecker extends Component
{
    public string $attackingType = '';

    public string $defendingType = '';

    public string $result;

    public function checkTypeEffectiveness()
    {
        $attackingTypeModel = Type::where('name', $this->attackingType)->first();
        $defendingTypeModel = Type::where('name', $this->defendingType)->first();

        if (!$attackingTypeModel || !$defendingTypeModel) {
            $this->result = 'Invalid types';

            return;
        }

        $typeEffectiveness = TypeEffectiveness::where('attacking_type_id', $attackingTypeModel->id)
            ->where('defending_type_id', $defendingTypeModel->id)
            ->first();

        if ($typeEffectiveness) {
            $this->result = $typeEffectiveness->effectiveness;
        } else {
            $this->result = 'Type effectiveness not found';
        }
    }

    public function render()
    {
        return view('livewire.pokemon-type-checker');
    }
}
