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
            <hr>
            <div class="card p-3">
                <table id="table_standart" class="table table-striped text-center table-bordered">
                    <thead>
                    <tr>
                        <th>Ruang Lingkup</th>
                        <th>Parameter Ruang Lingkup</th>
                        <th>File Diunggah Auditee</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $standarRuangLingkup->ruang_lingkup }}</td>
                            <td>{{ $standarRuangLingkup->parameter_ruang_lingkup }}</td>
                            <td>{{ $standarRuangLingkup->status || ''}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <h2 class="text-center">Hasil Evaluasi</h2>
            <hr>
            <div class="card p-3">
                <form method="POST" action={{ route('updateEvaluasi', ['id' => $evaluasi->id]) }}>
                    @csrf
                    @method('PUT')
                {{-- <form method="{{ $evaluasi->id ?? '' === '' ? 'POST' : 'PUT' }}" action="{{ $evaluasi->id ?? '' === '' ? route('tambahEvaluasi') : route('updateEvaluasi') }}">
                    @csrf --}}
                    {{-- <form method={{ $evaluasi->kondisi_awal ?? '' === '' ? "POST" : "PUT"  }} action={{ $evaluasi->kondisi_awal ?? '' === '' ? route('tambahEvaluasi') : route('updateEvaluasi', ['id' => $evaluasi->kondisi_awal]) }}>
                        @csrf
                        @if ($evaluasi->id)
                            @method('PUT')
                        @endif --}}
                    <div class="form-group row mb-3">
                        <label for="kondisi_awal" class="col-md-0 col-form-label text-md-right">Kondisi Awal : </label>

                        <div class="col-12">
                            <textarea name="kondisi_awal" class="form-control @error('kondisi_awal') is-invalid @enderror" aria-describedby="kondisi_awal" id="kondisi_awal" rows="3"  >{{ $evaluasi->kondisi_awal ?? ''}}</textarea>
                            @error('kondisi_awal')
                                <div id="kondisi_awal" class="invalid-feedback">
                                    Deskripsi wajib diisi
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="dasar_evaluasi" class="col-md-0 col-form-label text-md-right">Dasar Evaluasi :</label>

                        <div class="col-12">
                            <textarea name="dasar_evaluasi" class="form-control @error('dasar_evaluasi') is-invalid @enderror" aria-describedby="dasar_evaluasi" id="dasar_evaluasi" rows="3" >{{ $evaluasi->dasar_evaluasi ?? ''}}</textarea>
                            @error('dasar_evaluasi')
                                <div id="dasar_evaluasi" class="invalid-feedback">
                                    Deskripsi wajib diisi
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="penyebab" class="col-md-0 col-form-label text-md-right">Penyebab : </label>

                        <div class="col-12">
                            <textarea name="penyebab" class="form-control @error('penyebab') is-invalid @enderror" aria-describedby="penyebab" id="penyebab" rows="3" >{{  $evaluasi->penyebab ?? ''}}</textarea>
                            @error('penyebab')
                                <div id="penyebab" class="invalid-feedback">
                                    Deskripsi wajib diisi
                                </div>
                            @enderror
                        </div>
                    </div>

 

                    <div class="form-group row mb-3">
                        <label for="akibat" class="col-md-0 col-form-label text-md-right">Akibat : </label>

                        <div class="col-12">
                            <textarea name="akibat" class="form-control @error('akibat') is-invalid @enderror" aria-describedby="akibat" id="akibat" rows="3">{{  $evaluasi->akibat ?? ''}}</textarea>
                            @error('akibat')
                                <div id="akibat" class="invalid-feedback">
                                    Deskripsi wajib diisi
                                </div>
                            @enderror
                        </div>
                    </div>



                    <div class="form-group row mb-3">
                        <label for="rekomendasi_followup" class="col-md-0 col-form-label text-md-right">Rekomendasi Follow-Up : </label>

                        <div class="col-12">
                            <textarea name="rekomendasi_followup" class="form-control @error('rekomendasi_followup') is-invalid @enderror" aria-describedby="rekomendasi_followup" id="rekomendasi_followup" rows="3" >{{ $evaluasi->rekomendasi_followup ?? '' }}</textarea>
                            @error('rekomendasi_followup')
                                <div id="rekomendasi_followup" class="invalid-feedback">
                                    Deskripsi wajib diisi
                                </div>
                            @enderror
                        </div>
                        <input type="hidden" name="standar_ruang_lingkup_id" value={{ $standarRuangLingkup->id }} id="standar_ruang_lingkup_id" />
                    </div>

            
            </div>
            <div class="row pt-3 mb-4">
                        <div class="col-auto pe-0">
                            <button type="submit" class="btn btn-success">{{ $evaluasi->kondisi_awal ?? '' === '' ? "Tambah" : "Simpan" }}</button>
                        </div>
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
