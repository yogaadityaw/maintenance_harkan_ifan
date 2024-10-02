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

            $jobs = $this->getJobList();

            foreach ($jobs as &$job) {
                foreach ($workOrderData as $workOrder) {
                    if ($workOrder['id_work_order'] == $job['work_order_id']) {
                        $job['work_order_code'] = $workOrder['work_order_code']; // Tambahkan work_order_code ke job
                    }
                }
            }

            if (empty($jobs)) {
                return view('admin-views.workorder', compact('workOrderData', 'idTimesheet'))->withErrors('Gagal mengambil data jobs');
            }

            return view('admin-views.workorder', compact('workOrderData', 'idTimesheet', 'jobs'));
        } catch (\Exception $e) {
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

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function createJob(Request $request)
    {


// Ambil semua data dari form
        $data = $request->validate([
            'jobDate' => 'required|array',
            'jobName' => 'required|array',
            'work_order_id' => 'required|array',
            'jobDuration' => 'required|array',
        ]);


        // Loop setiap pekerjaan yang diinputkan
        $jobs = [];
        for ($i = 0; $i < count($data['jobDate']); $i++) {
            $jobs[] = [
                'job_name' => $data['jobName'][$i],
                'job_duration' => (int)$data['jobDuration'][$i],
                'job_date' => date('c', strtotime($data['jobDate'][$i])),
                'work_order_id' => (int)$data['work_order_id'][$i],
            ];
        }
        // Kirim data ke API backend
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

    public function getJobList()
    {
        try {
            $response = Http::timeout(5)->retry(3, 100)->get(env("API_BASE_URL") . '/job');
            $jobs = ApiResponseHelper::extractData($response->json());

            return $jobs;
        } catch (\Exception $e) {
            return [];
        }
    }


}
