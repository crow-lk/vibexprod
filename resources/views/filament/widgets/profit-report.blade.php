<div style="padding: 10px; border-radius: 10px; border: 1px solid #ddd; left: 50px;">
    <div style="text-align: center; background-color: #90EE90; font-weight: bold; font-size: 20px; color:#000000">
        <p>Vibex Fitness Gym</p>
        <p>Profit and Loss Statement</p>
    </div>
    <div style="display: flex; align-items: center;">
        <label for="startDate">Start Date:</label>
        <input type="date" id="startDate" wire:model="startDate" style="border-radius: 6px; padding: 2px; background-color:#007BFF;">

        <label for="endDate">End Date:</label>
        <input type="date" id="endDate" wire:model="endDate" style="border-radius: 6px; padding: 2px; background-color:#007BFF;" />

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
                <td colspan="2"><strong>Revenues</strong></td>
            </tr>
            <tr>
                <td>One-day Pass</td>
                <td style="text-align: right;">{{ number_format($oneDay, 2) }}</td>
            </tr>
            <tr>
                <td>Subscription Payments</td>
                <td style="text-align: right;">{{ number_format($subscriptionPay, 2) }}</td>
            </tr>
            <tr>
                <td>Supplement Sales</td>
                <td style="text-align: right;">{{ number_format($supplimentSale, 2) }}</td>
            </tr>
            <tr>
                <td>Tshirt Sales</td>
                <td style="text-align: right;">{{ number_format($tshirtSale, 2) }}</td>
            </tr>
            <tr>
                <td><strong>Total Revenues :</strong></td>
                <td style="text-align: right;"><strong>{{ number_format($totalIncome, 2) }}</strong></td>
            </tr>
            <tr>
                <td colspan="2"><strong>Expenses</strong></td>
            </tr>
            <tr>
                <td>Supplement Cost</td>
                <td style="text-align: right;">{{ number_format($supplimentCost, 2) }}</td>
            </tr>
            <tr>
                <td>Tshirt Cost</td>
                <td style="text-align: right;">{{ number_format($tshirtCost, 2) }}</td>
            </tr>
            <tr>
                <td>Other Expenses</td>
                <td style="text-align: right;">{{ number_format($expenses, 2) }}</td>
            </tr>
            <tr>
                <td><strong>Total Expenses :</strong></td>
                <td style="text-align: right;"><strong>{{ number_format($totalExpenses, 2) }}</strong></td>
            </tr>
            <tr>
                <td><strong>Net Profit :</strong></td>
                <td style="text-align: right;"><strong>{{ number_format($profit, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>
</div>
