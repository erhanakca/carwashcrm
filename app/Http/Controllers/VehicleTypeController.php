<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use Illuminate\Database\RecordsNotFoundException;



class VehicleTypeController extends Controller
{
    public function index()
    {
        try {
            $data = VehicleType::all();
            return response()->json(['success' => true, 'data' => $data]);
        }catch (RecordsNotFoundException $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }
}
