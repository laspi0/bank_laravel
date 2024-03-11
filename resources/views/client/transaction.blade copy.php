@extends('client.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-2 page-title">My Transactions</h2>
    <p class="card-text">List of transactions</p>
    <div class="row my-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <table class="table datatables" id="dataTable-1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Receiver</th>
                                <th>Receiver Account Number</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Reference</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transaction->receiver->name }}</td>
                                <td>{{ $transaction->receiver->account_number }}</td>
                                <td>{{ $transaction->amount }}</td>
                                <td>{{ $transaction->receiver_id == auth()->user()->id ? 'Deposit' : 'Withdrawal' }}</td>
                                <td>{{ $transaction->reference }}</td>
                                <td>{{ $transaction->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Inclure le fichier JavaScript de DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#dataTable-1').DataTable({
            "paging": true, // Activer la pagination
            "searching": true, // Activer la recherche
            "ordering": true, // Activer le tri par colonne
            "info": true, // Afficher les informations sur la table (par exemple, "Showing 1 to 10 of 20 entries")
            "lengthChange": true, // Activer la sélection du nombre d'entrées par page
            "autoWidth": true, // Ajuster automatiquement la largeur des colonnes
            "pageLength": 10, // Nombre d'entrées par page par défaut
            "language": {
                "paginate": {
                    "previous": "Previous",
                    "next": "Next"
                },
                "search": "Search:",
                "lengthMenu": "Show _MENU_ entries",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "Showing 0 to 0 of 0 entries",
                "emptyTable": "No data available in table",
                "zeroRecords": "No matching records found"
            }
        });
    });
</script>
@endsection