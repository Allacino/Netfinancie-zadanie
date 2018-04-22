{{--login--}}
<div class="form-group row">
    <label for="formLogin" class="col-md-4 col-form-label text-md-right"><span style="color: red">* </span>{{ __('Login :') }}</label>

    <div class="col-md-6">
        <input id="formLogin" type="text" class="form-control{{ $errors->has('login') ? ' is-invalid' : '' }}" name="login" value="{{ old('login') }}" required>
        <div id="validLogin"></div>

        @if ($errors->has('login'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
        @endif
    </div>
</div>
{{--email--}}
<div class="form-group row">
    <label for="formEmail" class="col-md-4 col-form-label text-md-right"><span style="color: red">* </span>{{ __('E-Mail :') }}</label>

    <div class="col-md-6">
        <input id="formEmail" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
        <div id="validEmail"></div>

    @if ($errors->has('email'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
        @endif
    </div>
</div>
{{--heslo--}}
<div class="form-group row">
    <label for="formPassword" class="col-md-4 col-form-label text-md-right"><span style="color: red">* </span>{{ __('Heslo :') }}</label>

    <div class="col-md-6">
        <input id="formPassword" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        <div id="validPassword"></div>

        @if ($errors->has('password'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="password_confirm" class="col-md-4 col-form-label text-md-right"><span style="color: red">* </span>{{ __('Potvrď heslo :') }}</label>

    <div class="col-md-6">
        <input id="password_confirm" type="password" class="form-control" name="password_confirmation" required>
        <div id="validConfirm"></div>

    </div>
</div>
<hr>
{{--meno--}}
<div class="form-group row">
    <label for="meno" class="col-md-4 col-form-label text-md-right">{{ __('Meno :') }}</label>

    <div class="col-md-6">
        <input id="meno" type="text" class="form-control{{ $errors->has('meno') ? ' is-invalid' : '' }}" name="meno" value="{{ old('meno') }}">

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

{{--ulica--}}
<div class="form-group row">
    <label for="ulica" class="col-md-4 col-form-label text-md-right">{{ __('Ulica :') }}</label>

    <div class="col-md-6">
        <input id="ulica" type="text" class="form-control{{ $errors->has('ulica') ? ' is-invalid' : '' }}" name="ulica" value="{{ old('ulica') }}">

        @if ($errors->has('ulica'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('ulica') }}</strong>
                                    </span>
        @endif
    </div>
</div>
{{--cislo--}}
<div class="form-group row">
    <label for="cislo" class="col-md-4 col-form-label text-md-right">{{ __('Číslo : ') }}</label>

    <div class="col-md-6">
        <input id="cislo" type="text" class="form-control{{ $errors->has('cislo') ? ' is-invalid' : '' }}" name="cislo" value="{{ old('cislo') }}">

        @if ($errors->has('cislo'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('cislo') }}</strong>
                                    </span>
        @endif
    </div>
</div>
{{--psc--}}
<div class="form-group row">
    <label for="psc" class="col-md-4 col-form-label text-md-right">{{ __('PSČ :') }}</label>

    <div class="col-md-6">
        <input id="psc" type="text" class="form-control{{ $errors->has('psc') ? ' is-invalid' : '' }}" name="psc" value="{{ old('psc') }}">

        @if ($errors->has('psc'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('psc') }}</strong>
                                    </span>
        @endif
    </div>
</div>
{{--mesto--}}
<div class="form-group row">
    <label for="mesto" class="col-md-4 col-form-label text-md-right">{{ __('Mesto :') }}</label>

    <div class="col-md-6">
        <input id="mesto" type="text" class="form-control{{ $errors->has('mesto') ? ' is-invalid' : '' }}" name="mesto" value="{{ old('mesto') }}">

        @if ($errors->has('mesto'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('mesto') }}</strong>
                                    </span>
        @endif
    </div>
</div>
{{--popis--}}
<div class="form-group row">
    <label for="popis" class="col-md-4 col-form-label text-md-right">{{ __('Popis :') }}</label>

    <div class="col-md-6">
        <textarea id="popis" rows="2" class="form-control{{ $errors->has('popis') ? ' is-invalid' : '' }}" name="popis" value="{{ old('popis') }}"></textarea>

        @if ($errors->has('popis'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('popis') }}</strong>
                                    </span>
        @endif
    </div>
</div>
{{--stav--}}
<div class="form-group row">
    <label for="stav" class="col-md-4 col-form-label text-md-right">{{ __('Stav :') }}</label>

    <div class="col-md-6">
        {{--<input id="stav" type="text" class="form-control{{ $errors->has('stav') ? ' is-invalid' : '' }}" name="stav" value="{{ old('stav') }}">--}}
        <select id="stav" class="form-control{{ $errors->has('stav') ? ' is-invalid' : '' }}" name="stav" value="{{ old('stav') }}">
            <option>a</option>
            <option>b</option>
            <option>c</option>
        </select>
        @if ($errors->has('stav'))
            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('stav') }}</strong>
                                    </span>
        @endif
    </div>
</div>