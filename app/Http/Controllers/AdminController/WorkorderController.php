<?php

namespace App\Http\Controllers\AdminController;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Helper\DateTimeParser;
use App\Helper\ApiResponseHelper;
use App\Http\Controllers\Controller;
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
            $responseWorkorder = Http::get(env("API_BASE_URL") . '/workorder/timesheet/' . $id);
            $responseJob = Http::get(env("API_BASE_URL") . '/job/timesheet/' . $id);
            $workOrderData = ApiResponseHelper::extractData($responseWorkorder->json());

            $jobs = ApiResponseHelper::extractData($responseJob->json());

            $jobs = collect($jobs)->map(function ($job) {
                $job['job_date'] = Carbon::parse($job['job_date'])->format('Y-m-d');
                return $job;
            });


            return view('admin-views.workorder', compact('workOrderData', 'idTimesheet', 'jobs'));
        } catch (\Exception $e) {
            //
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
                'timesheet_id' => $request->input('idTimeSheet'),
            ]);

            $response = $apiRequest->json();
            // dd($response); fitur create sudah berjalan tinggal fitur yang lainnya.

            if ($response['success']) {

                return redirect()->back()->with('success', 'Work Order berhasil dibuat');
            } else {
                return redirect()->back()->with('error', 'Work Order gagal dibuat');
            }
            return view('admin-views.workorder');
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

            $apiRequest = Http::put(env("API_BASE_URL") . '/workorder/' . $request->input('work_order_id'), data: [
                'work_order_duration_limit' => $request->input('work_order_duration_limit'),
                'work_order_name' => $request->input('work_order_name'),
                'work_order_code' => $request->input('work_order_code'),
            ]);


            $response = $apiRequest->json();



            if ($response['success']) {
                return redirect()->back()->with('success', 'Work Order berhasil diubah');
            } else {
                return redirect()->back()->with('error', 'Work Order gagal diubah');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    public function deleteWorkorder(Request $request)
    {
        try {
            $apiRequest = Http::delete(env("API_BASE_URL") . '/workorder/' . $request->input('work_order_id'));
            $response = $apiRequest->json();

            if ($response['success']) {
                return redirect()->back()->with('success', 'Work Order berhasil dihapus');
            } else {
                return redirect()->back()->with('error', 'Work Order gagal dihapus');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }



    public function createJob(Request $request)
    {
        $data = $request->validate([
            'jobDate' => 'required|array',
            'jobName' => 'required|array',
            'work_order_id' => 'required|array',
            'jobDuration' => 'required|array',
        ]);

        $jobs = [];
        $workOrderDurations = [];

        for ($i = 0; $i < count($data['jobDate']); $i++) {
            $workOrderId = (int)$data['work_order_id'][$i];
            $jobDuration = (int)$data['jobDuration'][$i];

            // Validasi total durasi
            if (!isset($workOrderDurations[$workOrderId])) {
                $workOrder = Http::get(env("API_BASE_URL") . "/workorder/{$workOrderId}")->json();
                $workOrderDurations[$workOrderId] = $workOrder['data']['work_order_duration'];
            }

            $workOrderDurations[$workOrderId] -= $jobDuration;

            if ($workOrderDurations[$workOrderId] < 0) {
                return redirect()->back()->with('error', "Durasi pekerjaan melebihi batas untuk Work Order ID {$workOrderId}");
            }

            $jobs[] = [
                'job_name' => $data['jobName'][$i],
                'job_duration' => $jobDuration,
                'job_date' => date('c', strtotime($data['jobDate'][$i])),
                'work_order_id' => $workOrderId,
            ];
        }

        try {
            $apiRequest = Http::post(env("API_BASE_URL") . '/job', $jobs);
            $response = $apiRequest->json();

            if ($response['success']) {
                return redirect()->back()->with('success', 'Job berhasil dibuat');
            } else {
                return redirect()->back()->with('error', 'Job gagal dibuat');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    //    public function getJobList()
    //    {
    //        try {
    //            $response = Http::timeout(5)->retry(3, 100)->get(env("API_BASE_URL") . '/job');
    //            $jobs = ApiResponseHelper::extractData($response->json());
    //
    //            return $jobs;
    //        } catch (\Exception $e) {
    //            return [];
    //        }
    //    }

    public function editJob(Request $request)
    {
        // dd($request->all());
        try {
            // Mengonversi format job_date menjadi yy-mm-dd sebelum dikirim ke API
            $jobDate = Carbon::createFromFormat('Y-m-d', $request->input('job_date'))->format('Y-m-d');

            // Mengirimkan data ke API dengan format yang benar
            $apiRequest = Http::put(env("API_BASE_URL") . '/job/' . $request->input('id_job'), [
                'job_date' => $request->input('job_date'),
                'job_name' => $request->input('job_name'),
                'job_duration' => $request->input('job_duration'),
                'work_order_id' => $request->input('work_order_id'),
            ]);

            $response = $apiRequest->json();

            if ($response['success']) {
                return redirect()->back()->with('success', 'Job berhasil diubah');
            } else {
                return redirect()->back()->with('error', 'Job gagal diubah');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    function deleteJob(Request $request)
    {
        try {
            $apiRequest = Http::delete(env("API_BASE_URL") . '/job/' . $request->input('job_id'));
            $response = $apiRequest->json();

            if ($response['success']) {
                return redirect()->back()->with('success', 'Job berhasil dihapus');
            } else {
                return redirect()->back()->with('error', 'Job gagal dihapus');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
