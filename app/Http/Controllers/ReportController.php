<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'reason' => 'required',
        ]);

        $report = new Report();
        $report->user_id = auth()->user()->id; // Assuming the currently authenticated user made the report
        $report->post_id = $validatedData['post_id'];
        $report->reason = $validatedData['reason'];
        $report->save();

        return response()->json(['message' => 'Report submitted successfully'], 200);
    }
}
