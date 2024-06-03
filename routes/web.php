<?php


use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('welcome');
});

//authToken
//{
//     "admin":"1|d0YFlEldx03J1qTDQ5zpsT3sGgVWYWGTCHvAFcJPfd5b302d",
//     "update":"2|5JWelPZIhmcJfskhikaH8KMQObUqNrSjDbXyICsKdb2310ae",
//     "basic":"3|1LlkwVp7ZUBY9oh5Lg5oZXMTOLgKmipPXSmRCxKpbf62aff4"
// }

Route::get('/setup', function () {
    $credentials = [
        'email' => 'admin3@gmail.com',
        'password' => 'password'
    ];

    if (!Auth::attempt($credentials)) {
        $user = new User(); 
        $user->name = 'Admin3';
        $user->email = 'admin3@gmail.com';
        $user->password = Hash::make('password');
        $user->save();

        if (Auth::attempt($credentials)) {
            

            // Use token abilities instead of names for clarity
            $adminToken = $user->createToken('admin-token', ['create', 'update', 'delete']);
            $updateToken = $user->createToken('update-token', ['create', 'update']);
            $basicToken = $user->createToken('basic-token', ['create']);

            return [
                'admin' => $adminToken->plainTextToken,
                'update' => $updateToken->plainTextToken,
                'basic' => $basicToken->plainTextToken
            ];
        }
    }

    return response()->json(['message' => 'User already exists'], 422); // Handle existing user
});
