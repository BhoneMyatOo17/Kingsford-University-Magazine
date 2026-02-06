<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmailValidationController extends Controller
{
    /**
     * Check if email is valid and available
     */
    public function checkEmail(Request $request)
    {
        $email = $request->input('email');

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'valid' => false,
                'exists' => false,
                'message' => 'Invalid email format'
            ]);
        }

        // Check if it's a university email
        if (!Str::endsWith(strtolower($email), '@ksf.it.com')) {
            return response()->json([
                'valid' => false,
                'exists' => false,
                'message' => 'Only Kingsford University email addresses (@ksf.it.com) are allowed'
            ]);
        }

        // Check if email already exists
        $exists = User::where('email', $email)->exists();

        return response()->json([
            'valid' => !$exists,
            'exists' => $exists,
            'message' => $exists ? 'This email is already registered' : 'Email is available'
        ]);
    }
}