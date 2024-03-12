@extends('teller.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <strong class="card-title">Effectuer un dépôt</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="depositForm" action="{{ route('deposit.make') }}" method="POST">
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
                                    <label for="amount">Montant du dépôt :</label>
                                    <input type="number" name="amount" id="amount" class="form-control">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Effectuer le dépôt</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour afficher les informations -->
<div class="modal fade" id="operationResultModal" tabindex="-1" aria-labelledby="operationResultModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="operationResultModalLabel">Résultat de l'opération</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="operationResultMessage">
                <!-- Le message de l'opération sera affiché ici -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#depositForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        // Afficher le message de succès dans le modal
                        $('#operationResultMessage').html('<p class="text-success">' + response.message + '</p>');
                        $('#operationResultModal').modal('show');
                        // Vider les champs du formulaire
                        $('#account_number').val('');
                        $('#client_name').val('');
                        $('#amount').val('');
                    } else {
                        // Afficher le message d'erreur dans le modal
                        $('#operationResultMessage').html('<p class="text-success">' + response.message + '</p>');
                        $('#operationResultModal').modal('show');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

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
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

@endsection