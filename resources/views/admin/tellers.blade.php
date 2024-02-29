<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Teller</title>
</head>

<body>
    <h1>Liste des Teller</h1>
    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Numéro National</th>
                <th>Numéro de branche</th>
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
                <td>{{ $teller->branch_number }}</td>
                <td>{{ $teller->address }}</td>
                <td>{{ $teller->account_status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>