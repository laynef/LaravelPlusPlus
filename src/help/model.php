<?php

class ModelHelpCommand 
{

    public function run($argv_arguments) {
echo "No Options available. 

Same command as:
php artisan make:model <model-name> --migration --controller --resource

With your generated controller

Run to generate your model, migration, and controller:
'laravelpp model <model-name>'
";
    }
}
