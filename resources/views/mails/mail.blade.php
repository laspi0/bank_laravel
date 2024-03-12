<!DOCTYPE html>
<html>
<head>
    <title>Informations du compte utilisateur</title>
</head>
<body>
    <h2>Informations du compte utilisateur</h2>
    <p>Nom: {{ $user->first_name }}</p>
    <p>Prénom: {{ $user->last_name }}</p>
    <p>Numéro de compte: {{ $user->account_number }}</p>
    <p>ID national: {{ $user->national_id }}</p>
    <p>E-mail: {{ $user->email }}</p>
    <p>Téléphone: {{ $user->phone }}</p>
</body>
</html>
