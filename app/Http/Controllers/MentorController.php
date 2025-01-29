<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentorController extends Controller
{
    public function getCurrentMentor()
    {
        $mentor = Auth::user();
        if ($mentor && $mentor->role === 'mentor') {
            return response()->json([
                'id' => $mentor->id,
                'name' => $mentor->name,
                'google_meet_code' => $mentor->google_meet_code,
            ]);
        } else {
            return response()->json(['error' => 'User is not a mentor or not authenticated'], 403);
        }
    }
}


