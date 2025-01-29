
<div style="width:965px; padding: 20px; border-radius: 10px; border: 1px solid #ddd; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
    <div style="text-align: center; background-color: #90EE90; font-weight: bold; font-size: 24px; color: #000; padding: 10px; border-radius: 10px 10px 0 0;">
        <p>Vibex Fitness Gym</p>
        <p>Profit and Loss Statement</p>
    </div>
    <div style="display: flex; align-items: center; margin-bottom: 15px; margin-top: 15px;">
        <label for="startDate" style="margin-right: 10px;font-weight: bold;">Start Date:</label>
        <div style="position: relative; display: inline-block; margin-right:20px;">
            <input type="date" id="startDate" wire:model="startDate" style="border-radius: 6px; padding: 5px; border: 1px solid #007BFF; background-color: white; color: black;">
            <!-- SVG Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="position: absolute; right: 7px; top: 50%; transform: translateY(-50%); width: 16px; height: 18px; color: black; pointer-events: none;">
                <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd" />
            </svg>
        </div>          

        <label for="endDate" style="margin-right: 10px;font-weight: bold;">End Date:</label>
        <div style="position: relative; display: inline-block;">
            <input type="date" id="endDate" wire:model="endDate" style="border-radius: 6px; padding: 5px; border: 1px solid #007BFF; background-color: white; color: black;">
            <!-- SVG Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="position: absolute; right: 7px; top: 50%; transform: translateY(-50%); width: 16px; height: 18px; color: black; pointer-events: none;">
                <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd" />
            </svg>
        </div>
        <button wire:click="updateFinancials" style="margin-left: 20px; padding: 5px 10px; border-radius: 5px; background-color: #4CAF50; color: white;">Update</button>
    </div>
    <table style="width: 100%; border-collapse: collapse; margin-top: 5px; margin-bottom: 20px;">
        <thead>
            <tr style="background-color: #f8f68b; color:#000000">
                <th style="text-align: left; padding: 10px;">Particulars</th>
                <th style="text-align: right; padding: 10px;">Amount (Rs.)</th>
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
