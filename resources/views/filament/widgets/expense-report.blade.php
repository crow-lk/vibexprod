<div style="padding: 10px; border-radius: 10px; border: 1px solid #ddd; left: 50px;">
    <div style="text-align: center; background-color: #90EE90; font-weight: bold; font-size: 20px; color:#000000">
        <p>Vibex Fitness Gym</p>
        <p>Expense Report</p>
    </div>
    <div style="display: flex; align-items: center;">
        <label for="startDate">Start Date:</label>
        <input type="date" id="startDate" wire:model="startDate" style="border-radius: 6px; padding: 2px; background-color: #007BFF;">

        <label for="endDate">End Date:</label>

<input type="date" id="endDate" wire:model="endDate" style="border-radius: 6px; padding: 2px; background-color: #007BFF;" />
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
                <td colspan="2"><strong>Supplement Costs</strong></td>
            </tr>
            @if ($supplementCosts->isEmpty())
                <tr>
                    <td>No Costs</td>
                    <td style="text-align: right;">{{ number_format(0.00, 2) }}</td>
                </tr>
            @else
                @foreach ($supplementCosts as $cost)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($cost->created_at)->format('d/m/Y') }} - {{ $cost->supplement->name }}</td>
                        <td style="text-align: right;">{{ number_format($cost['total_cost'], 2) }}</td>
                    </tr>
                @endforeach
            @endif

            <tr>
                <td colspan="2"><strong>Tshirt Costs</strong></td>
            </tr>
            @if ($tshirtCosts->isEmpty())
                <tr>
                    <td>No Costs</td>
                    <td style="text-align: right;">{{ number_format(0.00, 2) }}</td>
                </tr>
            @else
                @foreach ($tshirtCosts as $tshirt)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($tshirt->created_at)->format('d/m/Y') }} - {{ $tshirt->tshirt->name }}</td>
                        <td style="text-align: right;">{{ number_format($tshirt['total_cost'], 2) }}</td>
                    </tr>
                @endforeach
            @endif

            <tr>
                <td colspan="2"><strong>Other Expenses</strong></td>
            </tr>
            @if ($expense->isEmpty())
                <tr>
                    <td>No Costs</td>
                    <td style="text-align: right;">{{ number_format(0.00, 2) }}</td>
                </tr>
            @else
                @foreach ($expense as $expensed)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($expensed->created_at)->format('d/m/Y') }} - {{ $expensed->Description }}</td>
                        <td style="text-align: right;">{{ number_format($expensed->amount, 2) }}</td>
                    </tr>
                @endforeach
            @endif

            <tr>
                <td><strong>Total Expenses :</strong></td>
                <td style="text-align: right;"><strong>{{ number_format($totalExpenses, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>
</div>
