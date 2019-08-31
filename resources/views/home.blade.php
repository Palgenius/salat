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
                        <form method="POST" action="{{ route('submit') }}">
                            @csrf

                            <div class="form-group row ">

                                <div class="col-md-6">
                                    <input id="tz" type="text"
                                           class="form-control @error('tz') is-invalid @enderror"
                                           name="tz"
                                           value="{{ old('tz')?old('tz'):($config)?$config->tz:'GMT+3' }}"
                                           required autofocus>

                                    @error('tz')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <label for="tz" class="col-md-4 col-form-label text-md-right ">االمنطقة الزمنية </label>

                            </div>
                            <div class="form-group row ">
                                <div class="col-md-6">
                                    <input id="shortTime" type="number"
                                           class="form-control @error('shortTime') is-invalid @enderror"
                                           name="shortTime"
                                           value="{{ old('shortTime')?old('shortTime'):($config)?$config->shortTime:10 }}"
                                           required autofocus>

                                    @error('shortTime')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <label for="shortTime" class="col-md-4 col-form-label text-md-right ">الوقت المتبقي
                                    للاقامة (المغرب/العشاء):</label>

                            </div>

                            <div class="form-group row ">

                                <div class="col-md-6">
                                    <input id="longTime" type="number"
                                           class="form-control @error('longTime') is-invalid @enderror" name="longTime"
                                           value="{{ old('longTime')?old('longTime'):($config)?$config->longTime:20 }}"
                                           required autofocus>

                                    @error('longTime')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <label for="longTime" class="col-md-4 col-form-label text-md-right ">الوقت المتبقي
                                    للاقامة (الفجر/الظهر/العصر):</label>

                            </div>

                            <div class="form-group row ">

                                <div class="col-md-6">
                                    <label class="form-control"> الفجر::الشروق::الظهر::العصر::المغرب::العشاء</label>
                                    <input id="Fajr" type="number" class="col-md-2 " name="Fajr"
                                           value="{{ old('Fajr')   ?old('Fajr')   :($config)?$config->Fajr:0 }}"
                                           required autofocus>
                                    <input id="Sunrise" type="number" class="col-md-2 " name="Sunrise"
                                           value="{{ old('Sunrise')?old('Sunrise'):($config)?$config->Sunrise:0 }}"
                                           required autofocus>
                                    <input id="Dhuhr" type="number" class="col-md-2 " name="Dhuhr"
                                           value="{{ old('Dhuhr')  ?old('Dhuhr')  :($config)?$config->Dhuhr:0 }}"
                                           required autofocus>
                                    <input id="Asr" type="number" class="col-md-2 " name="Asr"
                                           value="{{ old('Asr')    ?old('Asr')    :($config)?$config->Asr:0 }}" required
                                           autofocus>
                                    <input id="Maghrib" type="number" class="col-md-2 " name="Maghrib"
                                           value="{{ old('Maghrib')?old('Maghrib'):($config)?$config->Maghrib:2 }}"
                                           required autofocus>
                                    <input id="Isha" type="number" class="col-md-2 " name="Isha"
                                           value="{{ old('Isha')   ?old('Isha')   :($config)?$config->Isha:-1 }}"
                                           required autofocus>


                                </div>
                                <label for="Fajr" class="col-md-4 col-form-label text-md-right ">معامل الزيادة والقصان
                                    (الفجر/الشروق/الظهر/العصر/المغرب/العشاء):</label>

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
@endsection
