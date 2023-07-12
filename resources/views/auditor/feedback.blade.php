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
                </ul>
            </div>
        </div>
        
        <div class="col">
            <h2 class="text-center">Feedback</h2>
            <hr>
            <div class="card p-3">
                {{-- <form method="POST" action={{ route('updateEvaluasi', ['id' => $evaluasi->id]) }}> --}}
                <form method="POST" action={{ route('tambahEvaluasi') }}>
                    @csrf
                    {{-- @method('PUT') --}}
                {{-- <form method="{{ $evaluasi->id ?? '' === '' ? 'POST' : 'PUT' }}" action="{{ $evaluasi->id ?? '' === '' ? route('tambahEvaluasi') : route('updateEvaluasi') }}">
                    @csrf --}}
                    {{-- <form method={{ $evaluasi->kondisi_awal ?? '' === '' ? "POST" : "PUT"  }} action={{ $evaluasi->kondisi_awal ?? '' === '' ? route('tambahEvaluasi') : route('updateEvaluasi', ['id' => $evaluasi->kondisi_awal]) }}>
                        @csrf
                        @if ($evaluasi->id)
                            @method('PUT')
                        @endif --}}
                    <div class="form-group row mb-3">
                        <label for="komentar" class="col-md-0 col-form-label text-md-right">Komentar/Klarifikasi : </label>

                        <div class="col-12">
                            <textarea name="komentar" class="form-control @error('komentar') is-invalid @enderror" aria-describedby="komentar" id="komentar" rows="3"  disabled>{{ $evaluasi->komentar ?? ''}}</textarea>
                            @error('komentar')
                                <div id="komentar" class="invalid-feedback">
                                    Deskripsi wajib diisi
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="tindak_lanjut" class="col-md-0 col-form-label text-md-right">Tindak Lanjut Temuan :</label>

                        <div class="col-12">
                            <textarea name="tindak_lanjut" class="form-control @error('tindak_lanjut') is-invalid @enderror" aria-describedby="tindak_lanjut" id="tindak_lanjut" rows="3" disabled>{{ $evaluasi->tindak_lanjut ?? ''}}</textarea>
                            @error('tindak_lanjut')
                                <div id="tindak_lanjut" class="invalid-feedback">
                                    Deskripsi wajib diisi
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="tanggal_kesanggupan" class="col-md-0 col-form-label text-md-right">Tanggal Kesanggupan : </label>

                        <div class="col-12">
                            <input type="date" name="tanggal_kesanggupan" class="form-control @error('tanggal_kesanggupan') is-invalid @enderror" aria-describedby="tanggal_kesanggupan" id="tanggal_kesanggupan" rows="3" disabled>{{  $evaluasi->tanggal_kesanggupan ?? ''}}</textarea>
                            @error('tanggal_kesanggupan')
                                <div id="tanggal_kesanggupan" class="invalid-feedback">
                                    Deskripsi wajib diisi
                                </div>
                            @enderror
                        </div>
                    </div>
            </div>
            <div class="row pt-3 mb-4">
                        {{-- <div class="col-auto pe-0">
                            <button type="submit" class="btn btn-success">{{ $evaluasi->kondisi_awal ?? '' === '' ? "Tambah" : "Simpan" }}</button>
                        </div> --}}
                        <div class="col-auto">
                            <a href="{{ url()->previous() }}">
                                <button type="button" class="btn btn-secondary"> {{ __('Kembali') }}</button>
                            </a>
                        </div>
                    </div> 
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
