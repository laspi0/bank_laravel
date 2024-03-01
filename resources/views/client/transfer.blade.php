

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
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Transfer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

