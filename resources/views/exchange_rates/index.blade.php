@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('exchange-rates.store') }}" class="row justify-content-center align-items-end mb-5">
            @csrf
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="amount"><strong>Currency</strong></label>
                    <input type="text" name="currency" class="form-control" placeholder="Currency" required>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label for="amount"><strong>Rate</strong></label>
                    <input type="number" step="0.01" name="rate" class="form-control" placeholder="Rate" required>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary ">Add</button>
                </div>
            </div>
        </form>

        <h1 class="mb-5 text-center">Exchange Rates</h1>
        <table class="table table-striped text-center">
            <thead>
            <tr>
                <th>Currency</th>
                <th>Rate</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($exchangeRates as $currency => $rate)
                <tr>
                    <td>{{ $currency }}</td>
                    <td>{{ $rate }}</td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm edit-btn me-2"
                                data-bs-toggle="modal"
                                data-bs-target="#editRateModal"
                                data-currency="{{ $currency }}"
                                data-rate="{{ $rate }}">
                            Edit
                        </button>

                        <form action="{{  route('exchange-rates.destroy', $currency) }}" method="POST" style="display:inline-block;">
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

        <div class="modal fade" id="editRateModal" tabindex="-1" role="dialog"
             aria-labelledby="editRateModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAmountModalLabel">Edit Rate</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editRateForm" method="POST" action="">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="edit_currency">Currency</label>
                                <input type="text" name="currency" id="edit_currency" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="edit_rate">Rate</label>
                                <input type="number" step="0.01" name="rate" id="edit_rate" class="form-control" required>
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
        $(document).ready(function () {
            $('.edit-btn').on('click', function () {
                var currency = $(this).data('currency');
                var rate = $(this).data('rate');

                var formAction = '/exchange-rates/' + currency;
                $('#editRateForm').attr('action', formAction);
                $('#edit_currency').val(currency);
                $('#edit_rate').val(rate);
            });
        });
    </script>
@endpush
