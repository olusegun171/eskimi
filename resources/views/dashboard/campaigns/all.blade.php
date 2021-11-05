<x-app-layout>

    <div class="w-full sm:px-6">
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="px-4 md:px-10 py-4 md:py-7 bg-gray-100 rounded-tl-lg rounded-tr-lg">
            <div class="sm:flex items-center justify-between">
                <p tabindex="0" class="focus:outline-none text-base sm:text-lg md:text-xl lg:text-2xl font-bold leading-normal text-gray-800">All campaigns</p>
                <div>
                    <a href="{{ route('dashboard.campaign.new') }}" class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 inline-flex sm:ml-3 mt-4 sm:mt-0 items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded">
                        <span class="text-sm font-medium leading-none text-white">New campaign</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white shadow px-4 md:px-10 pt-4 md:pt-7 pb-5 overflow-y-auto">
            <table class="w-full whitespace-nowrap">
                <thead>
                    <tr tabindex="0" class="focus:outline-none h-16 w-full text-sm leading-none text-gray-800">
                        <th class="font-normal text-left pl-4">Campaign</th>
                        <th class="font-normal text-left pl-20">Total Budget</th>
                        <th class="font-normal text-left pl-20">Daily Budget</th>
                        <th class="font-normal text-left pl-12">Start date</th>
                        <th class="font-normal text-left pl-12">End date</th>
                        <th class="font-normal text-left pl-16">Creatives</th>
                    </tr>
                </thead>
                <tbody class="w-full">
                    @foreach($campaigns as $campaign)
                    <tr tabindex="0" class="focus:outline-none h-20 text-sm leading-none text-gray-800 bg-white hover:bg-gray-100 border-b border-t border-gray-100">
                        <td class="pl-4 cursor-pointer">
                            <div class="flex items-center">
                                    <p class="font-medium">{{$campaign->name}}</p>
                            </div>
                        </td>
                        <td class="pl-20">
                            <p class="font-medium">USD{{ number_format($campaign->total_budget, 2, ',', '.') }}</p>
                        </td>
                        <td class="pl-20">
                            <p class="font-medium">USD{{ number_format($campaign->daily_budget, 2, ',', '.') }}</p>
                        </td>
                        <td class="pl-12">
                            <p class="font-medium">{{ $campaign->start_date}}</p>
                        </td>
                        <td class="pl-12">
                            <p class="font-medium">{{ $campaign->end_date}}</p>
                        </td>
                        <td class="pl-16">
                            @if($campaign->creatives->count())
                            <preview-creative :path="{{ json_encode(asset('storage'))}}" :creatives="{{json_encode($campaign->creatives)}}"></preview-creative>
                            @else
                            <p class="font-medium text-red">No creatives</p>
                            @endif
                        </td>
                        <td class="px-7 2xl:px-0">
                            <a class="inline-flex items-center h-8 px-4 m-2 text-sm text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800" href="{{ route('dashboard.campaign.edit', $campaign->id)}}">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $campaigns->links() }}
        </div>
    </div>
</x-app-layout>
<script>
function dropdownFunction(element) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    let list = element.parentElement.parentElement.getElementsByClassName("dropdown-content")[0];
    list.classList.add("target");
    for (i = 0; i < dropdowns.length; i++) {
        if (!dropdowns[i].classList.contains("target")) {
            dropdowns[i].classList.add("hidden");
        }
    }
    list.classList.toggle("hidden");
}
    </script>
