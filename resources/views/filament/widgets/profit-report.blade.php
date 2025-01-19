<div style="padding: 10px; border-radius:10px; border:1px solid #ddd; left:50px">
<div style="text-align: center; background-color: #90EE90; font-weight:bold; font-size:20px;">
    <p>Vibex Fitness Gym</p>
    <p>Profit and Loss Statement</p>
    <p>For the Month Ending on 12th January, 2025</p>
</div>
<table style="width: 100%;
              border-collapse: collapse;
              margin-top: 5px;
              margin-bottom: 20px;">
    <thead>
      <tr style="background-color: #f8f68b;">
        <th style="text-align: left;">Particulars</th>
        <th style="text-align: right;">Amount (Rs.)</th>
        <th style="text-align: right;">Amount (Rs,)</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="1" style="background-color: #4266df;"><strong>Revenues</strong></td>
        <td></td>
      </tr>
      <tr style="background-color: #79caf8;">
        <td style="border: 1px #90EE90">One-day Pass</td>
        <td style="text-align: right;">{{ $oneDay }}</td>
        <td></td>
      </tr>
      <tr style="background-color: #79caf8;">
        <td>Subsription Payments</td>
        <td style="text-align: right;">{{ $subscriptionPay }}</td>
        <td></td>
      </tr>
      <tr style="background-color: #79caf8;">
        <td>Suppliment Sales</td>
        <td style="text-align: right;">{{ $supplimentSale }}</td>
        <td></td>
      </tr>
      <tr style="background-color: #79caf8;">
        <td>Tshirt Sales</td>
        <td style="text-align: right;">{{ $tshirtSale }}</td>
        <td></td>
      </tr>
      <tr style="background-color: #f879aa;">
        <td><strong>Total Revenues :</strong></td>
        <td></td>
        <td style="text-align: right;"><strong>{{ number_format($totalIncome, 2) }}</strong></td>
      </tr>
      <tr>
        <td colspan="1" style="background-color: #4266df;"><strong>Expenses</strong></td>
        <td></td>
      </tr>
      <tr style="background-color: #79caf8;">
        <td>Suppliment Cost</td>
        <td style="text-align: right;">{{ $supplimentCost }}</td>
        <td></td>
      </tr>
      <tr style="background-color: #79caf8;">
        <td>Tshirt Cost</td>
        <td style="text-align: right;">{{ $tshirtCost }}</td>
        <td></td>
      </tr>
      <tr style="background-color: #79caf8;">
        <td>Other Expenses</td>
        <td style="text-align: right;">{{ $expenses }}</td>
        <td></td>
      </tr>
      <tr style="background-color: #f879aa;">
        <td><strong>Total Expenses :</strong></td>
        <td></td>
        <td style="text-align: right;"><strong>{{ number_format($totalExpenses, 2) }}</strong></td>
      </tr>
      <tr style="background-color: #be3f3f;">
        <td><strong>Net Profit :</strong></td>
        <td></td>
        <td style="text-align: right;"><strong>{{number_format($profit, 2)}}</strong></td>
      </tr>
    </tbody>
  </table>
</div>

