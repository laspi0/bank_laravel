@extends('client.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your Cards</div>

                <div class="card-body">
                    <div class="row">
                        @forelse ($cards as $card)
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $card->name }}</h5>
                                    <p class="card-text">Card Number: {{ $card->card_number }}</p>
                                    <p class="card-text">Creation Date: {{ $card->creation_date }}</p>
                                    <p class="card-text">Expiration Date: {{ $card->expiration_date }}</p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-md-12">
                            <p>No cards found.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection