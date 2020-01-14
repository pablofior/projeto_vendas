<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('doctor_id') ? 'has-error' : '' }}">
        <label for="doctorSelect">Médico</label>
        <select id="doctorSelect" name="doctor_id" class="form-control">
            @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}"
                        {{ isset($appointment) ? $appointment->doctor->id == $doctor->id ? 'selected' : '' : ''}}>
                    {{ $doctor->name }}
                </option>
            @endforeach
        </select>
        @if($errors->has('doctor_id'))
            <span class="help-block">{{ $errors->first('doctor_id') }}</span>
        @endif
    </div>
    <div class="form-group col-md-6 {{ $errors->has('patient_id') ? 'has-error' : '' }}">
        <label for="patientSelect">Paciente</label>
        <select id="patientSelect" name="patient_id" class="form-control">
            @foreach($patients as $patient)
                <option value="{{ $patient->id }}"
                        {{ isset($appointment) ? $appointment->patient->id == $patient->id ? 'selected' : '' : ''}}>
                    {{ $patient->name }}
                </option>
            @endforeach
        </select>
        @if($errors->has('patient_id'))
            <span class="help-block">{{ $errors->first('patient_id') }}</span>
        @endif
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('date') ? 'has-error' : '' }}">
        <label for="start">Data:</label>
        <input id="start" type="date" name="date" class="form-control" value="{{ isset($appointment) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $appointment->start)->format('Y-m-d') : ''}}">
        @if($errors->has('date'))
            <span class="help-block">{{ $errors->first('date') }}</span>
        @endif
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('hour') ? 'has-error' : '' }}">
        <label for="hour">Horário:</label>
        <select id="hour" name="hour" class="form-control">
            @foreach([8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18] as $hour)
                <option value="{{ $hour }}"
                {{ isset($appointment) ? substr($appointment->start, -8, 2) == $hour ? 'selected' : '' : '' }}>{{ $hour }}</option>
            @endforeach
        </select>
        @if($errors->has('hour'))
            <span class="help-block">{{ $errors->first('hour') }}</span>
        @endif
    </div>
    <div class="form-group col-md-6 {{ $errors->has('minute') ? 'has-error' : '' }}">
        <label for="minute">Minuto:</label>
        <select id="minute" name="minute" class="form-control">
            @foreach([00, 20, 40] as $minute)
                <option value="{{ $minute }}"
                {{ isset($appointment) ? substr($appointment->start, -5, 2) == $minute ? 'selected' : '' : '' }}>{{ $minute }}</option>>{{ $minute }}</option>
            @endforeach
        </select>
        @if($errors->has('minute'))
            <span class="help-block">{{ $errors->first('minute') }}</span>
        @endif
    </div>

</div>

@push('js')
    <script>
        $(document).ready(function() {
            $('#patientSelect').select2();
            $('#doctorSelect').select2();
            $('#hour').select2();
            $('#minute').select2();
        });
    </script>
@endpush