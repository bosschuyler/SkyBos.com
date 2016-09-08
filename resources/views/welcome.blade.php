@extends('layouts.app')

@section('navbar-style', 'navbar-fixed-top')

@section('content')

<!DOCTYPE html>
    <div class="body">
        <div class="wrapper">
            <!-- <div class="content">
                <div class="title">SkyBos</div>
            </div> -->

           <div class="container text-left">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-default">
                            <div class="panel-heading  dark-bg">Login</div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-4 control-label">Password</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control" name="password">

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
                                                <label>
                                                    <input type="checkbox" name="remember"> Remember Me
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-btn fa-sign-in"></i> Login
                                            </button>

                                            <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('links')
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
@endsection

@section('styling')
    <style>
        html, body {
            height: 100%;
        }

        body {}

        .body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            height:100%;
        }

        .wrapper {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 96px;
            font-family: 'Lato', sans-serif;
            font-weight: 100;
        }
    </style>
@endsection
