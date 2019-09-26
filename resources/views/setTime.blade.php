@extends('layouts.app')

@section('content')
    <div class="container areaAdmin ">
        <div class="row justify-content-center">
            <div class="col-md-3"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="text-align: center">الاعدادات</div>
                    <br>
                    <div class="card-body  ">
                        <form method="POST" action="{{ route('submitTime') }}" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group row ">
                                <div class="col-md-6">
                                    <input id="time" type="datetime-local"
                                           class="form-control @error('time') is-invalid @enderror"
                                           name="time"
                                          >

                                    @error('time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <label for="time" class="col-md-4 col-form-label text-md-right ">الوقت الحالي </label>

                            </div>

                            <div class="form-group row ">

                                <div class="col-md-6">
                                    <input id="higri" type="number"
                                           class="form-control @error('higri') is-invalid @enderror" name="higri"
                                           value="{{ old('higri')?old('higri'):isset($config)?$config->higri:0 }}"
                                           required autofocus>
                                    @error('higri')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <label for="longTime" class="col-md-4 col-form-label text-md-right ">معامل الزيادة او النقصان للتاريخ الهجري
                                    </label>

                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        اعتماد
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

    </script>
@endsection
