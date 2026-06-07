<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            Login Panel
        </x-slot>

        <x-slot name="description">
            Pilih panel tujuan. Sistem akan keluar dari session saat ini terlebih dahulu agar tidak muncul 403.
        </x-slot>

        <div class="grid gap-3 sm:grid-cols-3">
            <x-filament::button
                tag="a"
                href="{{ route('panel.login', 'guru') }}"
                icon="heroicon-o-academic-cap"
                color="warning"
            >
                Login Guru
            </x-filament::button>

            <x-filament::button
                tag="a"
                href="{{ route('panel.login', 'siswa') }}"
                icon="heroicon-o-user"
                color="success"
            >
                Login Siswa
            </x-filament::button>

            <x-filament::button
                tag="a"
                href="{{ route('panel.login', 'orangtua') }}"
                icon="heroicon-o-users"
                color="info"
            >
                Login Orangtua
            </x-filament::button>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
