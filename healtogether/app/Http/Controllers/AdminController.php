<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\Story; 
use App\Models\Survey;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.landing');
        }

        return redirect()->route('admin.login')->with('error', 'Invalid credentials.');
    }

    public function landing()
    {
        $surveyData = Survey::all();
        return view('admin.landing', compact('surveyData'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'You have been logged out successfully.');
    }
    public function storyList()
    {
        $stories = Story::with('user')->get();
        return view('admin.storylist', compact('stories'));
    }

    public function deleteStory($id)
    {
        $story = Story::findOrFail($id);
        $story->delete();

        return redirect()->route('admin.storylist')->with('success', 'Story deleted successfully!');
    }
}
