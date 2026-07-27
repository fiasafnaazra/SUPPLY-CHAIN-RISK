<?php

namespace App\Services;

class RiskScoringService
{
    /**
     * Hitung Risk Score
     *
     * Bobot:
     * Weather   = 30%
     * Inflation = 20%
     * News      = 40%
     * Currency  = 10%
     */
    public function calculate($weather, $economic, $currency, $news)
    {
        /*
        |--------------------------------------------------------------------------
        | WEATHER SCORE (0-100)
        |--------------------------------------------------------------------------
        */

        $weatherScore = 20;

        if ($weather) {

            if ($weather->storm_risk == 'High') {
                $weatherScore = 100;
            }
            elseif ($weather->storm_risk == 'Medium') {
                $weatherScore = 60;
            }
            else {
                $weatherScore = 20;
            }

        }

        /*
        |--------------------------------------------------------------------------
        | INFLATION SCORE (0-100)
        |--------------------------------------------------------------------------
        */

        $inflationScore = 20;

        if ($economic && $economic->inflation !== null) {

            $inflation = $economic->inflation;

            if ($inflation >= 10) {
                $inflationScore = 100;
            }
            elseif ($inflation >= 7) {
                $inflationScore = 80;
            }
            elseif ($inflation >= 5) {
                $inflationScore = 60;
            }
            elseif ($inflation >= 3) {
                $inflationScore = 40;
            }
            else {
                $inflationScore = 20;
            }

        }

        /*
        |--------------------------------------------------------------------------
        | CURRENCY SCORE (0-100)
        |--------------------------------------------------------------------------
        */

        $currencyScore = 20;

        if ($currency && $currency->exchange_rate) {

            $rate = $currency->exchange_rate;

            if ($rate >= 5) {
                $currencyScore = 100;
            }
            elseif ($rate >= 2) {
                $currencyScore = 70;
            }
            elseif ($rate >= 1) {
                $currencyScore = 40;
            }
            else {
                $currencyScore = 20;
            }

        }

        /*
        |--------------------------------------------------------------------------
        | NEWS SCORE (0-100)
        |--------------------------------------------------------------------------
        */

        $newsScore = 20;

        if ($news->count()) {

            $avg = $news->avg('sentiment_score');

            if ($avg <= -3) {
                $newsScore = 100;
            }
            elseif ($avg <= -2) {
                $newsScore = 80;
            }
            elseif ($avg <= -1) {
                $newsScore = 60;
            }
            elseif ($avg < 0) {
                $newsScore = 40;
            }
            else {
                $newsScore = 20;
            }

        }

        /*
        |--------------------------------------------------------------------------
        | TOTAL SCORE
        |--------------------------------------------------------------------------
        */

        $total =
            ($weatherScore * 0.30) +
            ($inflationScore * 0.20) +
            ($newsScore * 0.40) +
            ($currencyScore * 0.10);

        /*
        |--------------------------------------------------------------------------
        | LABEL
        |--------------------------------------------------------------------------
        */

        if ($total >= 70) {

            $level = 'High';

        } elseif ($total >= 40) {

            $level = 'Medium';

        } else {

            $level = 'Low';

        }

        return [
            'weather_score'  => round($weatherScore),
            'inflation_score'=> round($inflationScore),
            'currency_score' => round($currencyScore),
            'news_score'     => round($newsScore),
            'total_score'    => round($total,2),
            'risk_level'     => $level,
        ];
    }
}