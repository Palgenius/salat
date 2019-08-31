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
                        <form method="POST" action="{{ route('submit') }}" enctype="multipart/form-data">
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

                            <div class="form-group row ">
                                <p class="input-group-text">ادا كنت تريد تحميل العرض المرئي حدد النوع وحمله</p>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input type="radio"  name="options" id="inlineRadio1" value="image"> 1
                                        <span style="padding-right: 10px;">صورة</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="options" id="inlineRadio2" value="vedio"> 2
                                        <span style="padding-right: 10px;">فيديو</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="options" id="inlineRadio3" value="text"> 3
                                        <span style="padding-right: 10px;">نص</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <div class="col-sm-6 opt-image hidden">
                                    <input type="file" name="image" id="exampleInputFile" accept="image/png, image/jpeg" >
                                </div>
                                <div class="col-sm-6 opt-vedio hidden">
                                    <input type="file" name="vedio" id="exampleInputFile" accept="video/mp4">
                                </div>
                                <div class="col-sm-6 opt-text hidden">
                                    <input type="file" name="text" id="exampleInputFile" accept="text/html">

                                </div>
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
        $(document).ready(function () {

            $("[name^=options]").click(function () {
                var $this=$(this);
                if($this.val()=='text')
                {
                    if($(".opt-text").hasClass('hidden'))
                    {
                        $(".opt-text").removeClass('hidden');
                        $(".opt-image").addClass('hidden');
                        $(".opt-vedio").addClass('hidden');
                    }

                }
                if($this.val()=='image')
                {
                    if($(".opt-image").hasClass('hidden'))
                    {
                        $(".opt-text").addClass('hidden');
                        $(".opt-image").removeClass('hidden');
                        $(".opt-vedio").addClass('hidden');
                    }

                }
                if($this.val()=='vedio')
                {
                    if($(".opt-vedio").hasClass('hidden'))
                    {
                        $(".opt-text").addClass('hidden');
                        $(".opt-image").addClass('hidden');
                        $(".opt-vedio").removeClass('hidden');
                    }
                }
                console.log($this.val());
            });
        });
    </script>
@endsection
