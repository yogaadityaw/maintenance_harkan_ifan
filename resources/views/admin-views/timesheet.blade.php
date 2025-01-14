@extends('stisla.layouts.app')

@section('title', 'Blank Page')

@push('style')
    <!-- CSS Libraries -->

    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/prismjs/themes/prism.min.css') }}">
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
                                        <button class="btn btn-info" data-toggle="modal" data-target="#timeSheetModal">+
                                            Tambah Timehseet
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
                                        @foreach ($timesheet as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item['timesheet_date'] ?? '-' }}</td>
                                                <!-- Menampilkan tanggal -->
                                                <td>{{ $item['timesheet_name'] ?? '-' }}</td>
                                                <!-- Menampilkan nama timesheet -->
                                                <td>
                                                    <!-- Tambahkan aksi seperti tombol edit/hapus di sini -->

                                                    <a href="{{ route('workorder', $item['id_timesheet']) }}"
                                                        class="btn btn-success fas fa-book"></a>
                                                    <button type="button" class="btn btn-primary printButton fas fa-print"
                                                        data-timesheet-id="{{ $item['id_timesheet'] }}"></button>

                                                    <button type="button" class="btn btn-warning editButton fas fa-pencil"
                                                        data-toggle="modal" data-target="#editTimeSheetModal"
                                                        data-timesheet-id="{{ $item['id_timesheet'] }}"
                                                        data-timesheet-name="{{ $item['timesheet_name'] }}"
                                                        data-timesheet-date="{{ $item['timesheet_date'] }}">
                                                    </button>
                                                    <button type="button" class="btn btn-danger fas fa-trash"
                                                        data-toggle="modal" data-target="#deleteTimeSheetModal"
                                                        data-timesheet-id="{{ $item['id_timesheet'] }}">
                                                    </button>
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
                                            <a class="page-link" href="#" tabindex="-1"><i
                                                    class="fas fa-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1 <span
                                                    class="sr-only">(current)</span></a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
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



{{-- modal untuk menambah timesheet --}}
<div class="modal fade" id="timeSheetModal" tabindex="-1" role="dialog" aria-labelledby="timeSheetModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="CreateTimesheet" method="POST" action="{{ route('timesheet-create') }}">
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
                                <input type="text" class="form-control datepicker" id="tanggalTimeSheet"
                                    name="tanggalTimeSheet">
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

{{-- modal untuk edit timesheet --}}
<div class="modal fade" id="editTimeSheetModal" tabindex="-1" role="dialog"
    aria-labelledby="editTimeSheetModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="editTimesheetForm" method="POST" action="{{ route('timesheet-edit') }}">
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
                    @method('PUT')
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="idTimeSheet" name="idTimeSheet">
                        <div class="form-group col-md4">
                            <label for="tanggalTimeSheet">Tanggal Timesheet</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control datepicker" id="tanggalTimeSheet"
                                    name="tanggalTimeSheet">
                            </div>
                        </div>

                        <label for="timeSheetName">Nama Timesheet</label>
                        <input type="text" class="form-control" id="timeSheetName" name="nametimeSheet"
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

{{-- modal delete --}}

{{-- Modal untuk konfirmasi delete --}}
<div class="modal fade" id="deleteTimeSheetModal" tabindex="-1" role="dialog"
    aria-labelledby="deleteTimeSheetModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="deleteTimesheetForm" method="POST" action="{{ route('timesheet-delete') }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTimeSheetModalLabel">Hapus Timesheet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus timesheet ini?</p>
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="deleteTimesheetId" name="idTimeSheet">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>



@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('library/prismjs/prism.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/locale/id.min.js"></script>
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/page/modules-sweetalert.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#editTimeSheetModal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                let timesheetId = button.data('timesheet-id');
                let timesheetName = button.data('timesheet-name');
                let timesheetDate = button.data('timesheet-date');
                moment.locale('id');
                let formattedDate = moment(timesheetDate, 'dddd, DD MMMM YYYY').format('YYYY-MM-DD');

                let modal = $(this);
                modal.find('#idTimeSheet').val(timesheetId);
                modal.find('#timeSheetName').val(timesheetName);
                modal.find('#tanggalTimeSheet').val(formattedDate);
            });

            $('#deleteTimeSheetModal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                let timesheetId = button.data('timesheet-id');

                let modal = $(this);
                modal.find('#deleteTimesheetId').val(timesheetId);
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Event listener untuk tombol print
            document.querySelectorAll('.printButton').forEach(button => {
                button.addEventListener('click', function() {
                    const timesheetId = this.getAttribute('data-timesheet-id');

                    if (timesheetId) {
                        // Arahkan ke route untuk print
                        const url = `{{ route('timesheet-print') }}?idTimeSheet=${timesheetId}`;
                        window.open(url, '_blank'); // Membuka file dalam tab baru
                    } else {
                        alert('ID timesheet tidak ditemukan.');
                    }
                });
            });
        });
    </script>
@endpush
