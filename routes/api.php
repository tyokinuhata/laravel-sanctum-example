<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\User;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/auth/signup', function(Request $request) {
    $user = User::create([
        'name' => $request->name,
        'user_id' => $request->user_id,
        'password' => Hash::make($request->password),
    ]);

    $token = $user->createToken('token')->plainTextToken;

    return response()->json(['token' => $token], 201);
});

Route::get('/hello', function() {
    return response()->json(['message' => 'hello world!']);
});
