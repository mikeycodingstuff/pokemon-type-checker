<?php

namespace Database\Seeders;

use App\Helpers\ApiHelpers;
use App\Models\Type;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class TypesSeeder extends Seeder
{
    public function run(): void
    {
        $response = Http::get('https://pokeapi.co/api/v2/type');

        if ($response->successful()) {
            $data = $response->json()['results'];
        } else {
            throw new Exception('Error fetching data from the PokeAPI.');
        }

        foreach ($data as $item) {
            $name = $item['name'];
            $url = $item['url'];

            $id = ApiHelpers::getTypeIdFromApiUrl($url);

            if ($id <= 18) {
                try {
                    Type::updateOrInsert([
                        'name' => $name,
                        'id' => $id,
                        'created_at' => now(),
                    ]);
                } catch (Exception) {
                    exit();
                }
            }
        }

        $this->command->info('Types seeded successfully.');
    }
}
