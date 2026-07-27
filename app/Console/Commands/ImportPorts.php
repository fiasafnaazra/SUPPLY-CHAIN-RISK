<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Port;

class ImportPorts extends Command
{
    protected $signature = 'ports:import';

    protected $description = 'Import World Port Index CSV';

    public function handle()
    {
        $file = storage_path('app/updatedpub150.csv');

        if (!file_exists($file)) {
            $this->error('File CSV tidak ditemukan.');
            return;
        }

        $handle = fopen($file, 'r');

        $header = fgetcsv($handle);

        while (($row = fgetcsv($handle)) !== false) {

            $data = array_combine($header, $row);

            Port::updateOrCreate(

                [
                    'port_name' => $data['Main Port Name'],
                    'country_code' => $data['Country Code'],
                ],

                [
                    'alternate_name' => $data['Alternate Port Name'] ?? null,
                    'region'         => $data['Region Name'] ?? null,
                    'water_body'     => $data['World Water Body'] ?? null,
                    'latitude'       => $data['Latitude'],
                    'longitude'      => $data['Longitude'],
                    'harbor_type'    => $data['Harbor Type'] ?? null,
                    'harbor_size'    => $data['Harbor Size'] ?? null,
                    'harbor_use'     => $data['Harbor Use'] ?? null,
                ]

            );
        }

        fclose($handle);

        $this->info('Import selesai.');
    }
}