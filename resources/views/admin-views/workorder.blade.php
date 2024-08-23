@extends('stisla.layouts.app')

@section('title', 'workorder')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
          href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet"
          href="{{ asset('library/prismjs/themes/prism.min.css') }}">

    <link rel="stylesheet"
          href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Workorder</h1>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row col-12 justify-content-between">
                                    <h4>Workorder</h4>
                                    <h4>80 Jam</h4>
                                </div>
                            </div>
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="card-body">

                                <div class="form-group col-md-6">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>
                                                <h6>Pilih WO</h6>
                                            </label>
                                            <select class="form-control select2">
                                            </select>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-end">
                                            <button class="btn btn-info" data-toggle="modal"
                                                    data-target="#workOrderModal">+ Tambah WorkOrder
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="container ">
                                        <div class="row" id="workOrderCards">

                                        </div>
                                    </div>
                                </div>


                                <div class="form-group col-md-2">
                                    <label>
                                        <h6>Tanggal</h6>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control datepicker">
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table-bordered table-md table">
                                        <tr>
                                            <th> No</th>
                                            <th> Kode WO</th>
                                            <th> Nama Pekerjaan</th>
                                            <th> Total Jam Kerja</th>
                                            <th> Aksi</th>

                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>102</td>
                                            <td>2017-01-09</td>
                                            <td>
                                                2 Jam
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-info dropdown-toggle"
                                                            type="button"
                                                            id="dropdownMenuButton-"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="#">
                                                            <i class="fas fa-print"></i> Print
                                                        </a>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="fas fa-book"></i> Detail
                                                        </a>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Hasan Basri</td>
                                            <td>2017-01-09</td>
                                            <td>
                                                <div class="badge badge-success">Active</div>
                                            </td>
                                            <td><a href="#"
                                                   class="btn btn-secondary">Detail</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Kusnadi</td>
                                            <td>2017-01-11</td>
                                            <td>
                                                <div class="badge badge-danger">Not Active</div>
                                            </td>
                                            <td><a href="#"
                                                   class="btn btn-secondary">Detail</a></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Rizal Fakhri</td>
                                            <td>2017-01-11</td>
                                            <td>
                                                <div class="badge badge-success">Active</div>
                                            </td>
                                            <td><a href="#"
                                                   class="btn btn-secondary">Detail</a></td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="dropdown d-inline mr-2">
                                    <button class="btn btn-primary dropdown-toggle"
                                            type="button"
                                            id="dropdownMenuButton"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false">
                                        Tambah Baru
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                           href="#">WO (123)</a>
                                        <a class="dropdown-item"
                                           href="#">WO (103)</a>
                                        <a class="dropdown-item"
                                           href="#">WO (105)</a>
                                    </div>
                                </div>

                                <br>
                                <br>


                                {{--                                <div class="container d-inline-block col-12 bg-secondary rounded">--}}
                                {{--                                    <div class="row">--}}
                                {{--                                        <h4 class="">102</h4>--}}
                                {{--                                        <h4>Kerjo</h4>--}}
                                {{--                                        <h4>2 Jam</h4>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                {{--                            </div>--}}
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
                                {{--                        </div>--}}
                                {{--                    </div>--}}


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection



<!-- Modal untuk menambah WorkOrder -->
<div class="modal fade" id="workOrderModal" tabindex="-1" role="dialog" aria-labelledby="workOrderModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="CreateWorkOrder" method="POST" action="{{route('workorder-create')}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="workOrderModalLabel">Tambah WorkOrder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Isi Form atau Konten Modal di sini -->
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="workOrderName">Nama WorkOrder</label>
                        <input type="text" class="form-control" id="workOrderName" name="nameworkOrderBaru"
                               placeholder="Masukkan nama WorkOrder">
                        <br>
                        {{--                        <label for="workOrderKode">Kode WorkOrder</label>--}}
                        {{--                        <input type="text" class="form-control" id="workOrderKode" name="kodeworkOrderBaru"--}}
                        {{--                               placeholder="Masukkan kode WorkOrder">--}}
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
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- Page Specific JS File -->

    <script>
        $(document).ready(function () {
            function initializeSelect2() {
                $('.select2').select2({
                    placeholder: 'Select a work order',
                    allowClear: true
                });
            }

            initializeSelect2();

            function loadWorkOrders() {
                $.ajax({
                    url: "{{ route('workorder-get-data') }}",
                    method: 'GET',
                    success: function (response) {
                        let selectElement = $('.select2');
                        selectElement.empty();

                        selectElement.append('<option></option>');

                        response.forEach(function (workOrder) {
                            let option = new Option(workOrder.id_work_order + ' - ' + workOrder.work_order_name, workOrder.id_work_order);
                            selectElement.append(option);
                        });

                        initializeSelect2();
                    },
                    error: function (xhr, status, error) {
                        console.error("An error occurred while loading work orders:", error);
                    }
                });
            }

            loadWorkOrders();
        });
    </script>
@endpush


