<?php

namespace App\Console\Commands;

use App\Api\controllers\V1\AgentManageController;
use Illuminate\Console\Command;

class DailyStat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '每日统计，用来统计需要每天更新的数据';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $agentManage = new AgentManageController();
        $agentManage->getIsExpire();

    }
}
