@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>All Hotels</h1>
                    {{-- filter and sort --}}
                    <form action="{{route('travel-index')}}" method="get">
                        <div class="container">
                            <div class="row">
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Sort</label>
                                        <select class="form-select" name="sort">
                                            @foreach($sortSelect as $value => $text)
                                            <option value="{{$value}}" @if($value===$sort) selected @endif>{{$text}}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-text">Sort preferences</div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Filter by country</label>
                                        <select class="form-select" name="filter">
                                            <option value="0">All Countries</option>
                                            @foreach($filterSelect as $value => $text)
                                            <option value="{{$value+1}}" @if($value +1==$filter) selected @endif>{{$text}}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-text">Filter preferences</div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Results per page</label>
                                        <select class="form-select" name="per">
                                            @foreach($perSelect as $value => $text)
                                            <option value="{{$value}}" @if($value===$per) selected @endif>{{$text}}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-text">View preferences</div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="sort-filter-buttons">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{route('travel-index')}}" class="btn btn-danger">Clear</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- list --}}
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
            {{-- pagination and page navigation --}}
            <div class="m-2">
                {{ $hotels->links() }}
            </div>
        </div>
    </div>
</div>
@endsection