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
                                    <th>Numéro de compte</th>
                                    <th>Fonction</th>
                                    <th>Adresse</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Téléphone</th>
                                    <th>Carte d'identité</th>
                                    <th>Email</th>
                                    <th>Statut du compte</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                <tr>
                                    <td>{{ $client->account_number }}</td>
                                    <td>{{ $client->function }}</td>
                                    <td>{{ $client->address }}</td>
                                    <td>{{ $client->first_name }}</td>
                                    <td>{{ $client->last_name }}</td>
                                    <td>{{ $client->phone }}</td>
                                    <td>{{ $client->national_id }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->account_status }}</td>
                                    <td>
                                        <div class="custom-checkbox">
                                            <input type="checkbox" id="checkbox" class="toggle-status" data-user-id="{{ $client->id }}" @if($client->account_status === 'active') checked @endif>
                                            <label for="checkbox"></label>
                                        </div>

                                    </td>
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

<style>
    .custom-checkbox {
        display: inline-block;
        position: relative;
        cursor: pointer;
    }

    .custom-checkbox input {
        display: none;
    }

    .custom-checkbox label {
        position: absolute;
        top: 0;
        left: 0;
        width: 32px;
        height: 16px;
        border-radius: 8px;
        background-color: #ccc;
        transition: background-color 0.3s ease;
    }

    .custom-checkbox input:checked+label {
        background-color: #4caf50;
        /* Couleur de fond lorsque la case est cochée */
    }

    .custom-checkbox label::after {
        content: '';
        position: absolute;
        top: 1px;
        left: 1px;
        width: 14px;
        height: 14px;
        border-radius: 6px;
        background-color: #fff;
        transition: left 0.3s ease;
    }

    .custom-checkbox input:checked+label::after {
        left: 17px;
        /* Position de l'élément après lorsque la case est cochée */
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('.toggle-status').change(function() {
            var userId = $(this).data('user-id');
            var status = $(this).prop('checked') ? 'active' : 'blocked';
            var labelText = $(this).closest('.custom-checkbox').find('label');

            // Envoi de la requête AJAX pour mettre à jour le statut de l'utilisateur
            $.ajax({
                url: '{{ route("toggle.user.status") }}',
                type: 'POST',
                cache: false, // Désactivation de la mise en cache
                data: {
                    _token: '{{ csrf_token() }}',
                    user_id: userId,
                    status: status
                },
                success: function(response) {
                    if (response.status === 'success') {
                        console.log(response.message);
                        // Mettre à jour le libellé avec le nouveau statut
                        labelText.text(status === 'active' ? labelText.data('active-text') : labelText.data('inactive-text'));
                    } else {
                        console.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Une erreur s\'est produite lors de la mise à jour du statut de l\'utilisateur.', error);
                }
            });
        });
    });
</script>
@endsection