@extends('stisla.layouts.app')

@section('title', 'Blank Page')

@push('style')
    <!-- CSS Libraries -->

    <link rel="stylesheet"
          href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush

@section('main')<div class="main-content">
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
                            <div class="table-responsive">
                                <table class="table-bordered table-md table">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th> Nama Timesheet</th>
                                        <th>Status</th>
                                        <th>Aksi</th>

                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>2017-01-09</td>
                                        <td>Irwansyah Saputra</td>

                                        <td>
                                            <div class="badge badge-success">Active</div>
                                        </td>
                                        <td>  <div class="dropdown">
                                                <button class="btn btn-outline-info dropdown-toggle" type="button"
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
                                        <td>2017-01-09</td>
                                        <td>Rizal Fakhri</td>

                                        <td>
                                            <div class="badge badge-success">Active</div>
                                        </td>
                                        <td><a href="{{route('workorder')}}"
                                               class="btn btn-success fas fa-book"></a>

                                            <a href="#"
                                               class="btn btn-warning fas fa-pencil"></a>

                                            <a href="#"
                                               class="btn btn-danger fas fa-trash"></a>

                                        </td>
                                    </tr>
                                </table>
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
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th> Nama Timesheet</th>
                                        <th>Status</th>
                                        <th>Aksi</th>

                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>2017-02-09</td>
                                        <td>Irwansyah Saputra</td>

                                        <td>
                                            <div class="badge badge-success">Active</div>
                                        </td>
                                        <td>  <div class="dropdown">
                                                <button class="btn btn-outline-info dropdown-toggle" type="button"
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
                                                                    href="#">1 <span class="sr-only">(current)</span></a></li>
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

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <!-- Page Specific JS File -->
@endpush
