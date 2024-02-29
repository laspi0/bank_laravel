<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation du solde</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <h1>Consultation du solde</h1>
    <form id="balanceForm">
        <label for="account_number">Numéro de compte :</label>
        <input type="text" name="account_number" id="account_number">
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password">
        <br>
        <label for="account_name">Nom du titulaire :</label>
        <input type="text" name="account_name" id="account_name" disabled>
        <br>
        <label for="account_balance">Solde du compte :</label>
        <input type="text" name="account_balance" id="account_balance" disabled>
    </form>

    <script>
        $(document).ready(function() {
            $('#account_number').on('input', function() {
                var accountNumber = $(this).val();

                $.ajax({
                    url: "{{ route('get.account.balance') }}",
                    method: 'GET',
                    data: {
                        account_number: accountNumber,
                        password: $('#password').val() // Ajoute le mot de passe à la requête AJAX
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#account_name').val(response.name);
                            $('#account_balance').val(response.balance);
                        } else {
                            $('#account_name').val('');
                            $('#account_balance').val(response.message);
                        }
                    }
                });
            });

            // Rafraîchit le solde lors de la saisie du mot de passe
            $('#password').on('input', function() {
                $('#account_number').trigger('input');
            });
        });
    </script>

</body>

</html>