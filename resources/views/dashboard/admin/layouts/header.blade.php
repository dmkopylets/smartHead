<x-slot:header>
    <x-ts-layout.header>
        <x-slot:left>
            <x-ts-theme-switch />
        </x-slot:left>

        <x-slot:right>
            <x-ts-dropdown>
                <x-slot:action>
                    <button class="cursor-pointer" x-on:click="show = !show">
                        <span class="text-base font-semibold text-primary-500" x-text="name"></span>
                    </button>
                </x-slot:action>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-ts-dropdown.items :text="__('Logout')" onclick="event.preventDefault(); this.closest('form').submit();" separator />
                </form>

            </x-ts-dropdown>
        </x-slot:right>
    </x-ts-layout.header>
</x-slot:header>

