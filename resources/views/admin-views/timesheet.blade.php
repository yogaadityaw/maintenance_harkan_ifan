@extends('stisla.layouts.app')

@section('title', 'Blank Page')

@push('style')
    <!-- CSS Libraries -->

    <link rel="stylesheet"
          href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
          href="{{ asset('library/prismjs/themes/prism.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Timesheet</h1>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Timesheet</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group col-md-6">
                                    <div class="row">
                                        <button class="btn btn-info" data-toggle="modal"
                                                data-target="#timeSheetModal">+ Tambah Timehseet
                                        </button>
                                    </div>
                                </div>

                            <div class="table-responsive">
                                <table class="table-bordered table-md table">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th> Nama Timesheet</th>
                                        <th>Aksi</th>

                                    </tr>
                                    @foreach($timesheet as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item['timesheet_date'] ?? '-' }}</td> <!-- Menampilkan tanggal -->
                                            <td>{{ $item['timesheet_name'] ?? '-' }}</td> <!-- Menampilkan nama timesheet -->
                                            <td>
                                                <!-- Tambahkan aksi seperti tombol edit/hapus di sini -->
                                                <a href="{{ route('workorder', $item['id_timesheet']) }}" class="btn btn-success fas fa-book"></a>

                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <nav class="d-inline-block">
                                <ul class="pagination mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link"
                                           href="#"
                                           tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                    </li>
                                    <li class="page-item active"><a class="page-link"
                                                                    href="#">1 <span
                                                class="sr-only">(current)</span></a></li>
                                    <li class="page-item">
                                        <a class="page-link"
                                           href="#">2</a>
                                    </li>
                                    <li class="page-item"><a class="page-link"
                                                             href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link"
                                           href="#"><i class="fas fa-chevron-right"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

            </div>

    </div>
    </section>
    </div>
@endsection

{{--modal untuk menambah timesheet--}}

<div class="modal fade" id="timeSheetModal" tabindex="-1" role="dialog" aria-labelledby="timeSheetModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="CreateTimesheet" method="POST" action="{{route('timesheet-create')}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="timeSheetModalLabel">Tambah Timesheet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Isi Form atau Konten Modal di sini -->
                    @csrf
                    @method('POST')
                    <div class="form-group">

                        <div class="form-group col-md4">
                            <label for="tanggalTimeSheet">Tanggal Timesheet</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                </div>
                                <input type="text" class="form-control datepicker" id="tanggalTimeSheet" name="tanggalTimeSheet">
                            </div>
                        </div>

                        <label for="timeSheetName">Nama Timesheet</label>
                        <input type="text" class="form-control" id="timeSheetName" name="nametimeSheetBaru"
                               placeholder="Masukkan nama Timesheet">

                    </div>
                    <!-- Tambahkan field lain sesuai kebutuhan -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('library/prismjs/prism.js') }}"></script>

    <!-- Page Specific JS File -->
@endpush
