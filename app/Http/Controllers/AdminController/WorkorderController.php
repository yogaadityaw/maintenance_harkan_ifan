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
    public function index($id)
    {
        $idTimesheet = $id;
        try {
            $response = Http::get(env("API_BASE_URL") . '/timesheet/' . $id);
            $workorder = ApiResponseHelper::extractData($response->json());
            $workOrderData = $workorder['work_orders'];
            return view('admin-views.workorder', compact('workOrderData', 'idTimesheet'));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function getWorkOrderList()
    {
        try {
            $response = Http::get(env("API_BASE_URL") . '/workorder');
            $workorder = ApiResponseHelper::extractData($response->json());
            return $workorder;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function createWorkorder(Request $request)
    {
        try {
            $apiRequest = Http::post(env("API_BASE_URL") . '/workorder', data: [
                'work_order_name' => $request->input('nameworkOrderBaru'),
                'work_order_code' => $request->input('kodeworkOrderBaru'),
                'timesheet_id' => $request->input('idTimesheet'),
            ]);

            $response = $apiRequest->json();

            if ($response['success']) {

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

    public function editWorkorder(Request $request)
    {

        try {

            $apiRequest = Http::patch(env("API_BASE_URL") . '/workorder/update-duration/' . $request->input('work_order_id'), data: [
                'work_order_duration' => $request->input('work_order_duration'),
            ]);

            $response = $apiRequest->json();

            if ($response['success']) {
                return redirect()->back()->with('success', 'Work Order berhasil diubah');
            } else {
                return redirect()->back()->with('error', 'Work Order gagal diubah');
        }

        }catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function createJob(Request $request)
    {

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
