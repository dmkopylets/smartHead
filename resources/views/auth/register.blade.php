<?php
<x-layout>
    <div class="max-w-md mx-auto mt-10 bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-4 text-center">Реєстрація</h2>
        <form method="POST" action="{{ route('register') }}">
@csrf

<x-input label="Ім’я" name="name" value="{{ old('name') }}" required autofocus />
<x-input label="Email" name="email" type="email" value="{{ old('email') }}" required />
<x-input label="Пароль" name="password" type="password" required />
<x-input label="Підтвердження пароля" name="password_confirmation" type="password" required />

<x-button class="w-full mt-4">
    <x-heroicon-o-user-plus class="w-4 h-4 mr-2" />
    Зареєструватися
</x-button>

@error('email')
<p class="text-red-600 text-sm mt-2">{{ $message }}</p>
@enderror
</form>

<p class="text-center mt-4 text-sm">
    Вже маєш акаунт?
    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Увійти</a>
</p>
</div>
</x-layout>
