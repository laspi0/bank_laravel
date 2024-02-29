@extends('users.base')

@section('content')
<h1>Liste des clients</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Numéro de compte</th>
            <th>Fonction</th>
            <th>Adresse</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Téléphone</th>
            <th>Carte d'identité</th>
            <th>Email</th>
            <th>Type de compte</th>
            <th>Statut du compte</th>
            <th>Solde du compte</th>
            <th>Date de création</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clients as $client)
        <tr>
            <td>{{ $client->id }}</td>
            <td>{{ $client->account_number }}</td>
            <td>{{ $client->function }}</td>
            <td>{{ $client->address }}</td>
            <td>{{ $client->first_name }}</td>
            <td>{{ $client->last_name }}</td>
            <td>{{ $client->phone }}</td>
            <td>{{ $client->national_id }}</td>
            <td>{{ $client->email }}</td>
            <td>{{ $client->account_type }}</td>
            <td>{{ $client->account_status }}</td>
            <td>{{ $client->balance }}</td>
            <td>{{ $client->created_at }}</td>
            <td>
                <label class="switch">
                    <input type="checkbox" class="toggle-status" data-user-id="{{ $client->id }}" {{ $client->account_status === 'active' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('.toggle-status').change(function() {
            var userId = $(this).data('user-id');
            var status = $(this).prop('checked') ? 'active' : 'blocked';

            $.ajax({
                url: '{{ route("toggle.user.status") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    user_id: userId,
                    status: status
                },
                success: function(response) {
                    if (response.status === 'success') {
                        console.log(response.message);
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