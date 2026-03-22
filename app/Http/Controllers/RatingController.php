<?php

namespace App\Http\Controllers;

use App\Models\RiderRating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function submit(Request $request)
    {
        $riderId = $request->input('rider_id');
        $rating = (int) $request->input('rating');
        $userIp = $request->ip();

        if (!$riderId || $rating < 1 || $rating > 5) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid rider ID or rating.',
            ]);
        }

        // Check if user already rated this rider
        $existing = RiderRating::where('rider_id', $riderId)
            ->where('user_ip', $userIp)
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'You have already rated this rider.',
            ]);
        }

        RiderRating::create([
            'rider_id' => $riderId,
            'rating' => $rating,
            'user_ip' => $userIp,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Rating submitted successfully!',
        ]);
    }

    public function getAverage(Request $request)
    {
        $riderId = $request->input('rider_id');

        if (!$riderId) {
            return response()->json([
                'success' => false,
                'message' => 'Rider ID not provided.',
            ]);
        }

        $average = RiderRating::where('rider_id', $riderId)->avg('rating');

        return response()->json([
            'success' => true,
            'average_rating' => $average ? round($average, 1) : 0,
        ]);
    }
}
