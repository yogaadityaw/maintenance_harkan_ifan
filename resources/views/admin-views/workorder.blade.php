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
                                        <div class="col-md-4 d-flex align-items-end">
                                            <button class="btn btn-info" data-toggle="modal"
                                                    data-target="#workOrderModal">+ Tambah WorkOrder
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row" id="workOrderCards">
                                        @foreach ($workOrderData as $wo)
                                            <div class="col-12 col-md-4 col-lg-4">
                                                <div class="card card-primary">
                                                    <div class="card-header justify-content-between">
                                                        <h4>{{ $wo['work_order_code'] }}</h4>
                                                        <h4>{{ $wo['work_order_name'] }}</h4>
                                                        <h4>{{ $wo['work_order_duration'] }} Jam </h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <p>Kode WorkOrder: {{ $wo['work_order_code'] }}</p>
                                                        <p>Nama Pekerjaan: {{ $wo['work_order_name'] }}</p>
                                                        <p>Total Jam Kerja: {{ $wo['work_order_duration'] }} Jam</p>
                                                    </div>
                                                    <div class="card-footer d-flex justify-content-end ">
                                                        <button class="btn btn-warning fas fa-pencil mr-2"
                                                                id="buttonEdit"
                                                                data-toggle="modal"
                                                                data-target="#workOrderEditModal"
                                                                data-workorder-id="{{ $wo['id_work_order'] }}"
                                                                data-workorder-duration="{{ $wo['work_order_duration'] }}">
                                                        </button>
                                                        <button class="btn btn-danger fas fa-trash "
                                                                data-toggle="modal"
                                                                data-target="#workOrderDeleteModal">
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="container bg-light">
                                    <div class="row rounded w-100 p-2 mb-2 d-flex align-items-center justify-content-between">
                                        <h5 class="text-primary mb-0">Pekerjaan</h5>
                                        <button type="button" class="btn btn-link text-primary mb-0">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4 d-flex align-items-end">
                                            <button class="btn btn-info" data-toggle="modal"
                                                    data-target="#jobModal">+ Tambah Pekerjaan
                                            </button>
                                        </div>
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
                        <input type="hidden" value="{{{$idTimesheet}}}" name="idTimesheet">
                        <label for="workOrderKode">Kode WorkOrder</label>
                        <input type="text" class="form-control" id="workOrderKode" name="kodeworkOrderBaru"
                               placeholder="Masukkan kode WorkOrder">
                        <br>
                        <label for="workOrderName">Nama WorkOrder</label>
                        <input type="text" class="form-control" id="workOrderName" name="nameworkOrderBaru"
                               placeholder="Masukkan nama WorkOrder">
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

{{--modal untuk edit workorder--}}
<div class="modal fade" id="workOrderEditModal" tabindex="-1" role="dialog" aria-labelledby="workOrderEditModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="workOrderEditModalLabel">Edit Durasi Work Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editWorkOrderForm" method="POST" action="{{ route('workorder-edit') }}">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <input type="hidden" name="work_order_id" id="workOrderId">
                    <div class="form-group">
                        <label for="workOrderDuration">Durasi (Jam)</label>
                        <input type="number" class="form-control" id="workOrderDuration" name="work_order_duration"
                               min="0" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="jobModal" tabindex="-1" role="dialog" aria-labelledby="jobModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="createJob" method="" action="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jobModalLabel">Tambah Pekerjaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    @csrf
                    @method('POST')
                    <div id="jobsContainer">
                        <div class="job-section">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="font-weight-bold p-2 mb-0" id="jobTitle1">Pekerjaan 1</p>
                                <button type="button" class="btn btn-link text-danger remove-job d-none"
                                        aria-label="Remove">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td class="px-2">
                                        <input type="text" class="form-control" name="jobDate[]"
                                               placeholder="Tanggal Pekerjaan">
                                    </td>
                                    <td class="px-2">
                                        <input type="text" class="form-control" name="jobName[]"
                                               placeholder="Nama Pekerjaan">
                                    </td>
                                    <td class="px-2">
                                        <input type="text" class="form-control" name="jobWorkOrder[]"
                                               placeholder="WorkOrder">
                                    </td>
                                    <td class="px-2">
                                        <div class="d-flex">
                                            <input type="text" class="form-control" name="jobDuration[]"
                                                   placeholder="Durasi Pengerjaan">
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-link text-primary" id="addMore">+ Tambah Pekerjaan</button>
                    </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#workOrderEditModal').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget);
                let workOrderId = button.data('workorder-id');
                let workOrderDuration = button.data('workorder-duration');

                let modal = $(this);
                modal.find('#workOrderId').val(workOrderId);
                modal.find('#workOrderDuration').val(workOrderDuration);
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const jobsContainer = document.getElementById('jobsContainer');
            let jobCount = 1;

            function updateJobTitles() {
                const jobSections = jobsContainer.querySelectorAll('.job-section');
                jobSections.forEach((section, index) => {
                    const jobTitle = section.querySelector('p');
                    jobTitle.textContent = `Pekerjaan ${index + 1}`;
                    const removeButton = section.querySelector('.remove-job');
                    removeButton.classList.toggle('d-none', index === 0);
                });
            }

            document.getElementById('addMore').addEventListener('click', function () {
                jobCount++;
                const newJobSection = document.createElement('div');
                newJobSection.classList.add('job-section');
                newJobSection.innerHTML = `
            <div class="d-flex justify-content-between align-items-center">
                <p class="font-weight-bold p-2 mb-0">Pekerjaan ${jobCount}</p>
                <button type="button" class="btn btn-link text-danger remove-job" aria-label="Remove">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
            <table class="table">
                <tbody>
                <tr>
                    <td class="px-2">
                        <input type="text" class="form-control" name="jobDate[]" placeholder="Tanggal Pekerjaan">
                    </td>
                    <td class="px-2">
                        <input type="text" class="form-control" name="jobName[]" placeholder="Nama Pekerjaan">
                    </td>
                    <td class="px-2">
                        <input type="text" class="form-control" name="jobWorkOrder[]" placeholder="WorkOrder">
                    </td>
                    <td class="px-2">
                        <input type="text" class="form-control" name="jobDuration[]" placeholder="Durasi Pengerjaan">
                    </td>
                </tr>
                </tbody>
            </table>
        `;
                jobsContainer.appendChild(newJobSection);
                updateJobTitles();
            });

            jobsContainer.addEventListener('click', function (event) {
                if (event.target.closest('.remove-job')) {
                    event.target.closest('.job-section').remove();
                    jobCount--;
                    updateJobTitles();
                }
            });

            updateJobTitles();
        });
    </script>

@endpush


