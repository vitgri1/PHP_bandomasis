@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Reservations</h1>
                </div>
                {{-- list --}}
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($reservations as $reservation)
                        <li class="list-group-item">
                            <div>
                                {{$reservation->user_id}}
                            </div>

                            <div>
                                {{$reservation->hotel_id}}
                            </div>

                            <div>
                                {{$reservation->approved}}
                            </div>

                            <div class="buttons">
                                <form action="{{route('travel-approve', $reservation)}}" method="post">
                                    <button type="submit" class="btn btn-primary">approve</button>
                                    @csrf
                                    @method('put')
                                </form>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">
                        <div class="client-line">No reservations added yet</div>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection