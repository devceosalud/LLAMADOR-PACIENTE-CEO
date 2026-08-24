@extends('layouts.app')


@section('css_data')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/adminx.css') }}" media="screen" />
@endsection


@section('main')
    <div class="adminx-container">
       

        <!-- adminx-content-aside -->
        <div class="adminx-container d-flex justify-content-center align-items-center">
            <div class="page-login">
                <div class="text-center">
                    <a class="navbar-brand mb-4 h1" href="login.html">
                        <img src="{{ asset('dist/img/logo-full.png') }}" class="img-fluid"
                            alt="">
                    </a>
                </div>

                <div class="card mb-0">
                    <div class="card-body">
                        <form action="{{ route('login.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleDropdownFormEmail1" class="form-label">Correo</label>
                                <input type="email" name="email" class="form-control" id="exampleDropdownFormEmail1"
                                    placeholder="email@example.com">
                            </div>
                            <div class="form-group">
                                <label for="exampleDropdownFormPassword1" class="form-label">Clave</label>
                                <input type="password" name="password" class="form-control" id="exampleDropdownFormPassword1"
                                    placeholder="Password">
                            </div>
                          
                            <button type="submit" class="btn btn-sm btn-block btn-primary">Ingresar</button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
