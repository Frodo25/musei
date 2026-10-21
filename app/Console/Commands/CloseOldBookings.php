<?php

namespace App\Console\Commands;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;

use App\Models\Exhibit;
use Illuminate\Console\Command;

class CloseOldBookings extends Command
{
    protected $signature = 'exhibits:archive-old 
                            {--days=30 : Дней без активности} 
                            {--dry-run : Только показать, ничего не менять}';

    protected $description = 'Архивирует или обрабатывает старые экспонаты/заявки';

    public function handle(): int
    {
        $days = (int) $this->option('days');
        $this->info("Проверка записей старше {$days} дней...");
        
        return self::SUCCESS;
    }
}
