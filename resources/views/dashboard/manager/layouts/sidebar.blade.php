<x-slot:menu>
    <x-ts-side-bar smart collapsible>
        <x-slot:brand>
            <div class="mt-8 flex items-center justify-center">
                <img src="{{ asset('/assets/images/tsui.png') }}" width="40" height="40" alt="Logo" />
            </div>
        </x-slot:brand>

        <x-ts-side-bar.item text="Dashboard" icon="home" :route="route('manager.dashboard')" />
        <x-ts-side-bar.item text="Home Page" icon="arrow-uturn-left" :route="route('home')" />
        <x-ts-side-bar.item
                text="Tickets"
                icon="ticket"
                :route="route('manager.tickets.index')"
        />
    </x-ts-side-bar>
</x-slot:menu>
