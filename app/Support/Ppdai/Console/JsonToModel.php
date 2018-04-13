<?php

namespace App\Support\Ppdai\Console;

use Illuminate\Console\Command;



class JsonToModel extends Command
{

    protected $signature = 'ppdai:json2model {json}';

    protected $description = 'Translate ppdai api json to object';



    public function handle()
    {
        $name = $this->argument('json');
        $stubFile = app_path()."/Support/Ppdai/Stub/Model.stub";
        $jsonFile = app_path()."/Support/Ppdai/Stub/Json/{$name}.json";

        $stubStr = file_get_contents($stubFile);
        $jsonData = file_get_contents($jsonFile);
        $jsonData = json_decode($jsonData,true);

        $stubStr = str_replace("{{className}}",$name,$stubStr);
        $stubStr = str_replace("{{field}}",$this->genField($jsonData),$stubStr);
        $stubStr = str_replace("{{assignment}}",$this->genAssignment($jsonData),$stubStr);
        $this->genModel($name,$stubStr);

    }

    private function genField(array $data){
        $field = '';
        foreach ($data as $key => $value){
            $field .= "public \$".lcfirst($key).";".PHP_EOL;
        }
        return $field;
    }

    private function genAssignment(array $data){
        $assignment = '';
        foreach ($data as $key => $value){
            $assignment .= "\$instance->".lcfirst($key)." = \$data['$key'];".PHP_EOL;
        }
        return $assignment;
    }
    private function genModel($json,$stubStr){
        $modelFile = app_path()."/Support/Ppdai/ResponseMeta/{$json}.php";
        if(!file_exists($modelFile)) @touch($modelFile);
        file_put_contents($modelFile,$stubStr);
    }

}
