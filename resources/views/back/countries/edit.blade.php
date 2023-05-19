@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                {{-- title --}}
                <div class="card-header">
                    <h1>Edit Country</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('country-update', $country)}}" method="post">
                        {{-- input for title of tag --}}
                        <div class="mb-3">
                            <label class="form-label">Title of Country</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title', $country->title) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Season</label>
                            <select class="form-select" name="season">
                                <option value="0">Seasons list</option>
                                <option value="1" @if($country->season == 1) selected @endif>Winter</option>
                                <option value="2" @if($country->season == 2) selected @endif>Spring</option>
                                <option value="3" @if($country->season == 3) selected @endif>Summer</option>
                                <option value="4" @if($country->season == 4) selected @endif>Autumn</option>
                            </select>
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