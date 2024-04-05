<x-tenant-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(isset($lead)?'Edit Lead':'Add Lead') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ isset($lead)?route('leads.updateLead', $lead):route('leads.store') }}">
                        @csrf
                        
                        <!-- Client Name -->
                        <div>
                            <x-input-label for="name" :value="__('Client Name')" />
                            <x-text-input id="client_name" class="block mt-1 w-full" type="text" name="client_name"
                                :value="isset($lead) ? $lead->client_name : old('client_name')" autofocus autocomplete="client_name" />
                            <x-input-error :messages="$errors->get('client_name')" class="mt-2" />
                        </div>

                        <!-- Lead Source -->
                        <div class="mt-4">
                            <x-input-label for="lead_source" :value="__('Lead Source')" />
                            <x-select-input id="lead_source" class="block mt-1 w-full" name="lead_source"
                                :selectLabel="__('Select Lead Source')" :options="$lead_sources" :selected="isset($lead) ? $lead->lead_source : ''" :value="old('lead_source')"
                                autocomplete="lead_source" />
                            <x-input-error :messages="$errors->get('lead_source')" class="mt-2" />
                        </div>
                        <!-- Lead Date -->
                        <div>
                            <x-input-label for="lead_date" :value="__('Lead Date')" />
                            <x-date id="lead_date" name="lead_date" class="block mt-1 w-full" :disabled="false"
                                :value="isset($lead) ? $lead->lead_date : old('lead_date')" autofocus autocomplete="lead_date" />
                            <x-input-error :messages="$errors->get('lead_date')" class="mt-2" />
                        </div>


                        <!-- Job Title -->
                        <div>
                            <x-input-label for="job_title" :value="__('Job Title')" />
                            <x-text-input id="job_title" class="block mt-1 w-full" type="text" name="job_title"
                                :value="isset($lead) ? $lead->job_title : old('job_title')" autofocus autocomplete="job_title" />
                            <x-input-error :messages="$errors->get('job_title')" class="mt-2" />
                        </div>

                        {{-- Description --}}
                        <div>
                            <x-input-label for="description" :value="__('Description')" />

                            <x-textarea id="description" name="description" :disabled="false" class="block mt-1 w-full"
                                rows="4" :value="isset($lead) ? $lead->description : old('description')" />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>


                        <!-- Lead Status -->
                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Lead Status')" />
                            <x-select-input id="status" class="block mt-1 w-full" name="status" :selectLabel="__('Select Lead Status')"
                                :options="$statuses" :selected="isset($lead) ? $lead->status : ''" :value="old('status')" autocomplete="status" />
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <!-- Priority -->
                        <div>
                            <x-input-label for="priority" :value="__('Priority')" />
                            <x-text-input id="priority" class="block mt-1 w-full" type="text" name="priority"
                                :value="isset($lead) ? $lead->priority : old('priority')" autofocus autocomplete="priority" />
                            <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="isset($lead) ? $lead->email : old('email')" autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Add Lead') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-tenant-app-layout>
