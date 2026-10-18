<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

$admin = User::first();
Auth::login($admin);

echo "Logged in as: " . $admin->name . " (ID: " . $admin->id . ")\n\n";

$routes = app('router')->getRoutes()->getRoutes();

// Test GET routes for create, index, edit (Read functionality and view rendering)
$results = [];

foreach ($routes as $route) {
    $uri = $route->uri();
    $methods = $route->methods();
    $action = $route->getActionName();

    if (!str_starts_with($uri, 'admin')) {
        continue;
    }

    if (!in_array('GET', $methods)) {
        continue;
    }

    // Only test static or simple routes without parameters first
    if (!str_contains($uri, '{')) {
        $module = 'Unknown';
        if (preg_match('/Modules\\\\([a-zA-Z0-9]+)\\\\Controllers/', $action, $m)) {
            $module = $m[1];
        }

        try {
            $req = Request::create('/' . $uri, 'GET');
            $req->setUserResolver(fn() => $admin);
            $response = $app->handle($req);
            $status = $response->getStatusCode();
            $results[$module][] = [
                'uri' => $uri,
                'status' => $status,
                'error' => $status >= 400 ? substr($response->getContent(), 0, 200) : null,
            ];
        } catch (\Throwable $e) {
            $results[$module][] = [
                'uri' => $uri,
                'status' => 'EXCEPTION',
                'error' => $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(),
            ];
        }
    }
}

foreach ($results as $mod => $res) {
    echo "=== MODULE: $mod ===\n";
    foreach ($res as $r) {
        $statusStr = $r['status'] == 200 ? "OK (200)" : "FAIL ({$r['status']})";
        echo "  [{$statusStr}] /{$r['uri']}\n";
        if ($r['error']) {
            echo "      Error: {$r['error']}\n";
        }
    }
    echo "\n";
}
