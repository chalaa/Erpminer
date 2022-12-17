<x-user-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-1000">
                    <p class="h2 mb-3 font-weight-bold">Report list</p>
                   @foreach($reports as $report)
                    <div class="flex justify-between">
                        <p class="h3 pb-3">{{ $report->report_name }}</p>
                        <a href="{{ route('report.column', $report->id) }}"> {{ "<Run>" }} </a>
                    </div>
                   @endforeach
                </div>
            </div>
        </div>
    </div>
</x-user-layout>