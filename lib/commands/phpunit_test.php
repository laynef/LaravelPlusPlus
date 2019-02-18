<?php

$route = $route[1];

$route_regex = '/{{ RESOURCE_ROUTE }}/';

$test_path = __DIR__ . '/../test/Feature' . $route . 'Test.php';

$template_str = file_get_contents(__DIR__ . '/../templates/php_unit_test.txt');

$new_test_string = preg_replace($route_regex, $route, $template_str);
file_put_contents($test_path, $new_test_string);

echo "Your controller was generated.";
