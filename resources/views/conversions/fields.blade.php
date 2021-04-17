<!-- Coin Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('coin_id', 'De:') !!}
    {!! Form::select('coin_id', [''=>'Selecione']+$coins->pluck('name', 'id')->toArray(), old('coin_id'), ['class' => 'form-control select required']) !!}
</div>

<!-- Coin Conversion Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('coin_conversion_id', 'Para:') !!}
    {!! Form::select('coin_conversion_id', [''=>'Selecione']+$coins->pluck('name', 'id')->toArray(), old('coin_conversion_id'), ['class' => 'form-control select required']) !!}
</div>

<!-- Value Conversion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('value_conversion', 'Valor:') !!}
    <input type="text" id="value_conversion" class="form-control money"  name="value_conversion" value="1,00" placeholder="Valor" required>
</div>

<!-- Date Conversion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_conversion', 'Data de referência:') !!}
    {!! Form::date('date_conversion', old('date_conversion', date('Y-m-d')), ['class' => 'form-control required']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Converter', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('conversions.index') }}" class="btn btn-secondary">Cancelar</a>
</div>
