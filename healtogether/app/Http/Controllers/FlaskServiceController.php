<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FlaskService;

class FlaskServiceController extends Controller
{
    public function clusterData(Request $request)
    {
        $request->validate([
            'data' => 'required|array',
        ]);

        // Retrieve the data from the request
        $data = $request->input('data');

        // Call the FlaskService to cluster the data
        $flaskService = new FlaskService();
        $clusteredData = $flaskService->clusterData($data);

        // Return the clustered data as a JSON response
        return response()->json(['clustered_data' => $clusteredData]);
    }
}
