<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        try {
            $data = Service::all();
            return response()->json(['success' => true, 'data' => $data]);
        }catch (RecordsNotFoundException $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }

    public function save()
    {
        
    }
}
