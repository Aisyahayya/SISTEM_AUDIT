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

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col">
            @include('layouts.sidebar',['activePage' => 'periodeAudit'])
        </div> 
        <div class="col-10 border-start">
{{--            CONTENT--}}
            <div class="container-fluid">
                <h1 class="fw-bold mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                    </svg>
                    TAMBAH PERIODE </h1>
                <hr>
                <div class="card mt-4 mb-3">
                    <div class="card-body">
                        <form method="POST" action="{{ route('tambahPeriodeAudit') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mt-3 mb-3">
                                <label for="tanggal_awal_audit" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Awal Audit') }}</label>

                                <div class="col-md-6">
                                    <input type="date" class="form-control" name="tanggal_awal_audit" autofocus required>
                                </div>
                            </div>

                            <div class="form-group row mt-3 mb-3">
                                <label for="tanggal_akhir_audit" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Akhir Audit') }}</label>

                                <div class="col-md-6">
                                    <input type="date" class="form-control" name="tanggal_akhir_audit" autofocus required>
                                </div>
                            </div>

                            <div class="form-group row mt-3 mb-3">
                                <label for="no_sk_tugas_audit" class="col-md-4 col-form-label text-md-right">{{ __('Nomor SK Tugas Audit') }}</label>

                                <div class="col-md-6">
                                    <input id="no_sk_tugas_audit" type="text" class="form-control" name="no_sk_tugas_audit" autofocus required>
                                </div>
                            </div>

                            <div class="form-group row mt-3 mb-3">
                                <label for="file_sk" class="col-md-4 col-form-label text-md-right">{{ __('File SK') }}</label>

                                <div class="col-md-6">
                                    <input type="file" class="form-control" name="file_sk" autofocus required>
                                </div>
                            </div>

                            <div class="form-group row mt-3 mb-3">
                                <label for="tanggal_sk" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal SK') }}</label>

                                <div class="col-md-6">
                                    <input type="date" class="form-control" name="tanggal_sk" autofocus required>
                                </div>
                            </div>

                            <div class="form-group row mt-3 mb-3">
                                <label for="ketua_spi" class="col-md-4 col-form-label text-md-right">{{ __('Ketua SPI') }}</label>

                                <div class="col-md-6">
                                    <input id="ketua_spi" type="text" class="form-control" name="ketua_spi" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row mt-3 mb-3">
                                <label for="nip_ketua_spi" class="col-md-4 col-form-label text-md-right">{{ __('NIP Ketua SPI') }}</label>

                                <div class="col-md-6">
                                    <input id="nip_ketua_spi" type="text" class="form-control" name="nip_ketua_spi" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                    <a href="{{ url()->previous() }}">
                                        <button type="button" class="btn btn-secondary"> {{ __('Batal') }}</button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@include('layouts.footer')

    <script>
        $(function(){
            $("#opt-keterangan").on("change",function(){
                var levelClass = $('#opt-keterangan').find('option:selected').attr('class');
                console.log(levelClass);
                
            });
        });

        $(document).ready(function() {
            $(".keterangan").select2({
                theme: "bootstrap-5",
                placeholder: "",
            });
        });
    </script>


@include('layouts.global-script')
</body>

</html>
