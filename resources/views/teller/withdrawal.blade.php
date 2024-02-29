@extends('teller.app')

@section('content1')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <strong class="card-title">Effectuer un retrait</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form id="withdrawalForm" action="{{ route('withdrawal.make') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="account_number">Numéro de compte :</label>
                                    <input type="text" name="account_number" id="account_number" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="client_name">Nom du client :</label>
                                    <input type="text" name="client_name" id="client_name" class="form-control" disabled>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="amount">Montant du retrait :</label>
                                    <input type="number" name="amount" id="amount" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password">Mot de passe :</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Effectuer le retrait</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
    $(document).ready(function() {
        $('#account_number').on('blur', function() {
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
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>



@endsection