@extends('client.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
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
                            <label for="transfer_fee">Transfer Fee</label>
                            <input type="text" name="transfer_fee" id="transfer_fee" class="form-control" readonly>
                        </div>


                        <div class="form-group">
                            <label for="password">Your Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary float-right">Transfer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="messageModalLabel">Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Placeholder pour le message de session -->
        <div id="messageBody"></div>
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
        $('#amount').on('input', function() {
            var amount = $(this).val();
            $.ajax({
                url: "{{ route('calculate-transfer-fee') }}", // Route pour calculer les frais de transfert
                type: 'GET',
                data: {
                    amount: amount
                },
                success: function(response) {
                    $('#transfer_fee').val(response.transfer_fee);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        
    });
</script>

<script>
  // Attendre que le document soit chargé
  $(document).ready(function() {
    // Vérifier si un message de session est présent
    @if(session()->has('success') || session()->has('error'))
      // Afficher le modal
      $('#messageModal').modal('show');
    @endif

    // Insérer le message de session dans le modal
    $('#messageBody').html(`
      @if(session()->has('success'))
        <div class="alert alert-success" role="alert">{{ session()->get('success') }}</div>
      @endif
      @if(session()->has('error'))
        <div class="alert alert-danger" role="alert">{{ session()->get('error') }}</div>
      @endif
    `);

    // Effacer les messages de session après les avoir affichés
    @if(session()->has('success') || session()->has('error'))
      @php
        session()->forget('success');
        session()->forget('error');
      @endphp
    @endif
  });
</script>
@endsection