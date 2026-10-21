<?php

namespace App\Console\Commands;

use App\Models\Exhibit;
use App\Models\Hall;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportExhibits extends Command
{
    protected $signature = 'exhibits:import {file : Путь к CSV файлу в storage/app}';
    protected $description = 'Импорт экспонатов из CSV файла';

    public function handle(): int
    {
        $path = storage_path('app/' . $this->argument('file'));
        if (!file_exists($path)) {
            $this->error("Файл не найден: {$path}");
            return self::FAILURE;
        }

        $file = fopen($path, 'r');
        $rowNumber = 0;
        $added = 0;
        $skipped = 0;

        while (($data = fgetcsv($file, 1000, ';')) !== false) {
            $rowNumber++;
            // Ожидаемый формат в CSV: название; автор; год; id_зала
            if (count($data) < 4) {
                $this->warn("Строка {$rowNumber}: пропущена из-за неверного формата.");
                $skipped++;
                continue;
            }

            [$title, $author, $year, $hallId] = $data;

            if (!Hall::find($hallId)) {
                $this->warn("Строка {$rowNumber}: зал с ID {$hallId} не найден.");
                $skipped++;
                continue;
            }

            Exhibit::create([
                'title' => trim($title),
                'author' => trim($author),
                'year' => (int) trim($year),
                'hall_id' => (int) trim($hallId),
            ]);
            $added++;
        }
        fclose($file);

        $this->info("Импорт завершен. Добавлено: {$added}, пропущено: {$skipped}.");
        return self::SUCCESS;
    }
}
