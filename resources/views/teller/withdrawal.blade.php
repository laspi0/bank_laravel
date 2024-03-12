@extends('teller.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <strong class="card-title">Effectuer un retrait</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
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
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Effectuer le retrait</button>
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
<div class="modal fade" id="operationModal" tabindex="-1" aria-labelledby="operationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="operationModalLabel">Résultat de l'opération</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Les informations de l'opération seront affichées ici -->
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
        $('#withdrawalForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#modalBody').html(response.message);
                    $('#operationModal').modal('show');
                    $('#withdrawalForm')[0].reset(); // Réinitialiser le formulaire
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON.message;
                    $('#modalBody').html(errorMessage);
                    $('#operationModal').modal('show');
                }
            });
        });

        $('#operationModal').on('hidden.bs.modal', function () {
            $('#withdrawalForm')[0].reset(); // Réinitialiser le formulaire après la fermeture du modal
        });

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
