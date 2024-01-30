<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Story;
use App\Models\News;
use App\Models\Event;
use App\Services\FlaskService;

use App\Services\QuoteService;

use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;


class UserController extends Controller
{
    //home
    protected $quoteService;

    public function __construct(QuoteService $quoteService)
    {
        $this->quoteService = $quoteService;
    }

    public function index()
    {
        $stories = Story::with('user')->orderByDesc('created_at')->get();
        $events = Event::latest()->orderByDesc('created_at')->get();

        $news = News::latest()->limit(6)->get();
        $quotes = $this->quoteService->getQuotes();
        $quotes = new Paginator($quotes, 6);
       


        return view('layout.home', compact('stories', 'news', 'quotes','events'));
    }
    public function news()
    {
        $news = News::latest()->limit(6)->get();
        return view('layout.news', compact( 'news'));
    }
    public function quotes()
    {
        $quotes = $this->quoteService->getQuotes();
        $quotes = new Paginator($quotes, 20);

        return view('layout.quotes', compact( 'quotes'));
    }
    public function deleteStory($id)
    {
        $user = Auth::user();
        $story = Story::where('id', $id)->where('user_id', $user->id)->first();
    
        if (!$story) {
            return redirect()->route('profile')->with('error', 'Story not found or you are not authorized to delete this story.');
        }
    
        $story->delete();
    
        return redirect()->route('profile')->with('success', 'Story deleted successfully!');
    }
    






    //reg
    public function showRegistrationForm()
    {
        return view('auth/register');
    }
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone_number' => 'required|string|max:15|unique:users',
            'address' => 'required|string|max:255',
            'age' => 'required|integer|min:18|max:99'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'age' => $request->age
        ]);

        return redirect()->route('home')->with('success', 'Account created successfully!');

    }
    public function showLoginForm()
    {
        return view('auth/login');
    }
    public function login(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            // Authentication successful
            return redirect('/');
        }

        return redirect()->back()->withErrors(['message' => 'Invalid credentials. Please try again.']);
    }
  
    

    public function logout()
    {
        auth()->logout();
    
        return redirect()->route('login');
    }
    
   
}
