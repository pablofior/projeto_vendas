<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('name') ? 'has-error' : '' }}">
        <label for="name">Nome</label>
        <input type="text"
               class="form-control"
               id="name"
               name="name"
               value="{{ $doctor->name ?? old('name') ?? ''}}">
        @if($errors->has('name'))
            <span class="help-block">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <div class="form-group col-md-6 {{ $errors->has('specialty') ? 'has-error' : '' }}">
        <label for="specialty">Especialidade</label>
        <input type="text"
               class="form-control"
               id="specialty"
               name="specialty"
               value="{{ $doctor->specialty ?? old('specialty') ?? ''}}">
        @if($errors->has('specialty'))
            <span class="help-block">{{ $errors->first('specialty') }}</span>
        @endif
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('crm') ? 'has-error' : '' }}">
        <label for="crm">CRM</label>
        <input type="text"
               class="form-control"
               id="crm"
               name="crm"
               value="{{ $doctor->crm ?? old('crm') ?? ''}}">
        @if($errors->has('crm'))
            <span class="help-block">{{ $errors->first('crm') }}</span>
        @endif
    </div>
</div>

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script>
        $(document).ready(function() {

            $('#crm').mask('99999999-9/SS', {
                translation: {
                    'S': {pattern: /[A-Z]/}
                }
            });
        });
    </script>
@endpush