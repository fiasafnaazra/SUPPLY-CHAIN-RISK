<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Services\GNewsService;
use App\Services\SentimentService;
use App\Models\NewsCache;

#[Signature('news:sync')]
#[Description('Sinkronisasi berita dari GNews API')]
class SyncNews extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $gnews = new GNewsService();
        $sentimentService = new SentimentService();

        $this->info('==============================');
        $this->info('Mengambil berita dari GNews...');
        $this->info('==============================');

        $articles = $gnews->getNews('logistics');

        if (empty($articles)) {
            $this->error('Tidak ada berita ditemukan.');
            return Command::FAILURE;
        }

        foreach ($articles as $article) {

            $description = $article['description'] ?? '';

            // Analisis Sentiment
            $result = $sentimentService->analyze(
                $article['title'].' '.$description
            );

            // Simpan ke database
            NewsCache::updateOrCreate(
                [
                    'url' => $article['url']
                ],
                [
                    'country_code'    => 'GLOBAL',
                    'title'           => $article['title'],
                    'description'     => $description,
                    'source'          => $article['source']['name'] ?? '-',
                    'url'             => $article['url'],
                    'image'           => $article['image'] ?? null,
                    'published_at'    => $article['publishedAt'] ?? now(),
                    'category'        => 'logistics',
                    'sentiment'       => $result['sentiment'],
                    'sentiment_score' => $result['score'],
                ]
            );

            // Tampilkan di Terminal
            $this->line('--------------------------------');
            $this->info('Judul : '.$article['title']);
            $this->line('Sentiment : '.$result['sentiment']);
            $this->line('Score     : '.$result['score']);
        }

        $this->info('==============================');
        $this->info('Semua berita berhasil disimpan.');
        $this->info('==============================');

        return Command::SUCCESS;
    }
}