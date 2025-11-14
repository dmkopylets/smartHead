<x-app-layout>
    <div class="text-center mt-20">
        <h1 class="text-5xl font-bold text-red-600">403</h1>
        <p class="text-gray-500 mt-4">You do not have access to this page.</p>

        <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4 mt-8">

            <a href="{{ dashboard_route() }}" class="px-6 py-3 rounded-lg font-semibold transition bg-blue-500 hover:bg-blue-600 text-white shadow-md">
                back to Home page
            </a>

            <form method="POST" action="{{ route('logout') }}" class="inline-block">
                @csrf
                <button type="submit" class="px-6 py-3 rounded-lg font-semibold transition bg-red-600 hover:bg-red-700 text-white shadow-md">
                    Вийти
                </button>
            </form>
        </div>

    </div>
</x-app-layout>
