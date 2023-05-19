@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>All Countries</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($countries as $country)
                        <li class="list-group-item">
                            <div>
                                {{$country->title}}
                            </div>
                            <div>
                                {{$country->season}}
                            </div>
                            <div>
                                <a class="btn btn-success" href="{{ route('country-edit', $country) }}">
                                    Edit
                                </a>
                                <form action="{{route('country-delete', $country)}}" method="post">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    @csrf
                                    @method('delete')
                                </form>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">
                        <div class="client-line">No countries added yet</div>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection