@extends('client.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-header">Create Card</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('cards.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nom</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="cvv">CVV</label>
                                    <input type="text" name="cvv" id="cvv" class="form-control" required>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mx-auto">Créer la carte</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @endsection