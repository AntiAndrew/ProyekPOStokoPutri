<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- PERUBAHAN 1: Judul Halaman Dinamis --}}
    <title>Kelola Transaksi | Mode {{ $mode == 'edit' ? 'Edit' : 'Hapus' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }

        /* Tooltip */
        .tooltip {
            position: relative;
            display: inline-block;
        }
        .tooltip .tooltiptext {
            visibility: hidden;
            width: 140px;
            background-color: #ebd9c5ff; /* coklat tua lembut */
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

        /* Styling Tombol Header Baru (agar mirip gambar) */
        .header-btn {
            /* Warna Latar & Teks */
            background-color: #e4ba6cff; /* accent color (krem sangat muda) */
            color: #bb924bff; /* cream-dark color (coklat tua) */
            
            /* Bentuk & Ukuran */
            border-radius: 9999px; /* Full rounded */
            width: 40px;
            height: 40px;
            
            /* Tata Letak */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.15s;
        }
        .header-btn:hover {
            background-color: #d0b168ff;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'cream-dark': '#647b69ff', /* coklat tua */
                        'cream-light': '#c7dec0ff', /* krem lembut */
                        'accent': '#fdfaebff',      /* krem sangat muda */
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-accent min-h-screen">

    <header class="bg-white shadow-md">
        {{-- DITAMBAHKAN CLASS 'relative' DI SINI --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex justify-between items-center text-cream-dark relative">
            <div class="flex items-center space-x-3">
                
                {{-- Tombol Kembali --}}
                <a href="javascript:history.back()" class="header-btn mr-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left">
                        <path d="m12 19-7-7 7-7"/><path d="M19 12H5"/>
                    </svg>
                </a>
                
                {{-- Tombol Home --}}
                <a href="{{ route('transaksi.menu') }}" class="header-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-home">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                </a>
                
            </div>
            
            {{-- PERUBAHAN 2: Judul Header Dinamis yang terpusat --}}
            {{-- Judul tetap di tengah dengan warna yang sama dengan gambar (hijau gelap/cokelat) --}}
            <h1 class="text-xl md:text-2xl font-semibold text-[#3d5a41] absolute left-1/2 transform -translate-x-1/2">
                {{ $mode == 'edit' ? 'Edit Transaksi' : 'Hapus Transaksi' }}
            </h1>
            
            {{-- Tombol User/Profil di Kanan --}}
            {{-- Sesuaikan warna latar/teks agar menyerupai contoh gambar (hijau muda/cream-light) --}}
            <div class="header-btn ml-auto w-10 h-10 bg-cream-light text-[#3d5a41] font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user">
                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                </svg>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
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

        <div class="bg-cream-light shadow-xl rounded-xl overflow-hidden p-6 md:p-8">
            <div class="mb-6 flex justify-end items-center">
                <div class="tooltip">
                    {{-- Tombol untuk berganti mode Edit/Hapus --}}
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
                                        {{-- JIKA MODE ADALAH 'EDIT', TAMPILKAN TOMBOL EDIT --}}
                                        <a href="{{ route('transaksi.edit', $transaksi->id) }}" 
                                           class="text-[#8b6b3d] hover:text-[#5c4421] font-bold transition duration-150">
                                            Edit
                                        </a>
                                    @else
                                        {{-- JIKA MODE ADALAH 'DELETE' (MODE SAAT INI), TAMPILKAN TOMBOL HAPUS --}}
                                        <button onclick="confirmDelete('{{ $transaksi->no_transaksi }}', '{{ route('transaksi.destroy', $transaksi->id) }}')"
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

    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm p-6 border border-cream-dark">
            <h3 class="text-lg font-bold text-[#3d5a41] mb-3">Konfirmasi Hapus</h3>
            <p class="text-sm text-gray-700 mb-5">
                Anda yakin ingin menghapus transaksi <strong><span id="transaksiRef" class="font-semibold text-[#3d5a41]"></span></strong>?  
                Stok barang akan dikembalikan. Tindakan ini tidak dapat dibatalkan.
            </p>
            <div class="flex justify-end space-x-3">
                <button onclick="document.getElementById('deleteModal').classList.add('hidden'); document.getElementById('deleteModal').classList.remove('flex');" 
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
        // FUNGSI JAVASCRIPT UNTUK MODAL HAPUS
        function confirmDelete(transaksiRef, deleteUrl) { 
            document.getElementById('transaksiRef').innerText = transaksiRef;
            const form = document.getElementById('deleteForm');
            
            // Menggunakan URL DELETE yang dihasilkan oleh route() helper Laravel
            form.action = deleteUrl; 
            
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }
    </script>
</body>
</html>