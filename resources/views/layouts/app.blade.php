<!DOCTYPE html>
<html>
<head>
    <title>Prayer</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/howler.min.js') }}"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Optional theme -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('font/style.css') }}">

    <style type="text/css">
        .list-times {
            list-style: none;
            text-align: center;

        }

        .list-times li .name {
            color: red;
            font-size: 3.8vw;
            padding-right: 10%;
            float: right;
            text-shadow: 0.03em 0.03em #ffffff;
        }

        .list-times li .time {
            color: blue;
            font-size: 3.8vw;
            padding-right: 10%;
            float: left;
            text-shadow: 0.03em 0.03em #ffffff;
        }

        .prayer-times {
            line-height: 2;
            font-size: 4vw;
            text-shadow: 0.04em 0.04em #ffffff;
        }

        body {
            background: url('http://localhost/salat/public/img/bg.png');
            background-size: cover;
            font-family: 'Tajawal Regular' !important;
            font-weight: Bold !important;
            font-size: 2vw !important;
        }

        #ctime, #hijri, #melady {
            color: white;
            font-size: 2.5vw;
            font-weight: Bold !important;
            text-shadow: 0.05em 0.05em #0f0f0f;
        }

        .ctime {
            padding-top: 5px;
            padding-bottom: 5px;
            border: 2px solid #f8fafc;
            box-sizing: content-box;
            width: 33%;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
        }

        .area-element {
            font-size: 2vw;
            margin: auto;
            vertical-align: middle;

        }

        .area {
            box-sizing: content-box;
            height: 20vw;
            background-color: azure;
            opacity: 0.8;
            box-shadow: 0px 2px 10px #888888;
            text-align: center;

        }

        .areaAdmin {
            height: 100vh;
            background-color: rgba(240, 255, 255, .5);
            opacity: 0.8;
            box-shadow: 0px 2px 10px #888888;
            text-align: center;
            font-size: .5em;
            direction: RTL;

        }

        .areaAdmin .pull-right {
            float: left !important;
        }

        .div-times {
            height: 100vh;
            background-color: rgba(240, 255, 255, .5);
            opacity: 0.8;
            box-shadow: 0px 2px 10px #888888;
        }

        .mosque-name {
            font-size: 4em;
            color: #7c1a17;
            text-shadow: 2px 0px #f8fafc;
        }
    </style>


</head>
<body>
@yield('content')

</body>


</html>

