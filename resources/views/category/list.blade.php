@extends('layout')
 
@section('content')


 
    <h1 class="text-center">{{ $title }}</h1>
 
    @if (count($categories) > 0)
 
        <table class="table table-striped table-hover table-sm">
            <thead class="thead-light">
                <tr class="text-center">
                    <th>ID</td>
                    <th>Kategorija</td>
                    <th>&nbsp;</td>
                </tr>
            </thead>
            <tbody>
 
            @foreach($categories as $category)
            <tr class="text-center">
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td><a href="/categories/update/{{ $category->id }}" class="btn btn-outline-primary btn-sm">Labot</a>
                <form action="/categories/delete/{{$category->id}}" method="POST" class="deletion-form d-inline">
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

    <a href="/categories/create" class="btn btn-primary">Izveidot jaunu</a>
 
@endsection