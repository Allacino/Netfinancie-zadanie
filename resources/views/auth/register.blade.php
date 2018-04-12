@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('REGISTRACIA ...') }} <small>je potrebná pre prihlásanie</small></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        {{--meno--}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Meno :') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('meno') ? ' is-invalid' : '' }}" name="meno" placeholder="Meno" value="{{ old('meno') }}" autofocus>

                                @if ($errors->has('meno'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('meno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{--priezvisko--}}
                        <div class="form-group row">
                            <label for="priezvisko" class="col-md-4 col-form-label text-md-right">{{ __('Priezvisko :') }}</label>

                            <div class="col-md-6">
                                <input id="priezvisko" type="text" class="form-control{{ $errors->has('priezvisko') ? ' is-invalid' : '' }}" name="priezvisko" value="{{ old('priezvisko') }}">

                                @if ($errors->has('priezvisko'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('priezvisko') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrovat') }}
                                </button>
                                alebo
                                <a class="btn btn-link" href="{{ route('login') }}">
                                    {{ __('Prihlasit') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
