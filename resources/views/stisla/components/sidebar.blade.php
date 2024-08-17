{{-- untuk mengambil session role id dari AuthController --}}


{{-- pengecekan untuk pembagian view sidebar --}}

{{-- tampilan sidebar berdasarkan role id 1 (Admin) --}}
@php
$role_id = 1;
@endphp
@if ($role_id == 1)
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="#">Maintenance Harkan</a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">MENU</li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('dashboard-admin')}}"><i
                            class="fas fa-home"></i><span>Dashboard</span>
                    </a>
{{--                        <a class="nav-link" href="{{ route('change-role') }}"><i--}}
{{--                                class="fas fa-user"></i><span>Ubah Role</span></a>--}}
{{--                        <a class="nav-link" href="{{ route('pt-list') }}"><i--}}
{{--                                class="fas fa-building"></i><span>PT List</span></a>--}}
{{--                        <a class="nav-link" href="{{ route('proyek-list') }}"><i--}}
{{--                                class="fas fa-ship"></i><span>Proyek List</span></a>--}}
{{--                        <a class="nav-link" href="{{ route('bengkel-list') }}"><i--}}
{{--                                class="fas fa-wrench"></i><span>Bengkel List</span></a>--}}
{{--                        <a class="nav-link" href="{{ route('departemen-list') }}"><i--}}
{{--                                class="fas fa-black-tie"></i><span>Departemen List</span></a>--}}
{{--                        <a class="nav-link" href="{{ route('list-spkl-admin') }}"><i--}}
{{--                                class="fas fa-archive"></i><span>Rekap-SPKL</span></a>--}}

                <li class="nav-item">
                    <a class="nav-link" href="{{route('asset')}}"><i
                            class="fas fa-book"></i><span>Asset</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('timesheet')}}"><i
                            class="fas fa-calculator"></i><span>Timesheet</span>
                    </a>
                </li>
            </ul>
        </aside>
    </div>
@endif



