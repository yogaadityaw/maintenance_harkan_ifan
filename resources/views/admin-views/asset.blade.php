@extends('stisla.layouts.app')

@section('title', 'Blank Page')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Asset Harkan</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tabel Asset Harkan</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-bordered table-md table">
                                    <tr>
                                        <th>No</th>
                                        <th>Sepesifikasi Alat</th>
                                        <th>Nama / Tipe</th>
                                        <th>Warna</th>
                                        <th>Label Asset</th>
                                        <th>PIC</th>
                                        <th>Lokasi</th>
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

    <!-- Page Specific JS File -->
@endpush
