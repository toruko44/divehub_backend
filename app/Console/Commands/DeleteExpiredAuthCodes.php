<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AuthCode;
use Carbon\Carbon;

class DeleteExpiredAuthCodes extends Command
{
    // コマンドの名前と説明
    protected $signature = 'authcode:delete-expired';
    protected $description = 'Deletes expired auth codes from the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // 現在の時刻より古いexpires_atを持つレコードを削除
        $deletedCount = AuthCode::where('expires_at', '<', Carbon::now())->delete();

        $this->info("Deleted {$deletedCount} expired auth codes.");
    }
}
