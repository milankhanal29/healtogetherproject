<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminNewsController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\EventController;



use App\Http\Controllers\FlaskServiceController;
use Illuminate\Support\Facades\Http;
Route::post('/services/flaskservice/cluster', [FlaskServiceController::class, 'clusterData'])->name('flaskservice.cluster');
Route::post('/cluster-data', function () {
    $data = [
        
    ];

    $response = Http::post('http://localhost:5000/cluster', $data);

    if ($response->successful()) {
        $clusters = $response->json('clusters');
        // Process the clustering results as needed
        // ...
        return response()->json(['clusters' => $clusters]);
    } else {
        return response()->json(['error' => 'Failed to get clustering results'], 500);
    }
});


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    // Other admin routes here

    Route::get('news-upload', [AdminNewsController::class, 'showUploadForm'])->name('news-upload');
    Route::post('news-upload', [AdminNewsController::class, 'upload']);
    
});







Route::get('/register', 'App\Http\Controllers\UserController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\UserController@register');

Route::get('/login', 'App\Http\Controllers\UserController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\UserController@login');

Route::post('/logout', 'App\Http\Controllers\UserController@logout')->name('logout');


Route::get('/users/writestory', [StoryController::class, 'writestory'])->name('writestory');

Route::post('/story/submit', [StoryController::class, 'submit'])->name('story.submit');

Route::resource('events', EventController::class);



//export csv
Route::get('/export-survey-data', [SurveyController::class,'exportSurveyData']);

Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('home');
Route::get('/news', [App\Http\Controllers\UserController::class, 'news'])->name('news');

Route::get('/quotes', [App\Http\Controllers\UserController::class, 'quotes'])->name('quotes');
Route::delete('/story/{id}', [UserController::class, 'deleteStory'])->name('story.delete');

Route::get('/profile', [StoryController::class, 'profile'])->name('profile');
Route::delete('/stories/{story}', [StoryController::class, 'destroy'])->name('story.delete');

Route::post('/story/{id}/comments', [StoryController::class, 'submitComment'])->name('comment.submit');
Route::get('/story/{id}', [StoryController::class, 'show'])->name('story.show');

Route::get('/admin/events', [EventController::class, 'events'])->name('admin.events');

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);

// Admin landing page
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::group(['middleware' => 'auth:admin'], function () {
Route::get('/admin/landing', [AdminController::class, 'landing'])->name('admin.landing');
   
    // Admin story list
    Route::get('/admin/storylist', [AdminController::class, 'storyList'])->name('admin.storylist');

    // Admin delete story
    Route::delete('/admin/story/{id}', [AdminController::class, 'deleteStory'])->name('admin.deleteStory');
 // Admin story list
 Route::get('/admin/newslist', [AdminNewsController::class, 'newsList'])->name('admin.newslist');

 // Admin delete story
 Route::delete('/admin/news/{id}', [AdminNewsController::class, 'deletenews'])->name('admin.deletenews');
});

    Route::get('/survey', [SurveyController::class, 'showSurvey'])->name('survey.show');
    Route::post('/submit-survey', [SurveyController::class, 'storeSurvey'])->name('submit.survey');
 


    Route::get('/events/book/{id}', [EventController::class,'showBookingForm'])->name('bookEvent');

Route::post('/events/book/{id}',[EventController::class,'bookEvent'])->name('bookEvent');

// Other routes...

// Default Laravel authentication routes