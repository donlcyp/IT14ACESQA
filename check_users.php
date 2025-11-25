<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';

$users = DB::table('users')->select('id', 'name', 'email', 'role')->get();
foreach($users as $u) {
    echo "ID: {$u->id}, User: {$u->name}, Email: {$u->email}, Role: {$u->role}\n";
}
