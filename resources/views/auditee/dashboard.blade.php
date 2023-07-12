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


    $(document).ready(function () {
        @if (count($errors) > 0)
        $('#modalPendahuluan').modal('show');
        @endif
    });
</script>

<!-- Modal -->
{{-- <div class="modal fade" id="modalPendahuluan" tabindex="-1" aria-labelledby="modalPendahuluan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="modalPendahuluan">Isi data pendahuluan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/auditee/{{ auth()->id() }}/dataPendahuluan" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="kepala_prodi" class="col-sm-5 col-form-label">Kepala Prodi</label>
                        <div class="col-1"> :</div>
                        <div class="col-sm-6">
                            <input type="text" name="kepala_prodi" class="form-control @error('kepala_prodi') is-invalid @enderror" id="kepala_prodi">
                            @error('kepala_prodi')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-5 col-form-label">Nama Pengisi</label>
                        <div class="col-1"> :</div>
                        <div class="col-sm-6">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="dosen_aktif" class="col-sm-5 col-form-label">Jumlah Dosen Aktif</label>
                        <div class="col-1"> :</div>
                        <div class="col-sm-6">
                            <input type="number" name="dosen_aktif" class="form-control @error('dosen_aktif') is-invalid @enderror" id="dosen_aktif">
                            @error('dosen_aktif')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="mahasiswa_aktif" class="col-sm-5 col-form-label">Jumlah Mahasiswa Aktif</label>
                        <div class="col-1"> :</div>
                        <div class="col-sm-6">
                            <input type="number" name="mahasiswa_aktif" class="form-control @error('mahasiswa_aktif') is-invalid @enderror" id="mahasiswa_aktif">
                            @error('mahasiswa_aktif')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="total_penelitian" class="col-sm-5 col-form-label">Jumlah Penelitian Dosen</label>
                        <div class="col-1"> :</div>
                        <div class="col-sm-6">
                            <input type="number" name="total_penelitian" class="form-control @error('total_penelitian') is-invalid @enderror" id="total_penelitian">
                            @error('total_penelitian')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="total_pengabdian" class="col-sm-5 col-form-label">Jumlah Pengabdian Dosen</label>
                        <div class="col-1"> :</div>
                        <div class="col-sm-6">
                            <input type="number" name="total_pengabdian" class="form-control @error('total_pengabdian') is-invalid @enderror" id="total_pengabdian">
                            @error('total_pengabdian')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jumlah_kerjasama" class="col-sm-5 col-form-label">Jumlah Kerja Sama</label>
                        <div class="col-1"> :</div>
                        <div class="col-sm-6">
                            <input type="number" name="jumlah_kerjasama" class="form-control @error('jumlah_kerjasama') is-invalid @enderror" id="jumlah_kerjasama">
                            @error('jumlah_kerjasama')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div> --}}

<div class="modal fade" id="modal_unggah" tabindex="-1" aria-labelledby="modal_unggah" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="modal_unggah">Unggah File Auditee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/auditee/{{ auth()->id() }}/dataPendahuluan" method="post">
                @csrf
                <div class="modal-body">
                    <form action="" method="post" id="form_unggah">
                        <input type="hidden" id="id_ruang_lingkup" name="id_ruang_lingkup">
                        <table class="table table-responsive table-stripper">
                            <thead>
                                <tr>
                                    <th>Ruang Lingkup</th>
                                    <th>Parameter</th>
                                    <th>File Yang Diunggah Auditee</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Value Ruang Lingkup</td>
                                    <td>value parameter</td>
                                    <td>
                                    
                                        <input type="file" id="fileauditee"></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_penilaian" tabindex="-1" aria-labelledby="modal_penilaian" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="modal_penilaian">Penilaian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" name="form_unggah" id="form_unggah" method="post">
                @csrf
                <div class="modal-body">
                    <!-- <form action="" method="post" id="form_unggah"> -->
                        <!-- <input type="hidden" id="id_ruang_lingkup" name="id_ruang_lingkup"> -->
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
                        
                    </div>

            
            </div>
                    <!-- </form> -->
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <!-- <button type="submit" class="btn btn-primary">Simpan</button> -->
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_feedback" tabindex="-1" aria-labelledby="modal_feedback" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="modal_feedback">Feedback</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" name="form_unggah" id="form_unggah" method="post">
                @csrf
                <div class="modal-body">
                    <!-- <form action="" method="post" id="form_unggah"> -->
                        <!-- <input type="hidden" id="id_ruang_lingkup" name="id_ruang_lingkup"> -->
                       
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

                    <!-- </form> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{--container--}}
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-2 border-end">
            <div id="side-bar" class="ps-3 pt-3 bg-white overflow-auto" style="width: 180px;">
                <ul class="list-unstyled ps-0">
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                                data-bs-target="#home-collapse" aria-expanded="true">
                            Upload File
                        </button>
                        <div class="collapse show" id="home-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li class="fw-bold"><a href="{{route('auditee.dashboard')}}" class="link-dark rounded">Upload</a>
                                </li>
                                {{-- <li><a href="{{route('auditee.grade')}}" class="link-dark rounded">Lihat hasil</a>
                                </li> --}}
                            </ul>
                        </div>
                    </li>

                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                                data-bs-target="#account-collapse" aria-expanded="false">
                            Feedback
                        </button>
                        <div class="collapse show" id="account-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="{{ route('auditee.feedbackTemuan') }}" class="link-dark rounded">Feedback Temuan</a></li>
                                <li><a href="{{ route('auditee.feedbackTindakLanjut') }}" class="link-dark rounded">Tindak Lanjut Temuan</a></li>
                            </ul>
                        </div>
                    </li>

                    
                </ul>
            </div>
        </div>
        <div class="col">
            <h2 class="text-center">Sistem Audit Internal</h2>
            <hr>
            <div class="card mb-3 p-2">
                <div class="tab-pane fade show active" id="format_soal" role="tabpanel" aria-labelledby="format_soal-tab">
                    <div class="card-body">
                        <div class="table-container">
                            <!-- <table class="table" id="daftarSoal">
                                <thead class="bg-secondary text-white">
                                    <tr>
                                        <th>Upload Setup File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Parameter<br>
                                            <textarea rows="3" style="width:100%; resize:none;" name="parameter"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Upload File<br>
                                            <input type="file" name="setup_file" id="setup_file" required>
                                        </td>
                                    </tr>
                                </tbody>
                            </table> -->

                            <table id="table_standart" class="table table-striped text-center table-bordered">
                                <thead>
                                <tr class="border-bottom">
                                    <th scope="col">No</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Ruang Lingkup</th>
                                    <th scope="col">Aksi</th>
                                    <th scope="col">Penilaian</th>
                                    <th scope="col">Feedback</th>
                                </tr>
                                </thead> 
                                <tbody>
                                   
                                        <tr>
                                            <td>1</td>
                                            <td>Prodi IF</td>
                                            <td>Pembiatyaan</td>
                                            <td>
                                                <button class="btn btn-success" onclick="modal_unggah()">isi</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-success" onclick="modal_penilaian()">Lihat</button> | 
                                                <button class="btn btn-success">Cetak</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-success" onclick="modal_feedback()">isi</button>
                                            </td>
                                            <!-- <td class="text-center list-inline">
                                                <div class="d-inline-flex bd-highlight">
                                                <button class="btn btn-outline-success btn-sm">edit</button>
                                                <form id="form" class="delete-form" action="{{ route('ketua.destroymap') }}"
                                                    method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id_map" value="">
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="deleteFunction()">Hapus</button>
                                                </form>
                                                </div>
                                            </td> -->
                                        </tr>
                                    
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#kirimsetupfile">Submit</button> -->
            {{-- <div class="card mb-3 p-2">
                <div class="body">
                    <div class="d-flex flex-row bd-highlight">
                        <div class="p-2 bd-highlight">Data pendahuluan : </div>
                        <div class="p-2 bd-highlight">
                                @if($check->isEmpty())
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalPendahuluan">Isi data</button>
                                @else
                                    <span class="badge bg-success">
                                        Data Terisi
                                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" fill="currentColor" class="bi bi-check-lg ms-1 " viewBox="0 0 16 16">
                                            <path d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z"/>
                                        </svg>
                                    </span>
                                @endif
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="card p-3">
                <form action="/auditee/filter" method="post">
                    @csrf
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="p-2 bd-highlight">
                            <button type="submit" class="btn btn-sm btn-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-search mb-1" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </button>
                        </div>
                        <div class="p-2 bd-highlight">
                            <select class="form-select form-select-sm" name="filter" aria-label="Default select example">
                                <option selected> --Pilih Tahun-- </option>
                                @for ($year=2021; $year<=date('Y'); $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="p-2 bd-highlight">
                          Filter Tahun:
                        </div>
                    </div>
                </form>
                <table id="table_standart" class="table table-striped text-center table-bordered">
                    <thead>
                    <tr>
                        <th>Standart</th>
                        <th>Keterangan</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $standart as $v )
                            @if(!$v->responses->isEmpty())
                                <tr>
                                    <td>Standart {{ $loop->iteration }}</td>
                                    <td>{{ $v->name }}</td>
                                    <td>{{ $v->created_at->format('Y') }}</td>
                                    <td>
                                        <span class="badge bg-success">Terisi</span>
                                        <a href="/auditee/{{ $v->id }}/{{ $filter }}/grade"><span class="badge bg-primary">Cek Nilai</span></a>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td>Standart {{ $loop->iteration }}</td>
                                    <td>{{ $v->name }}</td>
                                    <td>{{ $v->created_at->format('Y') }}</td>
                                    <td style="width:15%" class="text-center">
                                        @if($check->isEmpty() || auth()->user()->fakultas == null || auth()->user()->prodi == null)
                                            <button class="btn btn-outline-success btn-sm" onclick="responseFunction()">Isi standart</button>
                                        @else
                                            <a href="/auditee/{{ $v->id }}/respons/"><button class="btn btn-outline-success btn-sm">Isi standart</button></a>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                    @endforeach
                    </tbody>
                </table>
            </div> --}}

        </div>
    </div>
    {{-- @if(auth()->user()->fakultas == null || auth()->user()->prodi == null)
        <div class="alert alert-warning alert-dismissible fade show mt-alerts mt-4" role="alert">
            <strong>Peringatan!</strong> Anda belum mengisi data profil yang diperlukan <a href="{{ route('auditee.profile') }}" class="alert-link">disini</a>.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @else
    @endif --}}
</div>

@include('layouts.footer')

<script>

    // function responseFunction() {
    //     event.preventDefault(); // prevent form submit

    //     Swal.fire({
    //         icon: 'error',
    //         title: 'Aksi Dilarang',
    //         text: 'Anda Belum mengisikan Data Pendahuluan / Data profil yang diperlukan',
    //     })

    // }

    $(document).ready(function () {
        $('#table_standart').DataTable();
    });

    function modal_unggah(){
        $("#modal_unggah").modal("show")
    }

    function modal_penilaian(){
        $("#modal_penilaian").modal("show")
    }

    function modal_feedback(){
        $("#modal_feedback").modal("show")
    }
</script>

@include('layouts.global-script')
</body>

</html>
