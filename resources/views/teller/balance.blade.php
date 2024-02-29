@extends('teller.app')

@section('content1')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <strong class="card-title">Vérification du solde du compte</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form id="balanceForm" action="#" method="POST">
                                <div class="form-group mb-3">
                                    <label for="account_number">{{ __('Numéro de compte') }}</label>
                                    <input type="text" class="form-control form-control-sm" id="account_number" placeholder="Numéro de compte">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password">{{ __('Mot de passe') }}</label>
                                    <input type="password" class="form-control form-control-sm" id="password" placeholder="Mot de passe">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="account_name">{{ __('Nom du titulaire') }}</label>
                                    <input type="text" class="form-control form-control-sm" id="account_name" disabled>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="account_balance">{{ __('Solde du compte') }}</label>
                                    <input type="text" class="form-control form-control-sm" id="account_balance" disabled>
                                </div>
                                <button type="button" class="btn btn-primary btn-sm" id="check_balance">Vérifier le solde</button>
                            </form>
                        </div> <!-- /.col -->
                    </div>
                </div>
            </div> <!-- / .card -->
        </div> <!-- end section -->
    </div> <!-- .col-12 -->
</div> <!-- .row -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#check_balance').on('click', function() {
            var accountNumber = $('#account_number').val();

            $.ajax({
                url: "{{ route('get.account.balance') }}",
                method: 'GET',
                data: {
                    account_number: accountNumber,
                    password: $('#password').val()
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
    });
</script>

@endsection