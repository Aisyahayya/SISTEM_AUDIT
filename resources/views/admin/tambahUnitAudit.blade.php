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
            @include('layouts.sidebar',['activePage' => 'unitAudit'])
        </div> 
        <div class="col-10 border-start">
{{--            CONTENT--}}
            <div class="container-fluid">
                <h1 class="fw-bold mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                    </svg>
                    TAMBAH UNIT </h1>
                <hr>
                <div class="card mt-4 mb-3">
                    <div class="card-body">
                        <form method="POST" action="{{ route('tambahUnitAudit') }}">
                            @csrf
                            <div class="form-group row mt-3 mb-3">
                                <label for="nama_unit" class="col-md-4 col-form-label text-md-right">{{ __('Nama Unit') }}</label>

                                <div class="col-md-6">
                                    <input id="nama_unit" type="text" class="form-control  @error('nama_unit') is-invalid @enderror" name="nama_unit" value="{{ old('nama_unit') }}" required autocomplete="nama_unit" autofocus>

                                    @error('nama_unit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-3 mb-3">
                                <label for="tanggal_audit" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Audit') }}</label>

                                <div class="col-md-6">
                                    <input id="tanggal_audit" type="text" class="form-control  @error('tanggal_audit') is-invalid @enderror" name="tanggal_audit" value="{{ old('tanggal_audit') }}" required autocomplete="tanggal_audit" autofocus>

                                    @error('tanggal_audit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-3 mb-3">
                                <label for="no_sk" class="col-md-4 col-form-label text-md-right">{{ __('No SK') }}</label>

                                <div class="col-md-6">
                                    <input id="no_sk" type="no_sk" class="form-control @error('no_sk') is-invalid @enderror" name="no_sk" value="{{ old('no_sk') }}" required autocomplete="no_sk" autofocus>

                                    @error('no_sk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-3 mb-3">
                                <label for="ketua_unit" class="col-md-4 col-form-label text-md-right">{{ __('Ketua Unit') }}</label>

                                <div class="col-md-6">
                                    <input id="ketua_unit" type="ketua_unit" class="form-control @error('ketua_unit') is-invalid @enderror" name="ketua_unit" value="{{ old('ketua_unit') }}" required autocomplete="ketua_unit" autofocus>

                                    @error('ketua_unit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-3 mb-3">
                                <label for="nip_ketua_unit" class="col-md-4 col-form-label text-md-right">{{ __('NIP Ketua Unit') }}</label>

                                <div class="col-md-6">
                                    <input id="nip_ketua_unit" type="nip_ketua_unit" class="form-control @error('nip_ketua_unit') is-invalid @enderror" name="nip_ketua_unit" value="{{ old('nip_ketua_unit') }}" required autocomplete="nip_ketua_unit" autofocus>

                                    @error('nip_ketua_unit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
