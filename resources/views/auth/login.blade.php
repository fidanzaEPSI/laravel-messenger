@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card border-primary" style="margin-top: 25%; margin-bottom: 25%;">
                    <div class="card-header text-center"><strong>{{ config('app.name') }}</strong> - Authentication</div>
                    <div class="card-body ">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}" novalidate>
                            {{ csrf_field() }}
            
                            @if ($errors->has('email'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ $errors->first('email') }}
                            </div>
                            @endif
        
                            <div class="form-group">
                                <label for="email">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-fw fa-user"></i></span>
                                    </div>
                                    <input id="email" type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email"  required autofocus>
                                </div>
                            </div>
            
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-fw fa-key"></i></span>
                                    </div>
                                    <input id="password" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" required>
                                </div>
                            </div>
            
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label"> 
                                        Remember me
                                    </label>
                                </div>
                            </div>
                            
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-sign-in-alt"></i> Login
                                </button>
                            </div>

                            <div class="form-group text-center">
                            </div>
                        </form>
                        

                    </div>
                    <div class="card-footer text-center">
                        <p class="card-text">No account yet? <a href="{{ route('register') }}" role="link"> 
                            Register </a>
                        </p> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
