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
        $moduleRoutes[$module][] = [
            'method' => $methods,
            'uri' => $uri,
            'name' => $name,
            'controller' => class_basename(explode('@', $action)[0] ?? ''),
            'action' => explode('@', $action)[1] ?? '',
        ];
    }
}

foreach ($moduleRoutes as $mod => $rList) {
    echo "=== MODULE: $mod (" . count($rList) . " routes) ===\n";
    $byController = [];
    foreach ($rList as $r) {
        $byController[$r['controller']][] = $r['action'] . " [" . $r['method'] . "] " . $r['uri'];
    }
    foreach ($byController as $ctrl => $acts) {
        echo "  $ctrl:\n";
        foreach ($acts as $a) {
            echo "    - $a\n";
        }
    }
}
