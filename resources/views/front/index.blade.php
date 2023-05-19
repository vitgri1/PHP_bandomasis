@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>All Hotels</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($hotels as $hotel)
                        <li class="list-group-item">
                            <div>
                                {{$hotel->title}}
                            </div>

                            @if($hotel->photo)
                            <img src="{{asset('hotels-photo') .'/'. $hotel->photo}}">
                            @else
                            <div>no photo</div>
                            @endif

                            <div class="buttons">
                                <a class="btn btn-success" href="{{ route('hotel-edit', $hotel) }}">
                                    Edit
                                </a>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">
                        <div class="client-line">No hotels added yet</div>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection