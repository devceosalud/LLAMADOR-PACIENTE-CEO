<!DOCTYPE html>
<html lang="en">

<head>
    <title>AdminX - The last Admin template you'll ever need</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @yield('css_data')

    {{--CSS TEMPORAL--}}
    @yield('css_data_temporal')

    {{-- CON ESTE COMANDO SE ARREGLO ERROR: 419 --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CDN JQUERY -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--
      # Optional Resources
      Feel free to delete these if you don't need them in your project
    -->
</head>

<body>

    {{--VISOR CON BD EL FINAL--}}
    @yield('main')

    @yield('script_data')


    {{--VISOR SIN BD --}}
    @yield('main_temporal')
   
    

</body>

</html>
