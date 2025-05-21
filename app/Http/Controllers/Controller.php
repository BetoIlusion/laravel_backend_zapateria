<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function show($id)
    {
        $user = User::with('persona')->find($id);

        return $user;
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json([
            'user' => $user,
        ]);
    }
}
