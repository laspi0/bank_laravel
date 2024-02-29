<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Effectuer un retrait</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <h1>Effectuer un retrait</h1>
    <form id="withdrawalForm" action="{{ route('withdrawal.make') }}" method="POST">
        @csrf
        <label for="account_number">Numéro de compte :</label>
        <input type="text" name="account_number" id="account_number">
        <br>
        <label for="client_name">Nom du client :</label>
        <input type="text" name="client_name" id="client_name" disabled>
        <br>
        <label for="amount">Montant du retrait :</label>
        <input type="number" name="amount" id="amount">
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password">
        <br>
        <button type="submit">Effectuer le retrait</button>
    </form>

    <script>
        $(document).ready(function() {
            $('#account_number').on('input', function() {
                var accountNumber = $(this).val();

                $.ajax({
                    url: "{{ route('get.client.info') }}",
                    method: 'GET',
                    data: {
                        account_number: accountNumber
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#client_name').val(response.client_name);
                        } else {
                            $('#client_name').val(response.message);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>