<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class StoryController extends Controller
{
    public function show($id)
    {
        $story = Story::findOrFail($id);
        $comments = $story->comments()->with('user')->get();
        
        return view('users.comments', compact('story', 'comments'));
        
    }

    public function submitComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|max:255',
        ]);

        $story = Story::findOrFail($id);

        $comment = new Comment();
        $comment->comment = $request->input('comment');
        $comment->user_id = Auth::user()->id;
        $comment->story_id = $story->id;
        $comment->save();

        return redirect()->route('story.show', $story->id)->with('success', 'Comment submitted successfully!');
    }

    public function writestory()
    {
        $timeRemaining = 0;
        $storyContent = Session::get('storyContent', ''); // Retrieve story content from session

        if (Auth::check()) {
            $lastStory = Story::where('user_id', Auth::user()->id)
                ->latest()
                ->first();

            if ($lastStory) {
                $currentTime = now();
                $lastStoryTime = $lastStory->created_at;
                $hoursSinceLastStory = $currentTime->diffInHours($lastStoryTime);
                $timeRemaining = max(0, 12 - $hoursSinceLastStory);
            }
        }

        return view('users.writestory', compact('timeRemaining', 'storyContent'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'story' => 'required|string|max:355',
        ]);

        if (Auth::check()) {
            $story = new Story();
            $story->user_id = Auth::id();
            $story->title = $request->title;
            $story->story = $request->input('story');
            $story->save();

            $storyContent = $request->input('story');
            Session::put('storyContent', $storyContent); // Store story content in session

            // Add your story submission logic here
            // ...

            Session::forget('storyContent'); // Clear the stored story content from session

            return redirect()->route('home')->with('success', 'Story submitted successfully!');
        }

        return redirect()->route('login')->with('error', 'Please login to submit a story.');
    }
    public function profile()
    {
        // Get the authenticated user's stories
        $user = Auth::user();
        $stories = $user->stories;
        return view('users.profile', compact('stories'));
    }
    public function destroy(Story $story)
{
    // Check if the user is authorized to delete this story
    if (auth()->user()->can('delete', $story)) {
        // Delete the story
        $story->delete();

        return redirect()->route('profile')
            ->with('success', 'Story deleted successfully');
    } else {
        return redirect()->route('profile')
            ->with('error', 'You are not authorized to delete this story');
    }
}

}
