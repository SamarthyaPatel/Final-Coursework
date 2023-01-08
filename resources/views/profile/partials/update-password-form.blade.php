@extends('layouts.basic')

@section('content')
    
<section>
    <div class="container p-2 mt-5 shadow-lg p-1 mb-3 bg-white rounded">

        
    <header class="p-4">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="ps-4">
            <x-input-label for="current_password" :value="__('Current Password')"  class="pe-3"/>
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full rounded" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="ps-4">
            <x-input-label for="password" :value="__('New Password')"  class="pe-4"/>
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full rounded " autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="ps-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')"  class="pe-3"/>
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full rounded " autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 my-4 ps-4">
            <x-primary-button class="btn btn-success">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

    </div>
</section>


@endsection