<?php

namespace Database\Seeders;

use App\Helpers\ApiHelpers;
use App\Models\Type;
use App\Models\TypeEffectiveness;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class TypeEffectivenessSeeder extends Seeder
{
    public function run(): void
    {
        $types = Type::all();
        $types->map(function ($attackingType) {
            $response = Http::get("https://pokeapi.co/api/v2/type/{$attackingType->id}");

            if ($response->successful()) {
                $damageRelations = $response->json()['damage_relations'];
            } else {
                throw new Exception('Error fetching data from the PokeAPI.');
            }

            $relationMap = [
                'double_damage_to' => ['multiplier' => 2.0],
                'half_damage_to' => ['multiplier' => 0.5],
                'no_damage_to' => ['multiplier' => 0.0],
            ];

            $effectiveness = [];

            foreach ($relationMap as $name => $value) {
                if (isset($damageRelations[$name])) {
                    $defendingTypes = [];

                    foreach ($damageRelations[$name] as $defendingType) {
                        $id = ApiHelpers::getTypeIdFromApiUrl($defendingType['url']);

                        $defendingTypes[] = $id;
                    }

                    $effectiveness[$name] = ['multiplier' => $value['multiplier'], 'defending_types' => $defendingTypes];
                }
            }

            $defendingTypes = Type::all();

            foreach ($defendingTypes as $defendingType) {
                $damage_multiplier = $this->findArrayWithValue($defendingType->id, $effectiveness);

                if (empty($damage_multiplier)) {
                    TypeEffectiveness::updateOrInsert([
                        'attacking_type_id' => $attackingType->id,
                        'defending_type_id' => $defendingType->id,
                        'effectiveness' => 1.0,
                        'created_at' => now(),
                    ]);
                } else {
                    TypeEffectiveness::updateOrInsert([
                        'attacking_type_id' => $attackingType->id,
                        'defending_type_id' => $defendingType->id,
                        'effectiveness' => $effectiveness[$damage_multiplier]['multiplier'],
                        'created_at' => now(),
                    ]);
                }
            }
        });

        $this->command->info('Type effectivenesses seeded successfully.');
    }

    private function findArrayWithValue($value, $arrayMap)
    {
        foreach ($arrayMap as $name => $array) {
            if (in_array($value, $array['defending_types'])) {
                return $name;
            }
        }

        return null;
    }
}
