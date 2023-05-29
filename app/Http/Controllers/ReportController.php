<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;


class ReportController extends Controller
{
    public function store(Request $request)
    {
      
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
            'reason' => 'required',
            
        ]);

        $report = new Report();
        $report->user_id = $validatedData['user_id']; // Assuming the currently authenticated user made the report
        $report->post_id = $validatedData['post_id'];
        $report->reason = $validatedData['reason'];
        $report->save();

        return response()->json(['message' => 'Report submitted successfully'], 200);
    }
}
