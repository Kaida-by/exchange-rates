@extends('layout')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            @foreach($banks as $bank)
                <th scope="col">{{ $bank->name_bank }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($currencies_banks as $currency)
            <tr>
                <th scope="row">{{ $currency['name_currency'] }} ({{ $currency['short_name_currency'] }})</th>
                @foreach($currency['price'] as $price)
                    <th scope="row">{{ $price }}</th>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
