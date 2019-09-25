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
        html {
            cursor :none;
        }
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
            background: url("http://localhost/salat/public/img/bg.png");
            background-size: cover;
            font-family: 'Tajawal Regular' !important;
            font-weight: Bold !important;
            font-size: 2vw !important;
        }

        #ctime,#separatetime, #hijri, #melady ,#day{
            color: red;
            font-size: 2.7vw;
            font-weight: Bold !important;
            text-shadow: 0.02em 0.02em #f8fafc;
        }
        #separatetime {
            color: white !important;
            text-shadow: 0.05em 0.05em blue !important;
        }
        .ctime {
            color: blue !important;
            padding: 10px;
            border: 2px solid #f8fafc;
            box-sizing: content-box;
            width: 65%;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            font-size: 5.5vw !important;
        }

        .area-element {
            font-size: 2vw;
            margin: auto;
            vertical-align: middle;

        }

        .area {
            box-sizing: content-box;
            height: 15em;
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
            color: red;
            text-shadow: 2px 0px #f8fafc;
        }


        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: visible; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 12% auto; /* 15% from the top and centered */
            padding: 10px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

    </style>


</head>
<body>
@yield('content')

</body>


</html>

