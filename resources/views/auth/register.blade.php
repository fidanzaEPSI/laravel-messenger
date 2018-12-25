@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card border-primary" style="margin-top: 25%; margin-bottom: 25%;">
                    <div class="card-header text-center"><strong>{{ config('app.name') }}</strong> - Registration</div>
            
                    <div class="card-body ">
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}" novalidate>
                                {{ csrf_field() }}
        
                                <div class="form-group {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                    <label for="name">Name</label>
                                    <div class="input-group">
                                        <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                        @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                           {{ $errors->first('name') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
    
                                <div class="form-group {{ $errors->has('email') ? 'is-invalid' : '' }}">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <input id="email" type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                        @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                
                                <div class="form-group {{ $errors->has('password') ? 'is-invalid' : '' }}">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input id="password" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" required>
                                        @if ($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="form-group {{ $errors->has('password') ? 'is-invalid' : '' }}">
                                    <label for="password-confirm">Confirm Password</label>
                                    <div class="input-group">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
        
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-user-plus"></i>
                                         Create an account 
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
