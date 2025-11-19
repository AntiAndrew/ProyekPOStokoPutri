<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }

        /* Tooltip */
        .tooltip {
            position: relative;
            display: inline-block;
        }
        .tooltip .tooltiptext {
            visibility: hidden;
            width: 140px;
            background-color: #6b4f2f; /* coklat tua lembut */
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 6px 8px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -70px;
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 12px;
        }
        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'cream-dark': '#6b4f2f', /* coklat tua */
                        'cream-light': '#fef3c7', /* krem lembut */
                        'accent': '#fff7e6',      /* krem sangat muda */
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-accent min-h-screen">

    <!-- Header -->
    <header class="bg-cream-dark shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center text-white">
            <div class="flex items-center space-x-3">
                <a href="{{ route('transaksi.menu') }}" class="hover:text-cream-light transition duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="lucide lucide-home">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                </a>
                <h1 class="text-2xl font-semibold">Kelola Transaksi</h1>
            </div>
            <div class="w-8 h-8 rounded-full bg-cream-light flex items-center justify-center text-cream-dark text-sm font-bold">
                {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Notifikasi -->
        @if (session('success'))
            <div class="bg-yellow-100 border border-yellow-300 text-yellow-800 px-4 py-3 rounded-md mb-6">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-md mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Panel Utama -->
        <div class="bg-cream-light shadow-xl rounded-xl overflow-hidden p-6 md:p-8">
            <div class="mb-6 flex justify-end items-center">
                <div class="tooltip">
                    <a href="{{ route('transaksi.manage', ['mode' => $mode == 'edit' ? 'delete' : 'edit']) }}" 
                       class="inline-flex items-center p-2 border border-cream-dark shadow-sm rounded-lg bg-cream-dark hover:bg-[#8b6b3d] text-white focus:outline-none transition duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L7.5 21H3v-4.5L16.732 3.732z" />
                        </svg>
                    </a>
                    <span class="tooltiptext">
                        Ganti ke Mode {{ $mode == 'edit' ? 'Hapus' : 'Edit' }}
                    </span>
                </div>
            </div>

            <!-- Tabel -->
            <div class="overflow-x-auto rounded-lg shadow-inner bg-white/80 backdrop-blur">
                <table class="min-w-full divide-y divide-[#e5decf]">
                    <thead class="bg-[#fdf3dc]">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-cream-dark uppercase tracking-wider">No. Ref</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-cream-dark uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-cream-dark uppercase tracking-wider">Pelanggan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-cream-dark uppercase tracking-wider">Salesman</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-cream-dark uppercase tracking-wider">Total Bayar</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-cream-dark uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#efe5d1]">
                        @forelse ($data as $transaksi)
                            <tr class="{{ $loop->even ? 'bg-[#fffaf0]' : 'bg-white' }} hover:bg-[#f8efdc] transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $transaksi->no_transaksi }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $transaksi->pelanggan ?? 'Umum' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $transaksi->user->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800 text-right">
                                    Rp {{ number_format($transaksi->total, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                    @if ($mode == 'edit')
                                        <a href="{{ route('transaksi.edit', $transaksi->id) }}" 
                                           class="text-[#8b6b3d] hover:text-[#5c4421] font-bold transition duration-150">
                                            Edit
                                        </a>
                                    @else
                                        <button onclick="confirmDelete('{{ $transaksi->id }}', '{{ $transaksi->no_transaksi }}')"
                                            class="text-red-700 hover:text-red-900 font-bold transition duration-150">
                                            Hapus
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Tidak ada data transaksi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm p-6 border border-cream-dark">
            <h3 class="text-lg font-bold text-cream-dark mb-3">Konfirmasi Hapus</h3>
            <p class="text-sm text-gray-700 mb-5">
                Anda yakin ingin menghapus transaksi <strong><span id="transaksiRef" class="font-semibold text-cream-dark"></span></strong>?  
                Stok barang akan dikembalikan. Tindakan ini tidak dapat dibatalkan.
            </p>
            <div class="flex justify-end space-x-3">
                <button onclick="document.getElementById('deleteModal').classList.add('hidden')" 
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">
                    Batal
                </button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(transaksiId, transaksiRef) {
            document.getElementById('transaksiRef').innerText = transaksiRef;
            const form = document.getElementById('deleteForm');
            form.action = '/transaksi/' + transaksiId;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }
    </script>
</body>
</html>
