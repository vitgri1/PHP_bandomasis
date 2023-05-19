@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                {{-- title --}}
                <div class="card-header">
                    <h1>Add a Hotel</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('hotel-store')}}" method="post" enctype="multipart/form-data">
                        {{-- input for title of tag --}}
                        <div class="mb-3">
                            <label class="form-label">Title of the Hotel</label>
                            <input type="text" class="form-control" name="title" value={{old('title')}}>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cost of the Hotel</label>
                            <input type="text" class="form-control" name="cost" value={{old('cost')}}>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Duration of stay</label>
                            <input type="text" class="form-control" name="duration" value={{old('duration')}}>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Countries</label>
                            <select class="form-select" name="country_id">
                                <option value="0">Country list</option>
                                @foreach($countries as $country)
                                <option value="{{$country->id}}" @if($country->id == old('country_id')) selected @endif>
                                {{$country->title}}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Main photo --}}
                        <div class="mb-3">
                            <label class="form-label">Hotel photo</label>
                            <input type="file" class="form-control" name="photo">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection