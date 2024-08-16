@extends('stisla.layouts.app')

@section('title', 'workorder')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
          href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">

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
                            <div class="card-body">

                                <div class="form-group col-md-2">
                                    <label>
                                        <h6>Pilih WO</h6>
                                    </label>
                                    <select class="form-control select2"
                                            multiple="">
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                        <option>Option 4</option>
                                        <option>Option 5</option>
                                        <option>Option 6</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card bg-secondary">
                                            <div class="card-header justify-content-between">
                                                <h4>101</h4>
                                                <h4>80 Jam</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table-bordered table-md table">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Created At</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Irwansyah Saputra</td>
                                                            <td>2017-01-09</td>
                                                            <td>
                                                                <div class="badge badge-success">Active</div>
                                                            </td>
                                                            <td><a href="#"
                                                                   class="btn btn-secondary">Detail</a></td>
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
                                            </div>
                                            <div class="card-footer text-right">
                                                <button class="btn btn-success fas fa-book"></button>
                                                <button class="btn btn-warning fas fa-pencil"></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card bg-secondary">
                                            <div class="card-header">
                                                <h4>Card Action Button</h4>
                                            </div>
                                            <div class="card-body">
                                                This is some text within a card body.
                                            </div>
                                            <div class="card-footer text-right">
                                                <button class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card bg-secondary">
                                            <div class="card-header">
                                                <h4>Card Action Button</h4>
                                            </div>
                                            <div class="card-body">
                                                This is some text within a card body.
                                            </div>
                                            <div class="card-footer text-right">
                                                <button class="btn btn-primary">Submit</button>
                                            </div>
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

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- Page Specific JS File -->
@endpush
