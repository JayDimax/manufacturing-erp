<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$routes = app('router')->getRoutes()->getRoutes();

$audit = [];

foreach ($routes as $route) {
    $uri = $route->uri();
    $action = $route->getActionName();
    if (!str_starts_with($uri, 'admin')) {
        continue;
    }

    if (preg_match('/Modules\\\\([a-zA-Z0-9]+)\\\\Controllers\\\\([a-zA-Z0-9]+)@([a-zA-Z0-9]+)/', $action, $m)) {
        $module = $m[1];
        $controller = $m[2];
        $method = $m[3];
        $fullController = "Modules\\{$module}\\Controllers\\{$controller}";

        if (!class_exists($fullController)) {
            $audit[$module][] = "CRITICAL: Controller $fullController does not exist!";
            continue;
        }

        if (!method_exists($fullController, $method)) {
            $audit[$module][] = "CRITICAL: Method $method does not exist on $fullController!";
            continue;
        }
    }
}

echo "=== ROUTE & CONTROLLER METHOD CHECK ===\n";
if (empty($audit)) {
    echo "All admin routes point to valid existing Controller methods.\n\n";
} else {
    foreach ($audit as $mod => $errs) {
        echo "Module $mod:\n";
        foreach ($errs as $e) echo "  - $e\n";
    }
}
