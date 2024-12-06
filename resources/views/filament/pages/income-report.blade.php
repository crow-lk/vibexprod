<x-filament-panels::page>
    
    <div class="app-header">
        <div class="app-header-title">
            <h2 class="text-2xl font-semibold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Income Report
            </h2>
        </div>
    </div>
    {{-- add date time pickers to get from & to values --}}
    <div class="mt-4">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="sm:col-span-1">
                <label for="from" class="block text-sm font-medium text-gray-700">From</label>
                <input type="date" name="from" id="from" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="sm:col-span-1">
                <label for="to" class="block text-sm font-medium text-gray-700">To</label>
                <input type="date" name="to" id="to" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
        </div>
    </div>

    {{--  add button to generate report --}}
    <div class="mt-4">
        <x-filament::button>
            Generate Report
        </x-filament::button>
    <script>
        document.querySelector('x-filament::button').addEventListener('click', function() {
            const fromDate = document.getElementById('from').value;
            const toDate = document.getElementById('to').value;

            if (fromDate && toDate) {
                fetch(`/api/income-report?from=${fromDate}&to=${toDate}`)
                    .then(response => response.json())
                    .then(data => {
                        // Handle the data returned from the server
                        console.log(data);
                        // You can update the table or other parts of the UI with the data here
                    })
                    .catch(error => console.error('Error fetching income report:', error));
            } else {
                alert('Please select both from and to dates.');
            }
        });
    </script>
    </div>
    <div class="mt-8">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Income Summary</h3>
        <div class="mt-4">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Month
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total Income
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($monthlyPayments as $payment)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $payment->month }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                                    ${{ number_format($payment->total, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ${{ number_format($totalPayments, 2) }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-filament-panels::page>
