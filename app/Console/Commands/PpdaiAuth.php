<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\libraries\OpenapiClient;


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
