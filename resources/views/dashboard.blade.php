<x-app-layout>
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
                    Select a tenant you want to login to
                </div>
                @if (auth()->user()->tenants()->count() > 0)
                    @foreach (auth()->user()->tenants as $tenant)
                        <div class="p-6 text-gray-900">
                            @foreach ($tenant->domains as $domain)
                                <x-btn-link class="ml-4 "
                                    href="{{ tenant_route($domain->domain, 'tenant.index') }}">
                                    {{ $tenant->company_name }} </x-btn-link>
                            @endforeach
                        </div>
                    @endforeach
                @endif
                <div class="p-6 text-gray-900">
                    <x-btn-link class="ml-4 " href="{{ route('tenants.create') }}"> Create a new tenant </x-btn-link>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
