<x-app-layout>
    <x-slot name="header">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if(session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{{ session("success") }}',
                        showConfirmButton: false,
                        timer: 2500,
                        timerProgressBar: true,
                        confirmButtonColor: '#1a3a5c'
                    });
                @endif
            });
        </script>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-6">{{ __("You're logged in!") }}</p>

                    <a href="{{ route('prestasi.upload') }}"
                        style="display:inline-block; padding: 10px 24px; background:#c8dff7; color:#1a3a5c; font-weight:600; border-radius:8px; text-decoration:none; transition:background 0.15s;"
                        onmouseover="this.style.background='#aecfed'"
                        onmouseout="this.style.background='#c8dff7'">
                        📤 Upload Prestasi
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>