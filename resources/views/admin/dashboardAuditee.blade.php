<!doctype html>
<html lang="en">
@include('layouts.head')

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

    function resetFunction() {
        event.preventDefault(); // prevent form submit
        var form = event.target.form; // storing the form

        swal.fire({
            icon: "info",
            title: "Reset Password?",
            text: "Apakah anda yakin untuk reset password user ini?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Reset Sekarang",
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
                    'Reset password dibatalkan.',
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

<body id="body-admins">
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col">
            @include('layouts.sidebar',['activePage' => 'auditee'])
        </div>
        <div class="col-10 border-start">
            <div class="container-fluid">
                <h1 class="fw-bold mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                         class="bi bi-card-list" viewBox="0 1 16 16">
                        <path
                            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                        <path
                            d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                    </svg>
                    DAFTAR AUDITEE
                </h1>
                <hr>
                <a href="{{route('pageTambahAuditee')}}">
                    <button type="button" class="btn btn-outline-secondary btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                             class="bi bi-person-plus-fill" viewBox="0 1 16 16">
                            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            <path fill-rule="evenodd"
                                  d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                        <span>Tambah Auditee</span>
                    </button>
                </a>
                <div class="card mt-2 mb-5" id="card-tambah-auditee">
                    <div class="card-body">
                        <table id="table_auditee" class="table table-striped text-center">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Fakultas</th>
                                <th>Prodi</th>
                                <th>email</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $userAuditee as $v)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$v->name}}</td>
                                    <td>{{$v->fakultas}}</td>
                                    <td>{{$v->prodi}}</td>
                                    <td>{{$v->email}}</td>
                                    <td style="width:25%" class="text-center list-inline">
                                        <div class="d-inline-flex bd-highlight">
                                        <form id="form" class="delete-form" action="{{ route('destroyUser',$v->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="deleteFunction()">Hapus</button>
                                        </form>
                                        <form action="/reset/{{ $v->id }}/user" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary ms-1 btn-sm" onclick="resetFunction()">Reset Password</button>
                                        </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')


@include('layouts.global-script')
</body>

</html>
