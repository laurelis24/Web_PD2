@extends('layout')
 
@section('content')
 
    <h1>{{ $title }}</h1>
 
    @if ($errors->any())
        <div class="alert alert-danger">Lūdzu, novērsiet radušās kļūdas!</div>
    @endif
 
    <form method="post" action="{{$manufacturer->exists ? '/manufacturer/patch/'.$manufacturer->id : '/manufacturers/put'}}">

        @csrf
 
        
        <div class="mb-3">
            <label for="manufacturer-name" class="form-label">Manufacturer vārds</label>

          
            <input 
                type="text" 
                class="form-control @error('name') is-invalid @enderror" 
                id="manufacturer-name" 
                name="name"
                value="{{old('name', $manufacturer->name)}}">
            


                 @error('name')
                <p class="invalid-feedback">{{ $errors->first('name') }}</p>
            @enderror
        </div>


 
        <button type="submit" class="btn btn-primary">{{$manufacturer->exists ? "Rediģēt" : "Pievienot"}}</button>
 
    </form>
 
@endsection

