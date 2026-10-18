<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$routes = app('router')->getRoutes()->getRoutes();

$moduleRoutes = [];

foreach ($routes as $route) {
    $uri = $route->uri();
    $action = $route->getActionName();
    $methods = implode('|', array_diff($route->methods(), ['HEAD']));
    $name = $route->getName();

    if (str_starts_with($uri, 'admin')) {
        $module = 'Unknown';
        if (preg_match('/Modules\\\\([a-zA-Z0-9]+)\\\\Controllers/', $action, $m)) {
            $module = $m[1];
        }
        $controller = class_basename(explode('@', $action)[0] ?? '');
        $act = explode('@', $action)[1] ?? '';
        $moduleRoutes[$module][$controller][] = [
            'method' => $methods,
            'uri' => $uri,
            'action' => $act,
            'name' => $name,
        ];
    }
}

file_put_contents(__DIR__ . '/routes_dump.json', json_encode($moduleRoutes, JSON_PRETTY_PRINT));
echo "Written " . count($moduleRoutes) . " modules to routes_dump.json\n";
foreach (array_keys($moduleRoutes) as $mod) {
    echo "- $mod: " . implode(', ', array_keys($moduleRoutes[$mod])) . "\n";
}
