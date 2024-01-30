<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\EventBooking;
use App\Services\FlaskService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class EventController extends Controller
{
    protected $flaskService;

    public function __construct(FlaskService $flaskService)
    {
        $this->flaskService = $flaskService;
    }
    public function index(Request $request)
    {
        $userId = Auth::id(); 
        
        $userData = [
            'user_id' => $userId,
            
        ];


        $response = $this->flaskService->clusterData($userData);
// dd($response)
        if (!empty($response) && isset($response[0]['cluster'])) {
            $userCluster = $response[0]['cluster'];

            
            $recommendedEvents = $this->getRecommendedEvents($userCluster,$userId);

            $events = Event::all();

            $events = $this->sortEventsByRecommendations($events, $recommendedEvents);

            return view('layout.events', compact('events'));
        }

        return view('layout.events', ['events' => []]);
    }
    private function getRecommendedEvents($userCluster, $userId)
    {
       
        $bookedEvents = EventBooking::whereIn('user_id', function ($query) use ($userCluster, $userId) {
            $query->select('user_id')
                ->from('users') 
                ->where('user_id', '!=', $userId); 
        })
        ->pluck('event_id')
        ->toArray();
    
        // Fetch the recommended events based on the booked events
        $recommendedEvents = Event::whereIn('id', $bookedEvents)->get();
    
        return $recommendedEvents;
    }
    
    
    
    
    private function sortEventsByRecommendations($events, $recommendedEvents)
    {
        $sortedEvents = $recommendedEvents->concat($events->diff($recommendedEvents));
        return $sortedEvents;
    }
    

public function events()
{
    $events = Event::all();
    return view('admin.events_list',compact('events'));
}

public function create()
{
    return view('admin.add_event');
}


public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'description' => 'required|string',
        'date' => 'required|date',
        'price' => 'required|numeric',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed.
    ]);
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->getRealPath();
        $imageBlob = file_get_contents($imagePath);
    }

    // Create a new event in the database
    $event = new Event();
    $event->name = $request->input('name');
    $event->description = $request->input('description');
    $event->date = $request->input('date');
    $event->price = $request->input('price');
    $event->image = $imageBlob??null; // Store the image path in the database

    $event->save();

    // Redirect back to the event list or any other desired route
    return redirect()->route('admin.events')->with('success', 'Event added successfully');
}

public function edit(Event $event)
{
    return view('edit_event', compact('event'));
}

public function update(Request $request, Event $event)
{
    // Update an existing event
}

public function destroy(Event $event)
{
    $event->delete();
    return redirect()->route('admin.events')->with('success', 'Event deleted successfully');
}
public function showBookingForm($id) {
    // Fetch the event details based on the provided $id
    $event = Event::find($id);
    $user = Auth::user();
    session(['name' => $user->name, 'email' => $user->email]);
    if (!$event) {
        // Handle the case where the event is not found, e.g., return a 404 view
    }

    return view('layout.booking-form', ['event' => $event]);
}

public function bookEvent(Request $request, $eventId) {
    $user = Auth::user();
    $event = Event::find($eventId);

    // Check if the user has already booked the event
    $existingBooking = EventBooking::where('event_id', $event->id)
        ->where('user_id', $user->id)
        ->first();

    if ($existingBooking) {
        // User has already booked this event
        return redirect()->back()->with('error', 'You have already booked this event.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|min:10|max:10',
    ]);

    // Create a booking record
    $booking = new EventBooking;
    $booking->event_id = $eventId;
    $booking->user_id = $user->id;
    $booking->name = $request->input('name');
    $booking->email = $request->input('email');
    $booking->phone = $request->input('phone');
    $booking->save();

    return redirect()->route('home', $eventId)->with('success', 'Booking successful!');
}


}
