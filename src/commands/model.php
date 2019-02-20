<?php

require __DIR__ . '/../utils/strings.php';

class ModelCommand extends Inflect
{

    public function run($argv_arguments) {
        $model = $this->camelCase($argv_arguments[0]);
        $arguments = array_slice($argv_arguments, 1);
        $script_line = implode($arguments, ' ');

        $dir = getcwd();

        $model_regex = '/{{ MODEL }}/';
        $model_lc_regex = '/{{ MODEL_LC_PLURAL }}/';

        $model_lc = $this->pluralize($model);
        $model_lc_plural = $this->snakeCase($model_lc);

        $controller_path = getcwd() . '/app/Http/Controllers/' . $model . 'Controller.php';
        $model_path = getcwd() . '/app/' . $model . '.php';
        $timestamp = date('Y_m_d_His');
        $migration_name = $timestamp . '_create_' . $model_lc_plural . '_table';
        $migration_path = getcwd() . '/database/migrations/' . $migration_name . '.php';

        $template_str = file_get_contents(__DIR__ . '/../templates/controller.txt');
        $model_template_str = file_get_contents(__DIR__ . '/../templates/model.txt');
        $migration_template_str = file_get_contents(__DIR__ . '/../templates/migration.txt');

        $new_controller_string = preg_replace($model_regex, $model, $template_str);
        $new_model_string = preg_replace($model_lc_regex, $model_lc_plural, $model_template_str);
        $new_model_string = preg_replace($model_regex, $model, $new_model_string);
        $new_migration_string = preg_replace($model_regex, $model, $migration_template_str);
        $new_migration_string = preg_replace($model_lc_regex, $model_lc_plural, $new_migration_string);

        file_put_contents($controller_path, $new_controller_string);
        file_put_contents($model_path, $new_model_string);
        file_put_contents($migration_path, $new_migration_string);

        echo "Your controller was generated.";
    }

}
