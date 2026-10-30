<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detail Kategori: {{ $kategori->nama_kategori }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="mb-4">
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Deskripsi</p>
                        <p class="text-gray-800 dark:text-gray-200">{{ $kategori->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('kategori.edit', $kategori) }}" 
                           class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-md font-medium transition">
                            Edit
                        </a>
                        <a href="{{ route('kategori.index') }}" 
                           class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-md font-medium transition">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Alat dalam Kategori ini</h3>
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @forelse($kategori->alats as $alat)
                        <div class="flex items-center justify-between py-3 border-b border-gray-200 dark:border-gray-700 last:border-0">
                            <div>
                                <p class="font-medium text-gray-800 dark:text-gray-200">{{ $alat->nama_alat }}</p>
                                <p class="text-sm text-gray-500">{{ $alat->kode_alat }} - Stok: {{ $alat->stok_tersedia }}/{{ $alat->stok }}</p>
                            </div>
                            <span class="px-2 py-1 text-xs rounded-full {{ $alat->kondisi === 'baik' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($alat->kondisi) }}
                            </span>
                        </div>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400 text-center py-4">Belum ada alat dalam kategori ini</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
