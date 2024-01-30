<?php
namespace App\Services;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Http;


class QuoteService
{
    public function getQuotes()
{
    $apiUrl = 'https://type.fit/api/quotes';
    $maxRetries = 3;
    $retryDelay = 500; // milliseconds

    for ($i = 0; $i < $maxRetries; $i++) {
        try {
            $response = Http::timeout(10)->get($apiUrl);
            return $response->json();
        } catch (\Exception $e) {
            // Log the error or handle it accordingly
            // Wait for a short delay before retrying
            usleep($retryDelay * 1000); // usleep uses microseconds
        }
    }

    // If the API call fails after all retries, return an empty array or show an error message
    return [];
}

}
