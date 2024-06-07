
@extends('layout')

@section('content')

    <h1 class="text-center">{{ $title }}</h1>

    @if ($errors->any())
         <div class="alert alert-danger">Lūdzu, novērsiet radušās kļūdas!</div> 
        <!--  <div class="alert alert-danger">{{$errors}}</div>  -->
    @endif

    <form
        method="post"
        enctype="multipart/form-data" 
        action="{{ $car->exists ? '/cars/patch/' . $car->id : '/cars/put' }}">
        @csrf

        <div class="mb-3">
            <label for="car-model" class="form-label">Modelis</label>

            <input
                type="text"
                id="car-model"
                name="model"
                value="{{ old('model', $car->model) }}"
                class="form-control @error('model') is-invalid @enderror"
            >

            @error('model')
                <p class="invalid-feedback">{{ $errors->first('model') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="car-manufacturer" class="form-label">Ražotājs</label>

            <select
                id="car-manufacturer"
                name="manufacturer_id"
                class="form-select @error('car_id') is-invalid @enderror"
            >
                <option value="">Norādiet ražotāju!</option>
                    @foreach($manufacturers as $manufacturer)
                        <option
                            value="{{ $manufacturer->id }}"
                            @if ($manufacturer->id == old('manufacturer_id', $manufacturer->manufacturer->id ?? false)) selected @endif
                        >{{ $manufacturer->name }}</option>
                    @endforeach
            </select>

            @error('manufacturer_id')
                <p class="invalid-feedback">{{ $errors->first('manufacturer_id') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="car-category" class="form-label">Kategorija</label>

            <select
                id="car-category"
                name="category_id"
                class="form-select @error('car_id') is-invalid @enderror"
            >
                <option value="">Norādiet kategoriju!</option>
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            @if ($category->id == old('category_id', $category->category->id ?? false)) selected @endif
                        >{{ $category->name }}</option>
                    @endforeach
            </select>

            @error('category_id')
                <p class="invalid-feedback">{{ $errors->first('category_id') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="car-description" class="form-label">Apraksts</label>

            <textarea
                id="car-description"
                name="description"
                class="form-control @error('description') is-invalid @enderror"
            >{{ old('description', $car->description) }}</textarea>

            @error('description')
                <p class="invalid-feedback">{{ $errors->first('description') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="car-year" class="form-label">Izlaišanas gads</label>

            <input
                type="number" max="{{ date('Y') + 1 }}" step="1"
                id="car-year"
                name="year"
                value="{{ old('year', $car->year) }}"
                class="form-control @error('year') is-invalid @enderror"
            >

            @error('year')
                <p class="invalid-feedback">{{ $errors->first('year') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="car-price" class="form-label">Cena</label>

            <input
                type="number" min="0.00" step="0.01" lang="en"
                id="car-price"
                name="price"
                value="{{ old('price', $car->price) }}"
                class="form-control @error('price') is-invalid @enderror"
            >

            @error('price')
                <p class="invalid-feedback">{{ $errors->first('price') }}</p>
            @enderror
        </div>

        

        <div class="mb-3">
            <div class="form-check">
                <input
                    type="checkbox"
                    id="car-display"
                    name="display"
                    value="1"
                    class="form-check-input @error('display') is-invalid @enderror"
                    @if (old('display', $car->display)) checked @endif
                >
                <label class="form-check-label" for="car-display">
                    Publicēt ierakstu
                </label>

                @error('display')
                    <p class="invalid-feedback">{{ $errors->first('display') }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-3">
          <label class="form-label" for="car-image">Attēls</label>
           @if ($car->image){
             <img 
             src="{{asset('images/' . $car->image)}}"
             class="img-fluid img-thumbnail d-block mb-2" 
             alt="{{$car->model}}">
           }
           @endif
           <input 
           type="file"
           accept="image/png, image/jpeg, image/webp"
           id="car-image"
           name="image"
           class="form-control @error('image') is-invalid @enderror"
           >

           @error("image")
           <p class="invalid-feedback">{{$errors->first("image")}}</p>
           @enderror
           
        </div>

        <button type="submit" class="btn btn-primary">
            {{ $car->exists ? 'Atjaunot ierakstu' : 'Pievienot ierakstu' }}
        </button>
    </form>

@endsection

