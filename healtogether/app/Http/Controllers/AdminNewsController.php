<?php

// app/Http/Controllers/Admin/NewsController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class AdminNewsController extends Controller
{
    public function showUploadForm()
    {
        return view('admin.news-upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->getRealPath();
            $imageBlob = file_get_contents($imagePath);
        }

        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imageBlob ?? null,
        ]);

        return redirect()->route('admin.news-upload')->with('success', 'News uploaded successfully!');
    }
    public function newslist()
    {
        $news = News::latest()->get();
        return view('admin.newslist', compact( 'news'));
    }

    public function deletenews($id)
    {
        $story = News::findOrFail($id);
        $story->delete();

        return redirect()->route('admin.newslist')->with('success', 'News deleted successfully!');
    }
}
