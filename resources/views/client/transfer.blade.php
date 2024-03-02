<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Transfer Money</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('transfer') }}">
                        @csrf

                        <div class="form-group">
                            <label for="receiver_account_number">Receiver Account Number</label>
                            <input type="text" name="receiver_account_number" id="receiver_account_number" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="receiver_name">Receiver Name</label>
                            <input type="text" name="receiver_name" id="receiver_name" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Your Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Transfer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#receiver_account_number').on('input', function() {
            var receiverAccountNumber = $(this).val();
            $.ajax({
                url: "{{ route('get.client.info') }}", // Utilisation de la route nommée
                type: 'GET',
                data: {
                    account_number: receiverAccountNumber
                },
                success: function(response) {
                    if (response.success) {
                        $('#receiver_name').val(response.client_name);
                    } else {
                        console.error(response.message);
                        // Gérer le cas où aucun client n'est trouvé avec le numéro de compte
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>