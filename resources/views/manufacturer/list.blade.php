@extends('layout')
 
@section('content')
 
    <h1>{{ $title }}</h1>
 
    @if (count($items) > 0)
 
        <table class="table table-striped table-hover table-sm">
            <thead class="thead-light">
                <tr>
                    <th>ID</td>
                    <th>Vārds</td>
                    <th>&nbsp;</td>
                </tr>
            </thead>
            <tbody>
 
            @foreach($items as $manufacturer)
            <tr>
                <td>{{ $manufacturer->id }}</td>
                <td>{{ $manufacturer->name }}</td>
                <td><a href="/manufacturers/update/{{ $manufacturer->id }}" class="btn btn-outline-primary btn-sm">Labot</a>
                <form action="/manufacturers/delete/{{$manufacturer->id}}" method="POST" class="deletion-form d-inline">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm" type="submit" class="">Dzēst</button>
                </form>
            </td>
            </tr>
            @endforeach
 
            </tbody>
        </table>
 
    @else
 
        <p>Nav atrasts neviens ieraksts</p>
 
    @endif

    <a href="/manufacturers/create" class="btn btn-primary">Izveidot jaunu</a>
 
@endsection