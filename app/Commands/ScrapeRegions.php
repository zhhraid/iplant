<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class ScrapeRegions extends BaseCommand
{
    protected $group       = 'iplant';
    protected $name        = 'regions:scrape';
    protected $description = 'Scrapes and caches Indonesian regions (provinces, regencies, districts) from EMSIFA static API.';

    public function run(array $params)
    {
        CLI::write('=== Memulai Scraping Data Wilayah Indonesia ===', 'yellow');
        
        $baseDir = FCPATH . 'data/';
        if (!is_dir($baseDir)) {
            mkdir($baseDir, 0777, true);
        }
        if (!is_dir($baseDir . 'regencies')) {
            mkdir($baseDir . 'regencies', 0777, true);
        }
        if (!is_dir($baseDir . 'districts')) {
            mkdir($baseDir . 'districts', 0777, true);
        }

        CLI::write('Mengambil data Provinsi...', 'cyan');
        $provincesUrl = 'https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json';
        $provincesJson = @file_get_contents($provincesUrl);
        
        if ($provincesJson === false) {
            CLI::error('Gagal mengambil data Provinsi dari server.');
            return;
        }

        file_put_contents($baseDir . 'provinces.json', $provincesJson);
        $provinces = json_decode($provincesJson, true);
        CLI::write('Total Provinsi: ' . count($provinces), 'green');

        foreach ($provinces as $index => $province) {
            $provId = $province['id'];
            $provName = $province['name'];
            CLI::write(sprintf('[%d/%d] Scraping Kabupaten/Kota untuk Provinsi: %s...', $index + 1, count($provinces), $provName), 'yellow');

            $regenciesUrl = "https://emsifa.github.io/api-wilayah-indonesia/api/regencies/{$provId}.json";
            $regenciesJson = @file_get_contents($regenciesUrl);
            
            if ($regenciesJson === false) {
                CLI::error("Gagal mengambil Kabupaten/Kota untuk provinsi {$provName}.");
                continue;
            }

            file_put_contents($baseDir . "regencies/{$provId}.json", $regenciesJson);
            $regencies = json_decode($regenciesJson, true);

            foreach ($regencies as $regIndex => $regency) {
                $regId = $regency['id'];
                $regName = $regency['name'];
                
                // Show sub-progress inside province
                CLI::write(sprintf('  -> [%d/%d] Scraping Kecamatan untuk %s...', $regIndex + 1, count($regencies), $regName), 'blue');

                $districtsUrl = "https://emsifa.github.io/api-wilayah-indonesia/api/districts/{$regId}.json";
                $districtsJson = @file_get_contents($districtsUrl);

                if ($districtsJson === false) {
                    CLI::error("Gagal mengambil Kecamatan untuk {$regName}.");
                    continue;
                }

                file_put_contents($baseDir . "districts/{$regId}.json", $districtsJson);
                
                // 30ms sleep to prevent server abuse/throttling
                usleep(30000);
            }
        }

        CLI::write('=== Scraping Selesai dan Berhasil Caching! ===', 'green');
    }
}
