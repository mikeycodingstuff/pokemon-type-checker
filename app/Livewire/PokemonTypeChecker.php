<?php

namespace App\Livewire;

use Livewire\Component;

class PokemonTypeChecker extends Component
{
    public string $attackingType;

    public string $defendingType;

    public string $result;

    public function checkTypeEffectiveness()
    {
        $typeEffectiveness = [
            'normal' => [
                'normal' => 1,
                'fire' => 1,
                'water' => 1,
                'grass' => 1,
            ],
            'fire' => [
                'normal' => 1,
                'fire' => 0.5,
                'water' => 0.5,
                'grass' => 2,
            ],
            'water' => [
                'normal' => 1,
                'fire' => 2,
                'water' => 0.5,
                'grass' => 0.5,
            ],
            'grass' => [
                'normal' => 1,
                'fire' => 0.5,
                'water' => 2,
                'grass' => 0.5,
            ],
        ];

        if (!array_key_exists($this->attackingType, $typeEffectiveness) || !array_key_exists($this->defendingType, $typeEffectiveness)) {
            $this->result = 'Invalid types.';

            return;
        }

        $effeciveness = $typeEffectiveness[$this->attackingType][$this->defendingType];

        if ($effeciveness == 2) {
            $this->result = 'Super Effective';
        } elseif ($effeciveness == 0.5) {
            $this->result = 'Not Very Effective';
        } elseif ($effeciveness == 0) {
            $this->result = 'No Effect';
        } else {
            $this->result = 'Normal Effectiveness';
        }
    }

    public function render()
    {
        return view('livewire.pokemon-type-checker');
    }
}
