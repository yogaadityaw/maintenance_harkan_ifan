<?php

namespace App\Http\Controllers\AdminController;

use App\Helper\ApiResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WorkorderController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $response = Http::get(env("API_BASE_URL") . '/workorder');
            $workorder = ApiResponseHelper::extractData($response->json());
            return view('admin-views.workorder', compact('workorder'));
//            dd($workorder);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createWorkorder(Request $request)
    {
        try {
            $apiRequest = Http::post(env("API_BASE_URL") . '/workorder', data: [
                'work_order_name' => $request->input('nameworkOrderBaru'),
            ]);

            $response = $apiRequest->json();

            if($response['success']) {
                return redirect()->back()->with('success', 'Work Order berhasil dibuat');
            } else {
             return redirect()->back()->with('error', 'Work Order gagal dibuat');
            }
            return view('admin-views.workorder');
//            dd($workorder);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
