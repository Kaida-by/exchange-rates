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
                @foreach($currency['prises'] as $price)
                    @if($price['min'])
                        <th scope="row" class="text-danger" style="color: red">{{ $price['value'] }}</th>
                    @else
                        <th scope="row">{{ $price['value'] }}</th>
                    @endif
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>

    <charts-component></charts-component>

{{--    <form class="form-inline" action="/">--}}
{{--        <select class="custom-select mr-sm-2" name="switchDate">--}}
{{--            @foreach($dates as $date)--}}
{{--                @if(request('switchDate') === $date['slug'])--}}
{{--                    <option value="{{ $date['slug'] }}" selected>{{ $date['label'] }}</option>--}}
{{--                @else--}}
{{--                    <option value="{{ $date['slug'] }}">{{ $date['label'] }}</option>--}}
{{--                @endif--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--        <button class="btn btn-outline-success" type="submit">Search</button>--}}
{{--    </form>--}}
@endsection
