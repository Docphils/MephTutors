<div class="bg-white">
    <!-- Tabs for Filtering payments by Status -->
    <div class="flex justify-around mb-6 border-b text-sm sm:text-base">
        <button wire:click="setTab('Pending Payments')" class="{{ $activeTab == 'Pending Payments' ? 'border-b-2 border-indigo-500 bg-cyan-200' : '' }} px-1 sm:px-4 py-2">Pending</button>
        <button wire:click="setTab('Earned Payments')" class="{{ $activeTab == 'Earned Payments' ? 'border-b-2 border-indigo-500 bg-cyan-200' : '' }} px-1 sm:px-4 py-2">Earned</button>
        <button wire:click="setTab('Completed Payments')" class="{{ $activeTab == 'Completed Payments' ? 'border-b-2 border-indigo-500 bg-cyan-200' : '' }} px-1 sm:px-4 py-2">Paid</button>
    </div>

    <!-- payments Display -->
    <div>
        <h2 class="font-bold text-lg mb-4 p-4">{{ ucfirst($activeTab) }}</h2>
        <div class="font-bold grid grid-cols-5 gap-4 p-4 bg-white shadow-md rounded-md text-gray-900 text-sm sm:text-base">
            <div>Client</div>
            <div>Start Date</div>
            <div>Subjects</div>
            <div>Amount</div>
            <div>Status / Evidence</div>
        </div>
        @forelse($payments as $payment)
        <div class="grid grid-cols-5 gap-4 p-4 bg-white shadow-md text-gray-900 border-y border-cyan-800 text-xs sm:text-base items-center">
            <div>{{ $payment->booking->client->name }}</div>
            <div>{{ $payment->booking->start_date}}</div>
            <div>{{ $payment->booking->subjects }}</div>
            <div>{{ $payment->amount }}</div>
            @if ($payment->status !== 'Paid')
            <div>{{ $payment->status }}</div>
            @else
            <div class="flex items-center space-x-1 sm:space-x-4 ml-1 sm:ml-0">
                @if($payment->evidence)
                @if(Str::endsWith($payment->evidence, ['.jpg', '.jpeg', '.png', '.gif']))
                    <!-- Display image -->
                    <a href="{{ asset('storage/' . $payment->evidence) }}" target="_blank"> <img src="{{ asset('storage/' . $payment->evidence) }}" alt="Payment Evidence" class="max-w-full h-auto max-h-8 rounded-lg"></a>
                @elseif(Str::endsWith($payment->evidence, '.pdf'))
                    <!-- Display PDF with download link -->
                    <a href="{{ asset('storage/' . $payment->evidence) }}" class="text-blue-600 underline" target="_blank">View Payment Evidence</a>
                @endif
                @else
                    <p>No payment evidence uploaded.</p>
                @endif
            </div>
            @endif
           
        </div>
        @empty
        <div class="p-4 bg-gray-100 text-center text-cyan-800 rounded-lg">
            <strong>No Payments found in this category.</strong>
        </div>
        @endforelse
        {{ $payments->links() }} 

    </div>


</div>
