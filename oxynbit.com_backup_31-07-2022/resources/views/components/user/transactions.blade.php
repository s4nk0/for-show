<table class="table table-striped mb-0 table-responsive-sm">
    <thead>
    <tr>
        <th>Transaction ID</th>
        <th>Time</th>
        <th>Type</th>
        <th>Amount</th>
        {{--                                            <th>Status</th>--}}
        {{--                                            <th>Balance</th>--}}
    </tr>
    </thead>
    <tbody>

    {{--<!--                                        --><?php //dd(Auth::user()->transactions()) ?>--}}
    @if (count($user->transactions())>0)
        @foreach($user->transactions() as $transaction)
            <tr>
                <td>{{ $transaction['block_height'] }}</td>
                <td><input type="datetime-local" style="text-indent:0px" class="form-control bg-dark" value="{{ substr($transaction['create_time'], 0, -1)  }}" readonly>  </td>
                <td>{{ $transaction['type'] }}</td>
                <td>{{ $transaction['amount']/100000000 }} {{ $transaction['currency'] }}</td>


            </tr>
        @endforeach
    @else
        <tr><td></td><td>No data transactions</td><td></td><td></td><td></td></tr>
    @endif

    </tbody>
</table>
