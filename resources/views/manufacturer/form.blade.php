@extends('layout')
 
@section('content')
 
    <h1 class="text-center">{{ $title }}</h1>
 
    @if ($errors->any())
        <div class="alert alert-danger">Lūdzu, novērsiet radušās kļūdas!</div>
    @endif
 
    <form method="post" action="{{$manufacturer->exists ? '/manufacturers/patch/'.$manufacturer->id : '/manufacturers/put'}}">

        @csrf
 
        
        <div class="mb-3">
            <label for="manufacturer-name" class="form-label">Ražotāja nosaukums</label>

          
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

        <div class="mb-3">
            <label for="manufacturer-country" class="form-label">Valsts</label>

          
            <input 
                type="text" 
                class="form-control @error('country') is-invalid @enderror" 
                id="manufacturer-country" 
                name="country"
                value="{{old('country', $manufacturer->country)}}">
            


                 @error('country')
                <p class="invalid-feedback">{{ $errors->first('country') }}</p>
            @enderror
        </div>


 
        <button type="submit" class="btn btn-primary">{{$manufacturer->exists ? "Rediģēt" : "Pievienot"}}</button>
 
    </form>
 
@endsection

