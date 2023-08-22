<?php

namespace App\Http\Controllers;

use App\Models\ProcessType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProcessTypeController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:process_types,name',
        ]);

        $processType = ProcessType::create($validatedData);
        return response()->json($processType, 201);
    }

    public function index()
    {
        $processTypes = ProcessType::all();
        return response()->json($processTypes);
    }
}
