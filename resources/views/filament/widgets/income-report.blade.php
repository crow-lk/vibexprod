<div style="padding: 10px; border-radius: 10px; border: 1px solid #ddd; left: 50px;">
    <div style="text-align: center; background-color: #90EE90; font-weight: bold; font-size: 20px; color:#000000">
        <p>Vibex Fitness Gym</p>
        <p>Income Report</p>
    </div>
    <div style="display: flex; align-items: center;">
        <label for="startDate">Start Date:</label>
        <input type="date" id="startDate" wire:model="startDate" style="border-radius: 6px; padding: 2px; background-color:#2708b1;">

        <label for="endDate">End Date:</label>
        <input type="date" id="endDate" wire:model="endDate" style="border-radius: 6px; padding: 2px; background-color:#2708b1;;" />

        <button wire:click="updateFinancials" style="margin: 5px; padding: 5px; border-radius: 5px; background-color: #4CAF50; color: white;">Update</button>
    </div>
    <table style="width: 100%; border-collapse: collapse; margin-top: 5px; margin-bottom: 20px;">
        <thead>
            <tr style="background-color: #f8f68b; color:#000000">
                <th style="text-align: left;">Particulars</th>
                <th style="text-align: right;">Amount (Rs.)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2"><strong>Supplement Sales</strong></td>
            </tr>
            @if ($supplementSales->isEmpty())
                <tr>
                    <td>No sales</td>
                    <td style="text-align: right;">{{ number_format(0.00, 2) }}</td>
                </tr>
            @else
                @foreach ($supplementSales as $sale)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($sale->created_at)->format('d/m/Y') }} - {{ $sale->supplement->name }}</td>
                        <td style="text-align: right;">{{ number_format($sale['total_price'], 2) }}</td>
                    </tr>
                @endforeach
            @endif

            <tr>
                <td colspan="2"><strong>Tshirt Sales</strong></td>
            </tr>
            @if ($tshirtSales->isEmpty())
                <tr>
                    <td>No sales</td>
                    <td style="text-align: right;">{{ number_format(0.00, 2) }}</td>
                </tr>
            @else
                @foreach ($tshirtSales as $tshirt)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($tshirt->created_at)->format('d/m/Y') }} - {{ $tshirt->tshirt->name }}</td>
                        <td style="text-align: right;">{{ number_format($tshirt['total_price'], 2) }}</td>
                    </tr>
                @endforeach
            @endif

            <tr>
                <td colspan="2"><strong>Subscription Payments</strong></td>
            </tr>
            @if ($subscriptionPayments->isEmpty())
                <tr>
                    <td>No sales</td>
                    <td style="text-align: right;">{{ number_format(0.00, 2) }}</td>
                </tr>
            @else
                @foreach ($subscriptionPayments as $payment)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d/m/Y') }} - {{ $payment->membershipSubscription->subscription->subscription_name }}</td>
                        <td style="text-align: right;">{{ number_format($payment->amount, 2) }}</td>
                    </tr>
                @endforeach
            @endif

            <tr>
                <td colspan="2"><strong>One-day Pass</strong></td>
            </tr>
            @if ($oneDayPay->isEmpty())
                <tr>
                    <td>No sales</td>
                    <td style="text-align: right;">{{ number_format(0.00, 2) }}</td>
                </tr>
            @else
                @foreach ($oneDayPay as $one)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($one->created_at)->format('d/m/Y') }} - {{ $one->name }}</td>
                        <td style="text-align: right;">{{ number_format($one['amount'], 2) }}</td>
                    </tr>
                @endforeach
            @endif

            <tr>
                <td><strong>Total Income :</strong></td>
                <td style="text-align: right;"><strong>{{ number_format($totalIncome, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>
</div>
