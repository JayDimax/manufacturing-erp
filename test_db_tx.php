<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Models\User;

$user = User::first();
echo "User: " . $user->name . "\n";

DB::beginTransaction();
try {
    $dept = \Modules\Administration\Models\Department::create([
        'code' => 'TEST_DEPT',
        'name' => 'Test Department',
        'is_active' => true,
    ]);
    echo "Created dept ID: " . $dept->id . "\n";
    $read = \Modules\Administration\Models\Department::find($dept->id);
    echo "Read dept: " . $read->name . "\n";
    $read->update(['name' => 'Updated Dept']);
    echo "Updated dept: " . $read->fresh()->name . "\n";
    $read->delete();
    echo "Deleted dept. Exists: " . (\Modules\Administration\Models\Department::find($dept->id) ? 'yes' : 'no') . "\n";
} finally {
    DB::rollBack();
    echo "Rolled back successfully.\n";
}
