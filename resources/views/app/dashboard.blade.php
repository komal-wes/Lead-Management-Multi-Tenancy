<x-tenant-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Hello ' . Auth::user()->name) }}
                </div>
                <div class="p-6 text-gray-900">
                    Switch to other tenant :
                </div>
                @if ($tenants->count() > 0)
                    @foreach ($tenants as $tenant)
                        <div class="p-6 text-gray-900">
                            @foreach ($tenant->domains as $domain)
                            <p class=" flex justify-start ">
                                <x-btn-link class="ml-4" href="{{ tenant_route($domain->domain, 'tenant.index', ['email' => auth()->user()->email]) }}">
                                    {{ $tenant->company_name }} </x-btn-link>
                                @if (tenancy()->tenant->domains()->where('domain', $domain->domain)->count() > 0)
                                    <svg width="20" height="20">
                                        <circle cx="10" cy="10" r="4" stroke="green" stroke-width="2"
                                            fill="green" />
                                    </svg>
                                @endif
                                </p>
                            @endforeach
                        </div>
                    @endforeach
                @endif


                <div class="p-6 text-gray-900">
                    <x-btn-link class="ml-4 " href="{{ route('tenants.create') }}"> {{ __('messages.tenant.label.create') }} </x-btn-link>
                </div>

            </div>
        </div>
    </div>
</x-tenant-app-layout>
