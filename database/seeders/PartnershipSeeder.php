<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Partnership;

class PartnershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partnerships = [
            [
                'name' => 'Nerdy Core XP',
                'description' => 'Agência / Produtora de Eventos',
                'website_url' => 'https://nerdycorexp.com',
                'logo_path' => 'partnerships/ncxp2025.png',
                'type' => 'sponsor',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Konseptus Informática',
                'description' => 'Soluções de Tecnologia e Informática',
                'website_url' => 'https://www.konseptus.eu',
                'logo_path' => 'partnerships/konseptusblacks.png',
                'type' => 'partner',
                'is_active' => true,
                'order' => 2,
            ],
        ];

        foreach ($partnerships as $partnership) {
            Partnership::create($partnership);
        }
    }
}
