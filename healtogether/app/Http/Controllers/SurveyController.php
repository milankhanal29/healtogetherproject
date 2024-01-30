<?php
// app/Http/Controllers/SurveyController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
class SurveyController extends Controller
{
    
    public function showSurvey()
    {
        if (Auth::check()) {
            $userId = Auth::id(); // Get the user's ID
        
            // Retrieve the user's survey data
            $userSurvey = Survey::where('user_id', $userId)->first();
        
            if ($userSurvey) {
                return redirect()->route('home')->with('success', 'You already taken survey!');
                return view(''); // Create a view for showing the message
            } else {
                // The user has not taken the survey
                return view('users.survey');
            }
        } else {
            return view('auth.login');

        }
        
    }
    public function storeSurvey(Request $request)
    {
        $validatedData = $request->validate([
            'q1' => 'required|in:Never,Rarely,Sometimes,Often,Always',
            'q2' => 'required|in:Never,Rarely,Sometimes,Often,Always',
            'q3' => 'required|in:Never,Rarely,Sometimes,Often,Always',
            'q4' => 'required|in:Never,Rarely,Sometimes,Often,Always',
            'q5' => 'required|in:Never,Rarely,Sometimes,Often,Always',
            'q6' => 'required|in:Never,Rarely,Sometimes,Often,Always',
            'q7' => 'required|in:Never,Rarely,Sometimes,Often,Always',
            'q8' => 'required|in:Never,Rarely,Sometimes,Often,Always',
            'q9' => 'required|in:Very satisfied,Somewhat satisfied,Neither satisfied nor dissatisfied,Somewhat dissatisfied,Very dissatisfied',
            'q10' => 'required|in:Yes,No,I don\'t know',
            'q11' => 'required|in:Yes,No',
        ]);
        if (Auth::check()) {
            
            $survey = new Survey();
            $survey->user_id = Auth::id();
            $survey->fill($request->except('user_id'));
            $survey->q1 = $request->input('q1');
            $survey->q2 = $request->input('q2');
            $survey->q3 = $request->input('q3');
            $survey->q4 = $request->input('q4');
            $survey->q5 = $request->input('q5');
            $survey->q6 = $request->input('q6');
            $survey->q7 = $request->input('q7');
            $survey->q8 = $request->input('q8');
            $survey->q9 = $request->input('q9');
            $survey->q10 = $request->input('q10');
            $survey->q11 = $request->input('q11');
            $survey->save();
    
    
            Session::forget('surveyContent');
    
            return redirect()->route('home')->with('success', 'Survey submitted successfully!');
        }
    
        return redirect()->route('login')->with('error', 'Please log in to submit a survey.');
    }

    public function showSurveyResults()
{
    
    $surveyData = Survey::all();
    return view('admin.landing', compact('surveyData'));
}

public function exportSurveyData()
{
    $surveyData = Survey::all(); // Fetch survey data from the database

    // Generate CSV file
    $csvFileName = 'survey_data.csv';
    $headers = array(
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$csvFileName",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    );

    $handle = fopen('php://output', 'w');
    // Add a header row
    fputcsv($handle, array_keys($surveyData[0]->getAttributes()));
    // Add survey data
    foreach ($surveyData as $data) {
        fputcsv($handle, $data->getAttributes());
    }
    fclose($handle);

    return Response::stream(function () use ($handle) {
        fclose($handle);
    }, 200, $headers);
}
}
