@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                {{-- title --}}
                <div class="card-header">
                    <h1>Edit Hotel</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('hotel-update', $hotel)}}" method="post" enctype="multipart/form-data">
                        {{-- input for title of tag --}}
                        <div class="mb-3">
                            <label class="form-label">Title of Hotel</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title', $hotel->title) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cost of the Hotel</label>
                            <input type="text" class="form-control" name="cost" value={{old('cost', $hotel->cost)}}>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Duration of stay</label>
                            <input type="text" class="form-control" name="duration" value={{old('duration', $hotel->duration)}}>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Countries</label>
                            <select class="form-select" name="country_id">
                                @foreach($countries as $country)
                                <option value="{{$country->id}}" @if($country->id == old('country_id', $hotel->country_id)) selected @endif>
                                {{$country->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        {{-- Main photo --}}
                        <div class="mb-3">
                            <div class="container">
                                <div class="row">
                                    <div class="col-4">
                                        @if($hotel->photo)
                                        <img src="{{asset('hotels-photo') .'/'. $hotel->photo}}">
                                        @else
                                        <div>no photo</div>
                                        @endif
                                    </div>
                                    <div class="col-8">
                                        <label class="form-label">Hotel photo</label>
                                        <input type="file" class="form-control" name="photo">
                                        <button type="submit" name="delete" value="1" class="mt-2 btn btn-danger">Delete photo</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        @csrf
                        @method('put')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection