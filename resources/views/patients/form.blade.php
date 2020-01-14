<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('name') ? 'has-error' : '' }}">
        <label for="name">Nome</label>
        <input type="text"
               class="form-control"
               id="name"
               name="name"
               value="{{ $patient->name ?? old('name') ?? ''}}">
        @if($errors->has('name'))
            <span class="help-block">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <div class="form-group col-md-6 {{ $errors->has('phone') ? 'has-error' : '' }}">
        <label for="phone">Telefone</label>
        <input type="text"
               class="form-control"
               id="phone"
               name="phone"
               value="{{ $patient->phone ?? old('phone') ?? ''}}">
        @if($errors->has('phone'))
            <span class="help-block">{{ $errors->first('phone') }}</span>
        @endif
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('birth_date') ? 'has-error' : '' }}">
        <label for="birth_date">Data de nascimento</label>
        <input type="date"
               class="form-control"
               id="birth_date"
               name="birth_date"
               value="{{ $patient->birth_date ?? old('birth_date') ?? ''}}">
        @if($errors->has('birth_date'))
            <span class="help-block">{{ $errors->first('birth_date') }}</span>
        @endif
    </div>
</div>
