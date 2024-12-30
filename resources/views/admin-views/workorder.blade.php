@extends('stisla.layouts.app')

@section('title', 'workorder')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('library/prismjs/themes/prism.min.css') }}">

    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
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
                                <div class="form-group">
                                    <div class="container bg-light shadow-sm rounded p-3 mb-3">
                                        <div class="row d-flex align-items-center justify-content-between">
                                            <div class="col-auto">
                                                <h5 class="text-primary mb-0">Workorder</h5>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button"
                                                    class="btn btn-primary rounded-circle p-2 d-flex justify-content-center align-items-center"
                                                    style="width: 40px; height: 40px;" data-toggle="modal"
                                                    data-target="#workOrderModal" data-idTimesheet-id="{{ $idTimesheet }}">
                                                    <i class="fas fa-plus text-white"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row" id="workOrderCards">
                                        @if (isset($workOrderData) && count($workOrderData) > 0)
                                            @foreach ($workOrderData as $wo)
                                                <div class="col-12 col-md-4 col-lg-4">
                                                    <div class="card card-primary shadow-sm">
                                                        <div
                                                            class="card-header d-flex justify-content-between align-items-center">
                                                            <h5 class="mb-0">
                                                                <i class="fas fa-clipboard-list"></i>
                                                                {{ $wo['work_order_code'] }}
                                                            </h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <h6><i class="fas fa-clock"></i> Durasi Pekerjaan:</h6>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar {{ $wo['work_order_duration'] <= 0 ? 'bg-danger' : 'bg-success' }}"
                                                                    role="progressbar"
                                                                    style="width: {{ $wo['work_order_duration_limit'] > 0 ? ($wo['work_order_duration'] / $wo['work_order_duration_limit']) * 100 : 0 }}%"
                                                                    aria-valuenow="{{ $wo['work_order_duration'] }}"
                                                                    aria-valuemin="0"
                                                                    aria-valuemax="{{ $wo['work_order_duration_limit'] }}">
                                                                    {{ $wo['work_order_duration'] }}
                                                                    / {{ $wo['work_order_duration_limit'] }} Jam Tersisa
                                                                </div>
                                                            </div>
                                                            <h6><i class="fas fa-briefcase"></i> Nama Workorder:</h6>
                                                            <p>{{ $wo['work_order_name'] }}</p>
                                                        </div>
                                                        <div class="card-footer d-flex justify-content-end">
                                                            <button class="btn btn-success fas fa-book mx-1"></button>
                                                            <button class="btn btn-warning fas fa-pencil mr-2"
                                                                id="buttonEdit" data-toggle="modal"
                                                                data-target="#workOrderEditModal"
                                                                data-workorder-id="{{ $wo['id_work_order'] }}"
                                                                data-workorder-duration="{{ $wo['work_order_duration'] }}"
                                                                data-workorder-code="{{ $wo['work_order_code'] }}"
                                                                data-workorder-name="{{ $wo['work_order_name'] }}">
                                                            </button>
                                                            <button class="btn btn-danger fas fa-trash" id="buttonDelete"
                                                                data-toggle="modal" data-target="#workOrderDeleteModal"
                                                                data-workorder-id="{{ $wo['id_work_order'] }}">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="col-12 text-center">
                                                <p class="text-muted">Tidak ada Workorder</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="container bg-light shadow-sm rounded p-3 mb-3">
                                    <div class="row d-flex align-items-center justify-content-between">
                                        <div class="col-auto">
                                            <h5 class="text-primary mb-0">Pekerjaan</h5>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button"
                                                class="btn btn-primary rounded-circle p-2 d-flex justify-content-center align-items-center"
                                                style="width: 40px; height: 40px;" data-toggle="modal"
                                                data-target="#jobModal">
                                                <i class="fas fa-plus text-white"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table-bordered table-md table">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Tanggal</th>
                                                        <th>Pekerjaan</th>
                                                        <th>Kode WO</th>
                                                        <th>Nama Work Order</th>
                                                        <th>Durasi</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                    @if (isset($jobs) && count($jobs) > 0)
                                                        @foreach ($jobs as $index => $job)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $job['job_date'] }}</td>
                                                                <td>{{ $job['job_name'] }}</td>
                                                                <td>{{ $job['work_order_code'] }}</td>
                                                                <td>{{ $job['work_order_name'] }}</td>
                                                                <td>{{ $job['job_duration'] }}</td>
                                                                <td>


                                                                    <button class="btn btn-warning fas fa-pencil mx-1"
                                                                        data-toggle="modal" data-target="#jobEditModal"
                                                                        data-job-date="{{ $job['job_date'] }}"
                                                                        data-job-id="{{ $job['id_job'] }}"
                                                                        data-workorder-id="{{ $job['work_order_id'] }}"
                                                                        data-job-name="{{ $job['job_name'] }}"
                                                                        data-job-date="{{ $job['job_date'] }}"
                                                                        data-job-duration="{{ $job['job_duration'] }}">

                                                                    </button>


                                                                    <button class="btn btn-danger fas fa-trash mx-1"
                                                                        onclick="showDeleteModal({{ $job['id_job'] }})"
                                                                        data-toggle="modal"
                                                                        data-target="#deleteModal"></button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="5" class="text-center">Data tidak tersedia</td>
                                                        </tr>
                                                    @endif
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
                                                    <li class="page-item active"><a class="page-link" href="#">1
                                                            <span class="sr-only">(current)</span></a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#">2</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#"><i
                                                                class="fas fa-chevron-right"></i></a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <p class="text-muted">Tidak ada pekerjaan</p>
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
        <form id="CreateWorkOrder" method="POST" action="{{ route('workorder.create', $idTimesheet) }}">
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
                        <input type="hidden" value="{{ $idTimesheet }}" name="idTimeSheet">
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

{{-- modal untuk edit workorder --}}
<div class="modal fade" id="workOrderEditModal" tabindex="-1" role="dialog"
    aria-labelledby="workOrderEditModalLabel" aria-hidden="true">
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
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="workOrderDuration">Durasi (Jam)</label>
                        <input type="hidden" class="form-control" id="workOrderId" name="work_order_id" required>
                        <input type="number" class="form-control" id="workOrderDuration" name="work_order_duration"
                            min="0" required>
                        <label for="workOrderCode">Kode Workorder</label>
                        <input type="number" class="form-control" id="workOrderCode" name="work_order_code"
                            required>
                        <label for="workOrderDuration">Nama Workorder</label>
                        <input type="text" class="form-control" id="workOrderName" name="work_order_name"
                            required>
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


<!-- Delete Confirmation Modal -->
<div class="modal fade" id="workOrderDeleteModal" tabindex="-1" role="dialog"
    aria-labelledby="workOrderDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="workOrderDeleteModalLabel">Konfirmasi Hapus Work Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteWorkOrderForm" method="POST" action="{{ route('workorder-delete') }}">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <input type="hidden" name="work_order_id" id="workOrderDeleteId" required>
                    <p>Apakah Anda yakin ingin menghapus Work Order ini? Karena Job yang terdaftar akan terhapus juga!
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>



{{-- add job modal --}}

<div class="modal fade" id="jobModal" tabindex="-1" role="dialog" aria-labelledby="jobModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="createJob" method="POST" action="{{ route('job-add') }}">
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
                                            <input type="date" class="form-control" name="jobDate[]"
                                                placeholder="Tanggal Pekerjaan">
                                        </td>
                                        <td class="px-2">
                                            <input type="text" class="form-control" name="jobName[]"
                                                placeholder="Nama Pekerjaan">
                                        </td>
                                        <td class="px-2">
                                            <select class="form-control select2" name="work_order_id[]">
                                                @foreach ($workOrderData as $wo)
                                                    <option value="{{ $wo['id_work_order'] }}">
                                                        {{ $wo['work_order_code'] }}
                                                        - {{ $wo['work_order_name'] }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="px-2">
                                            <div class="d-flex">
                                                <input type="number" class="form-control" name="jobDuration[]"
                                                    placeholder="Durasi Pengerjaan">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-link text-primary" id="addMore">+ Tambah
                            Pekerjaan</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- update modal job --}}

<div class="modal fade" id="jobEditModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="updateJobForm" method="POST" action="{{ route('job-edit') }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Update Job</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="jobId" name="id_job">
                    <div class="mb-3">
                        <label for="JobDate" class="form-label">Tanggal Pekerjaan</label>
                        <input type="date" id="jobDate" name="job_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="workOrderCode" class="form-label">Kode Workorder</label>
                        <select class="form-control select2" name="work_order_id">
                            @foreach ($workOrderData as $wo)
                                <option value="{{ $wo['id_work_order'] }}">
                                    {{ $wo['work_order_code'] }}
                                    - {{ $wo['work_order_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jobName" class="form-label">Job Name</label>
                        <input type="text" id="jobName" name="job_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="jobDuration" class="form-label">Job Duration</label>
                        <input type="number" id="jobDuration" name="job_duration" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>




<!-- Modal Delete Job-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus pekerjaan ini?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST" action="{{ route('job.delete') }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="job_id" id="job_id" value="">
                    <!-- Input hidden untuk job_id -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>



@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('library/prismjs/prism.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#workOrderEditModal').on('show.bs.modal', function(event) {
                // Clear any existing values in the modal fields to avoid old data persisting
                var modal = $(this);
                modal.find('#workOrderId').val('');
                modal.find('#workOrderDuration').val('');
                modal.find('#workOrderCode').val('');
                modal.find('#workOrderName').val('');

                // Set up event listener for loading data when the modal is fully shown
                $('#workOrderEditModal').on('shown.bs.modal', function() {
                    var button = $(event.relatedTarget); // Button that triggered the modal
                    var workOrderId = button.data('workorder-id');
                    var workOrderDuration = button.data('workorder-duration');
                    var workOrderCode = button.data('workorder-code');
                    var workOrderName = button.data('workorder-name');

                    // Set values into the input fields within the modal
                    modal.find('#workOrderId').val(workOrderId);
                    modal.find('#workOrderDuration').val(workOrderDuration);
                    modal.find('#workOrderCode').val(workOrderCode);
                    modal.find('#workOrderName').val(workOrderName);
                });
            });

            // Remove data and event listeners when modal is hidden
            $('#workOrderEditModal').on('hidden.bs.modal', function() {
                $(this).off('shown.bs.modal');
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const deleteButtons = document.querySelectorAll("#buttonDelete");
            const workOrderDeleteIdInput = document.getElementById("workOrderDeleteId");

            deleteButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const workOrderId = this.getAttribute("data-workorder-id");
                    workOrderDeleteIdInput.value = workOrderId;
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jobsContainer = document.getElementById('jobsContainer');
            let jobCount = 1;

            function generateWorkOrderOptions() {
                let options = '';
                const workOrderData = @json($workOrderData);
                workOrderData.forEach(function(workorder) {
                    options +=
                        `<option value="${workorder.id_work_order}">${workorder.work_order_code}-${workorder.work_order_name}</option>`;
                });
                return options;
            }

            function updateJobTitles() {
                const jobSections = jobsContainer.querySelectorAll('.job-section');
                jobSections.forEach((section, index) => {
                    const jobTitle = section.querySelector('p');
                    jobTitle.textContent = `Pekerjaan ${index + 1}`;
                    const removeButton = section.querySelector('.remove-job');
                    removeButton.classList.toggle('d-none', index === 0);
                });
            }

            document.getElementById('addMore').addEventListener('click', function() {
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
                        <input type="date" class="form-control" name="jobDate[]" placeholder="Tanggal Pekerjaan">
                    </td>
                    <td class="px-2">
                        <input type="text" class="form-control" name="jobName[]" placeholder="Nama Pekerjaan">
                    </td>
                    <td class="px-2">
                        <div class="form-group">
                            <select class="form-control select2" name="work_order_id[]">
                            ${generateWorkOrderOptions()}
                            </select>
                        </div>
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

            jobsContainer.addEventListener('click', function(event) {
                if (event.target.closest('.remove-job')) {
                    event.target.closest('.job-section').remove();
                    jobCount--;
                    updateJobTitles();
                }
            });
            updateJobTitles();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ketika modal akan ditampilkan
            $('#jobEditModal').on('show.bs.modal', function(event) {
                var modal = $(this);

                // Clear any existing values in the modal fields
                modal.find('#jobDate').val('');
                modal.find('#jobId').val('');
                modal.find('#workOrderId').val('');
                modal.find('#jobName').val('');
                modal.find('#jobDuration').val('');
                modal.find('#workOrderCode').html(
                    '<option value="">Select Work Order</option>'); // Clear previous options

                // Ambil data yang dikirimkan pada tombol yang memicu modal
                var button = $(event.relatedTarget); // tombol yang memicu modal
                var jobDate = button.data('job-date');
                var jobId = button.data('job-id');
                var workOrderId = button.data('workorder-id');
                var jobName = button.data('job-name');
                var jobDuration = button.data('job-duration');

                // Set data ke dalam modal
                modal.find('#jobDate').val(jobDate);
                modal.find('#jobId').val(jobId);
                modal.find('#workOrderId').val(workOrderId);
                modal.find('#jobName').val(jobName);
                modal.find('#jobDuration').val(jobDuration);
            });
        });
    </script>


    <script>
        function showDeleteModal(id_job) {
            // Set id_job to the hidden input field for form submission
            document.getElementById('job_id').value = id_job;

            // Display the id_job in the modal
            document.getElementById('displayJobId').textContent = id_job;

            // Show the modal
            $('#deleteModal').modal('show');
        }
    </script>

    <script>
        $('#jobDate').datepicker({
            dateFormat: 'dd-mm-yy', // Format untuk menampilkan di input
        });
    </script>
@endpush
