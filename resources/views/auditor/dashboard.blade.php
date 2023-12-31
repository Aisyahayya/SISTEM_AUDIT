<!doctype html>
<html lang="en">
@include('layouts.head')

<body id="body-admins">
@include('layouts.navbar')

@if ($message = Session::get('success'))
    <script>
        $(document).ready(function () {
            Swal.fire({
                icon: 'success',
                title: '{{$message}}',
                timer: 1500,
            })
        });

    </script>

@elseif ($message = Session::get('error'))
    <script>
        $(document).ready(function () {
            Swal.fire({
                icon: 'error',
                title: '{{$message}}',
                timer: 1500,
            })
        });
    </script>
@endif

<script>
    $(document).ready(function () {
        $('[data-bs-toggle="popover"]').tooltip();
    });

    function deleteFunction() {
        event.preventDefault(); // prevent form submit
        var form = event.target.form; // storing the form

        swal.fire({
            icon: "warning",
            title: "Hapus Data?",
            text: "Data yang telah terhapus tidak dapat dikembalikan",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Hapus data",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();

            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swal.fire(
                    'Dibatalkan',
                    'Hapus data dibatalkan, data tidak terhapus.',
                    'error'
                )
            }
        })

        // function(isConfirm){
        //     if (isConfirm) {
        //         form.submit();          // submitting the form when user press yes
        //     } else {
        //         Swal.fire(
        //             'The Internet?',
        //             'That thing is still around?',
        //             'question'
        //         );
        //     }
        // });
    }
</script>

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-2 border-end">
            <div id="side-bar" class="ps-3 pt-3 bg-white overflow-auto" style="width: 180px;">
                <ul class="list-unstyled ps-0">
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                                data-bs-target="#home-collapse" aria-expanded="true">
                            <span>Home</span>
                        </button>
                        <div class="collapse show" id="home-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li class="fw-bold"><a href="{{route('auditor.dashboard')}}" class="link-dark rounded">Beranda</a>
                                </li>
                            </ul>
                        </div>
                    </li>

{{--                    <li class="mb-1">--}}
{{--                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"--}}
{{--                                data-bs-target="#account-collapse" aria-expanded="false">--}}
{{--                            <span>Penilaian</span>--}}
{{--                        </button>--}}
{{--                        <div class="collapse" id="account-collapse">--}}
{{--                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">--}}
{{--                                <li><a href="#" class="link-dark rounded">Penilaian</a></li>--}}
{{--                                <li><a href="#" class="link-dark rounded">Penilaian</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{-- 
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                                data-bs-target="#profile-collapse" aria-expanded="false">
                            <span>Evaluasi</span>
                        </button>
                        <div class="collapse" id="profile-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="{{ route('auditor.tindakan') }}" class="link-dark rounded">Evaluasi</a></li>
                            </ul>
                        </div>
                    </li> --}}

                  
                </ul>
            </div>
        </div>
        
        <div class="col">
            <a href="{{route('pageTambahStandarRuangLingkup')}}">
                <button type="button" class="btn btn-outline-secondary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                         class="bi bi-person-plus-fill" viewBox="0 1 16 16">
                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        <path fill-rule="evenodd"
                              d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                    </svg>
                    <span>Tambah Standar Ruang Lingkup</span>
                </button>
            </a>
            <hr>
            <div class="card p-3">
                <table id="table_standart" class="table table-striped text-center table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Unit</th>
                        <th>Auditee</th>
                        <th>Ruang Lingkup</th>
                        <th>Parameter Ruang Lingkup</th>
                        <th>Status</th>
                        <th>Aksi</th>
                        <th>Feedback</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($standarRuangLingkup as $d)
                        {{-- @foreach($auditee as $a)
                        @foreach($unit as $u) --}}
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->unit}}</td>
                            {{-- <td>{{ $d->unit === $u->id ? $u->nama : ''}}</td> --}}
                            {{-- <td>{{ $d->id_auditee === $auditee->id ? $auditee->name : ''}}</td> --}}
                            <td>{{ $d->id_auditee }}</td>
                            <td>{{ $d->ruang_lingkup }}</td>
                            <td>{{ $d->parameter_ruang_lingkup }}</td>
                            <td>{{ $d->status }}</td>
                            {{-- AKSI --}}
                            <td class="text-center">
                                <a href={{route('detailStandarRuangLingkup',$d->id)}}>
                                    <button class="btn btn-outline-success btn-sm" data-bs-toggle="popover" title="Lihat Detail & Evaluasi">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                        </svg>
                                        Lihat
                                    </button></a>

                                    @if ($d->status == "Sudah Diaudit")
                                    <a href="/">
                                        <button class="btn btn-info btn-sm" data-bs-toggle="popover" title="Cetak PDF">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                            </svg>
                                            Cetak
                                        </button></a>
                                    @endif
                            </td>
                            {{-- FEEDBACK --}}
                            <td class="text-center">
                                <a href={{route('feedback',$d->id)}}><button class="btn btn-outline-success btn-sm" data-bs-toggle="popover" title="Lihat Feedback Auditee">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                        </svg>
                                        Lihat
                                    </button></a>
                            </td>
                        </tr>
                        {{-- @endforeach
                        @endforeach --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')

<script>
    $(document).ready(function () {
        $('[data-bs-toggle="popover"]').tooltip();
    });

    $(document).ready( function () {
        $('#table_standart').DataTable(
            { language: {
                    searchPlaceholder: "Cari",
                    search: "",
                }
            })
    } );

</script>

@include('layouts.global-script')
</body>

</html>