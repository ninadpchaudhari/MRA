<!-- resources/views/auth/login.blade.php -->
@extends('app')
@section('content')
    <form action="/auth/login" method="POST">
        {!! csrf_field() !!}
        <div class="row">
            <div class="col s12">
                <div class="row">
                    <div class="input-field">
                        <input type="text"  name="email" class="validate" value="{{old('email')}}">
                        <label for="email">Email ID:</label>
                    </div>

                    <div class="input-field">
                        <input type="password"  name="password">
                        <label for="password">Password</label>
                    </div>

                    <div class="input-field">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember Me</label>
                    </div>
                    <div class="input-field">
                        <input type="submit" class="btn btn-default right">
                    </div>
                </div>
            </div>
        </div>
    </form>
    @include('errors.list')
@stop
