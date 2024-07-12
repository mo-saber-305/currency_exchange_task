@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('amounts.store') }}" class="row justify-content-center align-items-end mb-5">
            @csrf
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="currency"><strong>Currency</strong></label>
                    <select name="currency" id="currency" class="form-control" required>
                        @foreach($currencies as $currency)
                            <option value="{{ $currency }}">{{ $currency }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="amount"><strong>Amount</strong></label>
                    <input type="number" step="0.01" name="amount" id="amount" class="form-control" placeholder="Amount" required>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary ">Add</button>
                </div>
            </div>

        </form>

        <h1 class="text-center mb-4">Amounts</h1>

        <table class="table table-striped text-center">
            <thead>
            <tr>
                <th>Currency</th>
                <th>Amount</th>
                <th>Exchange Value</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($amounts as $amount)
                <tr>
                    <td>{{ $amount->currency }}</td>
                    <td>{{ $amount->amount }}</td>
                    <td>{{ $amount->amount * $exchangeRates[$amount->currency] }}</td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm edit-btn me-2"
                                data-bs-toggle="modal"
                                data-bs-target="#editAmountModal"
                                data-id="{{ $amount->id }}"
                                data-currency="{{ $amount->currency }}"
                                data-amount="{{ $amount->amount }}">
                            Edit
                        </button>

                        <form action="{{ route('amounts.destroy', $amount->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>

                    </td>
                </tr>
            @empty
                    <tr><td colspan="4"><strong>There is no data currently</strong></td></tr>
            @endforelse
            </tbody>
        </table>

        <!-- Edit Modal -->
        <div class="modal fade" id="editAmountModal" tabindex="-1" role="dialog"
             aria-labelledby="editAmountModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAmountModalLabel">Edit Amount</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editAmountForm" method="POST" action="">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="edit_currency">Currency</label>
                                <select name="currency" id="edit_currency" class="form-control" required>
                                    @foreach($currencies as $currency)
                                        <option value="{{ $currency }}">{{ $currency }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_amount">Amount</label>
                                <input type="number" step="0.01" name="amount" id="edit_amount" class="form-control" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4">Save changes</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.edit-btn').on('click', function() {
                var id = $(this).data('id');
                var currency = $(this).data('currency');
                var amount = $(this).data('amount');

                var formAction = '/amounts/' + id;
                $('#editAmountForm').attr('action', formAction);
                $('#edit_currency').val(currency);
                $('#edit_amount').val(amount);
                // $('#editAmountModal').modal()
            });
        });
    </script>
@endpush
