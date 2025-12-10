<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = \App\Models\User::find(10);
if ($user) {
    echo "Testing gate for user: {$user->name}\n";
    echo "Role: {$user->role}\n";
    echo "isAdmin(): " . ($user->isAdmin() ? 'true' : 'false') . "\n";
    
    // Test the gate
    $canAccess = \Illuminate\Support\Facades\Gate::allows('admin', $user);
    echo "Gate 'admin' allows: " . ($canAccess ? 'true' : 'false') . "\n";
} else {
    echo "User not found\n";
}
