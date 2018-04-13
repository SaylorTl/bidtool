<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


class PpdaiControl extends Command
{

    protected $signature = 'ppdai:control';

    protected $description = 'Generate multi-thread for ppdai get loan list ';

    private $page = 10;

    public function handle()
    {
        for ($page = 1;$page <= $this->page ;$page ++){
            $this->runProcess($page);
        }
    }

    private function runProcess($page){
        $phpBin=PHP_BINDIR.'/php';
        $artisan=base_path().'/artisan';
        $command='ppdai:process '.$page;
        echo $phpBin.' '.$artisan.' '.$command .' &'.PHP_EOL;
        pclose(popen($phpBin.' '.$artisan.' '.$command .' &','r'));
    }

}
