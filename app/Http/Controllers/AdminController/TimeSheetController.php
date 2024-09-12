<?php

namespace App\Http\Controllers\AdminController;

use App\Helper\ApiResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Helper\DateTimeParser;


class TimeSheetController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $response = Http::get(env("API_BASE_URL") . '/timesheet');
            $timesheet = ApiResponseHelper::extractData($response->json());


            foreach ($timesheet as &$item) {
                $item['timesheet_date'] = DateTimeParser::parse($item['timesheet_date']);
            }

            return view('admin-views.timesheet', compact('timesheet'));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        return view('admin-views.timesheet');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createTimesheet(Request $request)
    {
        try {
            // Kirim data ke API

            $response = Http::post(env("API_BASE_URL") . '/timesheet', [
                'timesheet_date' => $request->input('tanggalTimeSheet'),
                'timesheet_name' => $request->input('nametimeSheetBaru'),
            ]);

            // Cek jika berhasil
            if ($response->successful()) {
                return redirect()->route('timesheet.index')->with('success', 'Timesheet berhasil ditambahkan!');
            } else {
                return redirect()->back()->with('error', 'Gagal menambahkan timesheet.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function getDataById($id)
    {
        try {
            $response = Http::get(env("API_BASE_URL") . '/timesheet/' . $id);
            $timesheet = ApiResponseHelper::extractData($response->json());

            return response()->json([
                'success' => true,
                'data' => $timesheet
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data timesheet.'
            ]);
        }
    }

    public function edit(Request $request)
    {

        try {
            // Kirim data yang diupdate ke API
            $response = Http::put(env("API_BASE_URL") . '/timesheet/' . $request->input('idTimeSheet'), [
                'timesheet_date' => $request->input('tanggalTimeSheet'),
                'timesheet_name' => $request->input('nametimeSheet'),
            ]);

            // Cek jika berhasil
            if ($response->successful()) {
                return redirect()->route('timesheet')->with('success', 'Timesheet berhasil diupdate!');
            } else {
                return redirect()->back()->with('error', 'Gagal mengupdate timesheet.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function delete(Request $request)
    {
        $id = $request->input('idTimeSheet');

        try {
            $response = Http::delete(env("API_BASE_URL") . '/timesheet/' . $id);

            if ($response->successful()) {
                return redirect()->route('timesheet')->with('success', 'Timesheet berhasil dihapus!');
            } else {
                return redirect()->back()->with('error', 'Gagal menghapus timesheet.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */


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
