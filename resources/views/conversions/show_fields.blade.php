<!-- Coin Id Field -->
<div class="form-group">
    {!! Form::label('coin_id', 'Coin Id:') !!}
    <p>{{ $conversions->coin_id }}</p>
</div>

<!-- Coin Conversion Id Field -->
<div class="form-group">
    {!! Form::label('coin_conversion_id', 'Coin Conversion Id:') !!}
    <p>{{ $coin->name }}</p>
</div>

<!-- Value Conversion Field -->
<div class="form-group">
    {!! Form::label('value_conversion', 'Value Conversion:') !!}
    <p>{{ $coin_conversion->name }}</p>
</div>

<!-- Price Conversion Field -->
<div class="form-group">
    {!! Form::label('price_conversion', 'Price Conversion:') !!}
    <p>{{ $conversions->price_conversion }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $conversions->user->name }}</p>
</div>

<!-- Date Conversion Field -->
<div class="form-group">
    {!! Form::label('date_conversion', 'Date Conversion:') !!}
    <p>{{ $conversions->date_conversion->format('d/m/Y') }}</p>
</div>

