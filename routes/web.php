<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('welcome');
});

Route::get('setup', function () {
    $credentials = [
        'email' => 'admin@gmail.com',
        'password' => 'password'
    ];

    if (!Auth::attempt($credentials)) {
        $user = new User(['name' => 'Admin', 'email' => $credentials['email'], 'password' => Hash::make($credentials['password'])]); 
        $user->save();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Use token abilities instead of names for clarity
            $adminToken = $user->createToken('admin', ['create', 'update', 'delete']);
            $updateToken = $user->createToken('update', ['create', 'update']);
            $basicToken = $user->createToken('basic', ['create']);

            return [
                'admin' => $adminToken->plainTextToken,
                'update' => $updateToken->plainTextToken,
                'basic' => $basicToken->plainTextToken
            ];
        }
    }

    return response()->json(['message' => 'User already exists'], 422); // Handle existing user
});
