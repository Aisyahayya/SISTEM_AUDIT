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

<!-- Modal -->


<div class="modal fade" id="modal_unggah" tabindex="-1" aria-labelledby="modal_unggah" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="modal_unggah">Unggah File Auditee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/uploadFile" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!-- <form action="" method="post" id="form_unggah"> -->
                        <input type="hidden" id="id_ruang_lingkup_unggah" name="id_ruang_lingkup">
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
                                    <td id="r_lingkup">Value Ruang Lingkup</td>
                                    <td id="param_lingkup">value parameter</td>
                                    <td>
                                        <input type="file" id="fileauditee" name='fileauditee'>
                                        <a id="linkfile" href="https://www.WordPress.com" target="_blank">WordPress Homepage</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
                            <textarea name="kondisi_awal" class="form-control @error('kondisi_awal') is-invalid @enderror" aria-describedby="kondisi_awal" id="kondisi_awal" rows="3" disabled  >{{ $evaluasi->kondisi_awal ?? ''}}</textarea>
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
                            <textarea name="dasar_evaluasi" class="form-control @error('dasar_evaluasi') is-invalid @enderror" aria-describedby="dasar_evaluasi" id="dasar_evaluasi" rows="3" disabled >{{ $evaluasi->dasar_evaluasi ?? ''}}</textarea>
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
                            <textarea name="penyebab" class="form-control @error('penyebab') is-invalid @enderror" aria-describedby="penyebab" id="penyebab" rows="3" disabled >{{  $evaluasi->penyebab ?? ''}}</textarea>
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
                            <textarea name="akibat" class="form-control @error('akibat') is-invalid @enderror" aria-describedby="akibat" id="akibat" rows="3" disabled>{{  $evaluasi->akibat ?? ''}}</textarea>
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
                            <textarea name="rekomendasi_followup" class="form-control @error('rekomendasi_followup') is-invalid @enderror" aria-describedby="rekomendasi_followup" id="rekomendasi_followup" rows="3" disabled >{{ $evaluasi->rekomendasi_followup ?? '' }}</textarea>
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
            <form action="/savefeedback" name="form_unggah" id="form_unggah" method="post">
                @csrf
                <div class="modal-body">
                    <!-- <form action="" method="post" id="form_unggah"> -->
                        <input type="hidden" id="id_ruang_lingkup_feedback" name="standar_ruang_lingkup_id">
                        
                        <div class="form-group row mb-3">
                        <label for="komentar" class="col-md-0 col-form-label text-md-right">Komentar/Klarifikasi : </label>

                        <div class="col-12">
                            <textarea name="komentar" class="form-control @error('komentar') is-invalid @enderror" aria-describedby="komentar" id="komentar" rows="3"  >{{ $evaluasi->komentar ?? ''}}</textarea>
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
                            <textarea name="tindak_lanjut" class="form-control @error('tindak_lanjut') is-invalid @enderror" aria-describedby="tindak_lanjut" id="tindak_lanjut" rows="3" >{{ $evaluasi->tindak_lanjut ?? ''}}</textarea>
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
                            <input type="date" name="tanggal_kesanggupan" class="form-control @error('tanggal_kesanggupan') is-invalid @enderror" aria-describedby="tanggal_kesanggupan" id="tanggal_kesanggupan" rows="3" >{{  $evaluasi->tanggal_kesanggupan ?? ''}}</textarea>
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
                    <button id="submit_feedback" type="submit" class="btn btn-primary">Simpan</button>
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
                            Menu
                        </button>
                        <div class="collapse show" id="home-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li class="fw-bold"><a href="{{route('auditee.dashboard')}}" class="link-dark rounded">Dashboard</a>
                                </li>
                                {{-- <li><a href="{{route('auditee.grade')}}" class="link-dark rounded">Lihat hasil</a>
                                </li> --}}
                            </ul>
                        </div>
                    </li>

                    {{--<li class="mb-1">
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
                    </li> --}}

                    
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
                                        @foreach($table as $row)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$row->nama_unit}}</td>
                                                <td>{{$row->ruang_lingkup}}</td>
                                                <td>
                                                    @if($row->file_auditee == null)
                                                        <button class="btn btn-success" onclick="modal_unggah(`{{$row->id}}`, `{{$row->ruang_lingkup}}`, `{{$row->parameter_ruang_lingkup}}`)">isi</button>
                                                    @else
                                                    <button class="btn btn-primary" onclick="modal_unggah(`{{$row->id}}`, `{{$row->ruang_lingkup}}`, `{{$row->parameter_ruang_lingkup}}`, `{{$row->file_auditee}}`)">Lihat</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-success" onclick="modal_penilaian({{$row->id}})">Lihat</button> | 
                                                    <button class="btn btn-success">Cetak</button>
                                                </td>
                                                <td>
                                                    @if($row->id_standard == null)
                                                        <button class="btn btn-success" onclick="modal_feedback({{$row->id}}, {{$row->id_standard}})">isi</button>
                                                    @else
                                                        <button class="btn btn-primary" onclick="modal_feedback({{$row->id}}, {{$row->id_standard}})">Lihat</button>
                                                    @endif
                                                </td>
                                            
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#kirimsetupfile">Submit</button> -->
           
        </div>
    </div>
</div>

@include('layouts.footer')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
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

    function modal_unggah(id, ruang_lingkup, parameter_ruang_lingkup, isFile){
        
        $('#id_ruang_lingkup_unggah').val(id);
        $("#r_lingkup").html(ruang_lingkup);
        $("#param_lingkup").html(parameter_ruang_lingkup);

        if(isFile != null || isFile != undefined){
            // sudah
            $("#linkfile").attr("href", '{{ URL::to('/') }}/file/'+isFile)
            $("#linkfile").html(isFile)
            $("#linkfile").show()
            $("#fileauditee").hide()
        }else{
            $("#fileauditee").show()
            $("#linkfile").hide()
            //belum upload
        }

        $("#modal_unggah").modal("show")
    }

    function modal_penilaian($id_standard){
        
        // console.log($id_standard);
        $.ajax({
                type:'POST',
                url:'/loadevaluasi',
                data:{
                    id: $id_standard
                
                },
                success:function(data) {
                    // $("#msg").html(data.msg);
                    // console.log(data)
                    let result = data[0];

                    $('#kondisi_awal').val(result['kondisi_awal']);
                    $('#dasar_evaluasi').val(result['dasar_evaluasi']);
                    $('#penyebab').val(result['penyebab']);
                    $('#akibat').val(result['akibat']);
                    $('#rekomendasi_followup').val(result['rekomendasi_followup']);
                    $("#modal_penilaian").modal("show");
                }
            }
        );
    }

    function modal_feedback($id_standard, $stat){
        // console.log($id_standard)
        // id_ruang_lingkup_feedback
        

        if($stat){
            console.log("ada gans")
            $.ajax({
                type:'POST',
                url:'/loadfeedback',
                data:{
                    id: $id_standard
                
                },
                success:function(data) {
                    // $("#msg").html(data.msg);
                    // console.log(data)
                    let result = data[0];

                    $('#komentar').val(result['komentar']);
                    $('#tindak_lanjut').val(result['tindak_lanjut']);
                    $('#tanggal_kesanggupan').val(result['tanggal_kesanggupan']);

                    $('#komentar').prop("disabled", "disabled")
                    $('#tindak_lanjut').prop("disabled", "disabled")
                    $('#tanggal_kesanggupan').prop("disabled", "disabled")
                    
                    $("#submit_feedback").hide();
                    $("#modal_feedback").modal("show")
                }
            });
        }else{
            $("#id_ruang_lingkup_feedback").val($id_standard);
            $('#komentar').prop("disabled", false)
            $('#tindak_lanjut').prop("disabled", false)
            $('#tanggal_kesanggupan').prop("disabled", false)
            $("#submit_feedback").show();
            $("#modal_feedback").modal("show")
        }
        
        
    }
</script>

@include('layouts.global-script')
</body>

</html>
