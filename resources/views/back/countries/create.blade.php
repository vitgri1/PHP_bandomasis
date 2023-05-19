@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                {{-- title --}}
                <div class="card-header">
                    <h1>Add a Country</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('country-store')}}" method="post">
                        {{-- input for title of tag --}}
                        <div class="mb-3">
                            <label class="form-label">Title of the country</label>
                            <input type="text" class="form-control" name="title" value={{old('title')}}>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Season</label>
                            <select class="form-select" name="season">
                                <option value="0">Seasons list</option>
                                <option value="1">Winter</option>
                                <option value="2">Spring</option>
                                <option value="3">Summer</option>
                                <option value="4">Autumn</option>
                            </select>
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