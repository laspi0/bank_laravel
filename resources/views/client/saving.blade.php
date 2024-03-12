@extends('client.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Épargner</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('saving.create') }}">
                        @csrf

                        <div class="form-group">
                            <label for="amount">Montant à épargner (FCFA)</label>
                            <input type="number" name="amount" id="amount" class="form-control" required>
                        </div>
                        <div class="text-center">

                            <button type="submit" class="btn btn-primary">Épargner</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
