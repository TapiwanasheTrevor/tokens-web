<?php

namespace App\Http\Controllers;

use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function buy(Request $request)
    {
        $token = new Token();
        $token->user_id = $request->id;
        $token->units = $request->units;
        $token->price = $request->amount;
        $token->save();

        return response()->json(['message' => 'Successfully bought units']);
    }

    public function list($id)
    {
        $user = User::findOrFail($id);
        $tokens = $user->tokens()->orderByDesc('id')->get();
        return response()->json($tokens);
    }
}
