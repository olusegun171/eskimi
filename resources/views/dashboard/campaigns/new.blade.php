<x-app-layout>
    <div class="container">
        <div class="px-4 md:px-10 py-4 md:py-7 bg-gray-100 rounded-tl-lg rounded-tr-lg">
            <div class="sm:flex items-center justify-between">
                <p tabindex="0" class="focus:outline-none text-base sm:text-lg md:text-xl lg:text-2xl font-bold leading-normal text-gray-800">New Campaign</p>
            </div>
        </div>
        <div class="container md:w-2/5">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form id="campaign" method="POST" action="{{ route('dashboard.campaign.create')}}" class="w-11/12 mx-auto xl:w-full xl:mx-0" enctype="multipart/form-data">
            @csrf
        <div class="mt-3">
            <x-label for="name" class="block" :value="__('Name')" />
            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus />
        </div>
        <div class="mt-3">
            <x-label for="total_budget" :value="__('Total budget (USD)')" />
            <x-input id="total_budget" class="block mt-1 w-full" type="text" name="total_budget" placeholder="USD0.00" :value="old('total_budget')" />
        </div>
        <div class="mt-3">
            <x-label for="daily_budget" :value="__('Daily budget (USD)')" />
            <x-input id="daily_budget" class="block mt-1 w-full" type="text" name="daily_budget" placeholder="USD0.00" :value="old('daily_budget')" />
        </div>
        <div class="mt-3">
            <x-label for="start_date" :value="__('Start date')" />
            <x-input id="start_date" class="block mt-1 w-full" type="datetime-local" name="start_date"  :value="old('start_date')"  />
        </div>
        <div class="mt-3">
            <x-label for="end_date" :value="__('End date')" />
            <x-input id="end_date" class="block mt-1 w-full" type="datetime-local" name="end_date" :value="old('end_date')" />
        </div>

        <div class=" mt-3">
            <x-label for="creatives" :value="__('Upload one or more creatives')" />
            <x-input id="creatives" class="block mt-1 w-full" type="file" name="creatives[]" multiple />
    </div>
        <div class="mt-3">
                <x-label for="destination_url" :value="__('Destination url')" />
                <x-input id="destination_url" class="block mt-1 w-full" type="url" name="destination_url" :value="old('destination_url')" />
        </div>
            <div class="mt-3 pb-3">
                <x-button class="text-md rounded text-white bg-green-700">
                    {{ __('Create') }}
                </x-button>
                <a href="{{ route('dashboard.campaigns')}}" class="text-md mx-4">
                    {{ __('Cancel') }}
                </a>
            </div>
    </form>
        </div>
    </div>
</x-app-layout>
