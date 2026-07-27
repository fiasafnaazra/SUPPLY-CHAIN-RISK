<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PositiveWord;

class PositiveWordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $words = [
            'good',
            'growth',
            'profit',
            'increase',
            'success',
            'improve',
            'improved',
            'efficient',
            'efficiently',
            'strong',
            'stable',
            'recover',
            'recovery',
            'innovation',
            'opportunity',
            'positive',
            'gain',
            'gains',
            'benefit',
            'benefits',
            'safe',
            'expand',
            'expansion',
            'boost',
            'record',
            'optimistic'
        ];

        foreach ($words as $word) {
            PositiveWord::firstOrCreate([
                'word' => $word
            ]);
        }
    }
}