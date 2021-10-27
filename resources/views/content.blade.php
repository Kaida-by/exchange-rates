@extends('layout')

@section('content')
    @foreach($currencies as $currency)
        <p>{{ $currency->name_bank }}: {{ $currency->name_currency }} {{ $currency->short_name_currency }} - {{ $currency->price }} - {{ $currency->created_at }}</p>
    @endforeach
@endsection
