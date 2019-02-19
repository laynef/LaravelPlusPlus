<?php

class ModelHelpCommand 
{

    public function run() {
echo "
Same command as 'php artisan make:model <model-name>' 
with the options '--migration --controller --resource --api' given

Get or other options from command;
'php artisan make:model --help'

php artisan make:model <model-name> <plus-your-options-as-instructed> --migration --controller --resource --api

Run to generate your model, migration, and controller:
'laravelpp m <model-name> [...additional-options]'
";
    }
}
