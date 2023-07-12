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
                        <form method="POST" action="{{ route('tambahUnit') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mt-3 mb-3">
                                <label for="id_periode_audit" class="col-md-4 col-form-label text-md-right">{{ __('ID Periode Audit') }}</label>

                                <div class="col-md-6">
                                    {{-- <input id="id_periode_audit" type="text" class="form-control" name="id_periode_audit" autofocus required> --}}
                                    <select id="id_periode_audit" class="form-control @error('id_periode_audit') is-invalid @enderror" name="id_periode_audit" required autocomplete="new-periodeAudit">
                                        @foreach($periodeAudit as $periodeAudit)
                                            <option value="{{ $periodeAudit->id }}">{{ $periodeAudit->tanggal_awal_audit }} - {{ $periodeAudit->tanggal_akhir_audit }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- <div class="form-group row mt-3 mb-3">
                                <label for="id_standar_ruang_lingkup" class="col-md-4 col-form-label text-md-right">{{ __('Standar Ruang Lingkup') }}</label>

                                <div class="col-md-6">
                                    <input id="id_standar_ruang_lingkup" type="text" class="form-control" name="id_standar_ruang_lingkup" autofocus required>
                                </div>
                            </div> --}}

                            <div class="form-group row mt-3 mb-3">
                                <label for="nama_unit" class="col-md-4 col-form-label text-md-right">{{ __('Nama Unit') }}</label>

                                <div class="col-md-6">
                                    <input id="nama_unit" type="text" class="form-control" name="nama_unit" autofocus required>
                                </div>
                            </div>

                            <div class="form-group row mt-3 mb-3">
                                <label for="tanggal_audit" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Audit') }}</label>

                                <div class="col-md-6">
                                    <input type="date" class="form-control" name="tanggal_audit" autofocus required>
                                </div>
                            </div>

                            <div class="form-group row mt-3 mb-3">
                                <label for="ketua_tim" class="col-md-4 col-form-label text-md-right">{{ __('Ketua Tim') }}</label>

                                <div class="col-md-6">
                                    <input id="ketua_tim" type="text" class="form-control" name="ketua_tim" required autofocus>
                                    {{--<select id="ketua_tim" class="form-control @error('ketua_tim') is-invalid @enderror" name="ketua_tim" required autocomplete="new-selectKetua">
                                        @foreach($selectKetua as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}  </option>
                                        @endforeach
                                    </select>--}}
                                </div>
                            </div>

                            <div class="form-group row mt-3 mb-3">
                                <label for="nip_ketua_tim" class="col-md-4 col-form-label text-md-right">{{ __('NIP Ketua TIM') }}</label>

                                <div class="col-md-6">
                                    <input id="nip_ketua_tim" type="text" class="form-control" name="nip_ketua_tim" required autofocus>
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
