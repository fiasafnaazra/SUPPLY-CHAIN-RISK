<?php

namespace App\Services;

use App\Models\PositiveWord;
use App\Models\NegativeWord;

class SentimentService
{
    public function analyze($text)
    {
        $text = strtolower($text);

        // Hilangkan tanda baca
        $text = preg_replace('/[^a-z0-9\s]/', '', $text);

        $words = explode(' ', $text);

        $positiveWords = PositiveWord::pluck('word')->toArray();
        $negativeWords = NegativeWord::pluck('word')->toArray();

        $score = 0;

        foreach ($words as $word) {

            if (in_array($word, $positiveWords)) {
                $score++;
            }

            if (in_array($word, $negativeWords)) {
                $score--;
            }
        }

        if ($score > 0) {
            $sentiment = 'Positive';
        } elseif ($score < 0) {
            $sentiment = 'Negative';
        } else {
            $sentiment = 'Neutral';
        }

        return [
            'sentiment' => $sentiment,
            'score' => $score,
        ];
    }
}