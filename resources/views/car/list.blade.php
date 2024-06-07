

@extends('layout')

@section('content')



    <h1 class="text-center">{{ $title}}</h1>


    @if (count($cars) > 0)

        <div class="table-responsive">
             <table class="table table-sm table-hover table-striped table-responsive">
            <thead class="thead-light">
                <tr class="text-center">
                    <th >ID</th>
                    <th >Modelis</th>
                    <th >Ražotājs</th>
                    <th >Valsts</th>
                    <th >Kategorija</th>
                    <th >Gads</th>
                    <th >Cena</th>
                    <th >Attēlot</th>
                    <th >Attēls</th>
                    <th >Labot vai Dzēst</th>
                    <!-- <th>&nbsp;</th> -->
                </tr>
            </thead>
            <tbody>

            @foreach($cars as $car)
            
               
                <tr class="text-center">
                    <td  style="line-height:80px;">{{ $car->id }}</td>
                    <td  style="line-height:80px;">{{ $car->model }}</td>
                    <td  style="line-height:80px;">{{ $car->manufacturer->name }}</td>
                    <td  style="line-height:80px;">{{ $car->manufacturer->country }}</td>
                    <td  style="line-height:80px;">{{ $car->category->name }}</td>
                    <td  style="line-height:80px;">{{ $car->year }}</td>
                    <td  style="line-height:80px;">{{"€" . number_format($car->price, 2, '.') }}</td>
                    <td  style="line-height:80px;">{!! $car->display ? '&#x2714;' : '&#x274C;' !!}</td>
                    <td>
                        <!--   src="images/{{$car->image ? $car->image : "placeholder_image.png"}}" -->
                        <img 
                        style="width: 80px; height:80px; min-height:80px; min-width:80px;" class="img-thumbnail" 
                        src="images/{{$car->image ? $car->image : "placeholder_image.png"}}"
                        
                        alt="{{$car->model}}">
                    </td>
                    
                    <td>
                        
                        <a
                            href="/cars/update/{{ $car->id }}"
                            class="btn btn-outline-primary btn-sm"
                        >Labot</a> 
                        <form
                            method="post"
                            action="/cars/delete/{{ $car->id }}"
                            class="d-inline deletion-form"
                        >
                            @csrf
                            <button
                                type="submit"
                                class="btn btn-outline-danger btn-sm"
                            >Dzēst</button>
                        </form>
                    </td
                </tr>
               
            @endforeach

            </tbody>
        </table>
    </div>
    
  

    @else
        <p>Nav atrasts neviens ieraksts</p>
    @endif

    <a href="/cars/create" class="btn btn-primary">Pievienot jaunu auto</a>

@endsection

