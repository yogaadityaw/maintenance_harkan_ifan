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
            $timesheet = [];
            return view('admin-views.timesheet', compact('timesheet'))->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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
    public function print(Request $request)
    {
        $id = $request->query('idTimeSheet'); // Ambil parameter dari query string

        try {
            // Kirim request ke API
            $response = Http::get(env("API_BASE_URL") . '/timesheet/export/' . $id);

            if ($response->successful()) {
                // Ambil konten file dari respons API
                $fileContent = $response->body();

                // Ambil nama file dari header Content-Disposition (jika disediakan)
                $fileName = $response->header('Content-Disposition');

                if ($fileName) {
                    // Ekstrak nama file dari header (misalnya: "attachment; filename=example.pdf")
                    preg_match('/filename="?([^"]+)"?/', $fileName, $matches);
                    $fileName = $matches[1] ?? "timesheet_{$id}.pdf"; // Default jika nama tidak ditemukan
                } else {
                    $fileName = "timesheet_{$id}.pdf"; // Default jika header tidak ada
                }

                // Kembalikan respons file untuk diunduh
                return response($fileContent)
                    ->header('Content-Type', 'application/pdf')
                    ->header('Content-Disposition', "attachment; filename={$fileName}");
            }

            // Jika respons gagal
            return redirect()->back()->with('error', 'Gagal memproses file dari server.');
        } catch (\Exception $e) {
            // Tangani jika terjadi error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
