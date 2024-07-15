<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;

class StateController extends Controller
{
    public function fetchState(Request $request)
    {
        $data['states'] = State::where("country_id", $request->country_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }
}
