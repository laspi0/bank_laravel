@extends('accounts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12"> 
            <div class="col-md-12 my-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Liste des guichetiers</h5>
                        <table class="table table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Numéro National</th>
                                    <th>Adresse</th>
                                    <th>Statut du compte</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tellers as $teller)
                                <tr>
                                    <td>{{ $teller->first_name }}</td>
                                    <td>{{ $teller->last_name }}</td>
                                    <td>{{ $teller->email }}</td>
                                    <td>{{ $teller->phone }}</td>
                                    <td>{{ $teller->national_id }}</td>
                                    <td>{{ $teller->address }}</td>
                                    <td>{{ $teller->account_status }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- Bordered table -->
        </div> <!-- end section -->
    </div>
</div>
@endsection