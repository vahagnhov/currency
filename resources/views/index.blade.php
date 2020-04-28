@extends('layouts.layout')

@section('content')
    <section>
        <div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Rate</th>
                    <th scope="col">Date</th>
                    <th scope="col">Updated Time</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($exchange_rates as $rates)
                    @foreach ($rates->exchangeRates as $rate)
                        <tr>
                            <th scope="row">{{$rates->id}}</th>
                            <td>{{$rates->name}}</td>
                            <td>{{$rate->rate}}</td>
                            <td>{{$rate->date}}</td>
                            <td>{{$rate->updated_at}}</td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
            {{$exchange_rates->links()}}
        </div>
    </section>
@endsection