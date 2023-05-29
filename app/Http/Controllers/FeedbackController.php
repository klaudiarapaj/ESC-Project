<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index(){
        return view('feedback.feedback');
    }

    public function store(Request $request)
{
    // Validate the form data
    $request->validate([
        'subject' => 'required',
        'message' => 'required',
    ]);

    // Create a new Feedback model instance
    $feedback = new Feedback();
    $feedback->subject = $request->input('subject');
    $feedback->message = $request->input('message');
    // You can also store the student ID or any other relevant information about the feedback if needed

    // Save the feedback to the database
    $feedback->save();

    // Redirect back to the form with a success message
    return redirect()->back()->with('success', 'Thank you for your feedback!');
}

public function showFeedbacks()
{
    // Fetch all feedbacks from the database
    $feedbacks = Feedback::paginate(5);

    // Pass the feedbacks to the view for displaying
    return view('feedback.show', ['feedbacks' => $feedbacks]);
    
}

public function destroy($id)
{
    Feedback::findOrFail($id)->delete();

    return redirect()->route('admin.feedbacks')->with('success', 'Feedback deleted successfully.');
}


}
