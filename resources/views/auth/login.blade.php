@extends('layouts.app')

@section('content')

<div style="margin-top:70px;"></div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" id="loginPane">
            <div class="box" >
                <div class="panel-heading dark-knight"><small class='text text-muted pull-right'>Login to your <span style='color:orange'><b>@tym</b></span></small><b>Login</b></div>
                <div class="">
                    <form action="{{ route('login') }}" class="form-horizontal" method="POST" >
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label dark-knight">Name</label>

                            <div class="col-md-6">
                                <input id="email" type="name" class="form-control" name="name" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label dark-knight">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label class=''>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                                <a class="btn btn-link " style='text-decoration:none !important;' href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="margin-bottom:270px;"></div>
    <style>
            #loginPane{
                position:relative;
               height:0px;
            }
    </style>
@endsection
