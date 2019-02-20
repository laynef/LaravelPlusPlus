<?php

class ModelCommand 
{

    public function run($argv_arguments) {
        $model = $this->camelCase($argv_arguments[0]);
        $arguments = array_slice($argv_arguments, 1);
        $script_line = implode($arguments, ' ');

        $dir = getcwd();

        $model_regex = '/{{ MODEL }}/';
        $model_lc_regex = '/{{ MODEL_LC_PLURAL }}/';

        $model_lc = str_plural($model);
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

    public function camelCase($str) {
        $i = array("-","_");
        $str = preg_replace('/([a-z])([A-Z])/', "\\1 \\2", $str);
        $str = preg_replace('@[^a-zA-Z0-9\-_ ]+@', '', $str);
        $str = str_replace($i, ' ', $str);
        $str = str_replace(' ', '', ucwords(strtolower($str)));
        $str = strtolower(substr($str,0,1)).substr($str,1);
        return ucfirst($str);
    }

    public function snakeCase($str) {
        $str[0] = strtolower($str[0]);
        $func = create_function('$c', 'return "_" . strtolower($c[1]);');
        return preg_replace_callback('/([A-Z])/', $func, $str);
    }

}
