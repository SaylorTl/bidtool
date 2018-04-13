<?php

namespace App\Console\Commands;

use App\Jobs\GetPpdaiLoanDetail;
use App\Services\PpdaiService;
use App\Support\Ppdai\Response\Loan;
use Illuminate\Console\Command;
use Predis;
use App\libraries\OpenapiClient as OpenapiClient;
use App\Jobs\DoBid;


class PpdaiAuth extends Command
{

    protected $signature = 'ppdai:auth {code}';

    protected $description = 'Get access_token by code ';

    public function handle()
    {
        $client = new OpenapiClient();
        $data =  $client->authorize($this->argument('code'));
        var_dump($data);
    }

}
