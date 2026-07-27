<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NegativeWord;

class NegativeWordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $words = [
            'bad',
            'loss',
            'decline',
            'decrease',
            'drop',
            'crisis',
            'war',
            'attack',
            'attacks',
            'strike',
            'strikes',
            'conflict',
            'risk',
            'delay',
            'delays',
            'damage',
            'damaged',
            'fire',
            'fires',
            'injured',
            'hurt',
            'failure',
            'failed',
            'negative',
            'collapse',
            'recession',
            'inflation',
            'shortage',
            'disruption',
            'blocked'
        ];

        foreach ($words as $word) {
            NegativeWord::firstOrCreate([
                'word' => $word
            ]);
        }
    }
}