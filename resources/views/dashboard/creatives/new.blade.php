<x-app-layout>
    <div class="container">
        <div class="px-4 md:px-10 py-4 md:py-7 bg-gray-100 rounded-tl-lg rounded-tr-lg">
            <div class="sm:flex items-center justify-between">
                <p tabindex="0" class="focus:outline-none text-base sm:text-lg md:text-xl lg:text-2xl font-bold leading-normal text-gray-800">Add creatives</p>
            </div>

        </div>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <create-creatives></create-creatives>
    </div>
</x-app-layout>
