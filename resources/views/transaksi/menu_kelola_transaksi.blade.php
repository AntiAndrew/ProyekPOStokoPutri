<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Penjualan</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

        /* Warna Utama */
        :root {
            --bg-page: #cadfc7ff;
            --bg-main: #e9f4e2ff;
            --color-accent: #f0b566ff; /* Kuning/Orange */
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-page);
            padding: 20px;
        }

        .header-bar {
            width: 100%;
            max-width: 950px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #f1eae3ff;
            padding: 10px 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .nav-button-icon {
            background-color: var(--color-accent);
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: background-color 0.15s, transform 0.1s;
            cursor: pointer;
            text-decoration: none;
        }

        .nav-button-icon:hover {
            background-color: #e0a359ff; /* Sedikit lebih gelap saat hover */
            transform: scale(1.08);
        }

        .nav-button-icon:active {
            background-color: #c4873eff; /* Lebih gelap saat active */
            transform: scale(0.88);
            box-shadow: 0 1px 3px rgba(0,0,0,0.3) inset;
        }

        .nav-icon-color {
            color: #4b5563;
        }

        .main-container {
            background-color: var(--bg-main);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 950px;
            padding: 40px 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .tab-active {
            background-color: var(--color-accent);
            font-weight: 700;
            color: #4b5563;
            padding: 10px 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* Gaya Kartu Ikon */
        .icon-card {
            background-color: #ddab5aff; /* Putih bersih untuk card */
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 160px;
            cursor: pointer;
            text-decoration: none;
            border: 2px solid transparent; /* Untuk border hover */
        }

        .icon-card:hover {
            box-shadow: 0 10px 25px rgba(240, 181, 102, 0.5); /* Shadow oranye menonjol */
            transform: translateY(-5px);
            border-color: var(--color-accent); /* Border oranye */
        }

        .icon-card:active {
            transition: none;
            transform: scale(0.95);
            box-shadow: inset 0 4px 8px rgba(0,0,0,0.1);
            background-color: #f7f7f7; /* Sedikit abu-abu saat di-klik */
        }
        
        /* Ikon Kustom (Solid Style) */
        .icon-card svg {
            fill: currentColor; /* Ikon solid */
            color: #333; /* Warna default ikon lebih gelap */
            transition: color 0.2s, transform 0.2s;
            width: 56px; /* Ukuran ikon diperbesar */
            height: 56px; /* Ukuran ikon diperbesar */
        }

        /* Efek Hover Ikon */
        .icon-card:hover svg {
            transform: scale(1.1); /* Zoom saat di-hover */
        }

        /* Warna khusus untuk setiap ikon (Fill Color) */
        /* Warna ini akan menimpa warna default #333 saat ikon card di-hover */
        .icon-input { color: #28A745; } /* Hijau tua */
        .icon-edit { color: #FFC107; } /* Kuning cerah */
        .icon-delete { color: #DC3545; } /* Merah tua */
        .icon-detail { color: #17A2B8; } /* Biru aqua */

        /* Override warna ikon saat card di-hover, menggunakan warna yang lebih cerah/pop */
        .icon-card:hover .icon-input { color: #218838; } /* Hijau sedikit lebih gelap */
        .icon-card:hover .icon-edit { color: #E0A800; } /* Kuning sedikit lebih gelap */
        .icon-card:hover .icon-delete { color: #C82333; } /* Merah sedikit lebih gelap */
        .icon-card:hover .icon-detail { color: #138496; } /* Biru sedikit lebih gelap */

    </style>
</head>

<body class="flex flex-col items-center min-h-screen">

<div class="header-bar">
    
    <div class="flex items-center space-x-2">
        <div class="nav-button-icon" onclick="window.history.back()">
            <svg class="w-5 h-5 nav-icon-color" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
            </svg>
        </div>

        <div class="nav-button-icon" onclick="location.href='{{ url('/dashboard') }}'">
            <svg class="w-5 h-5 nav-icon-color" fill="currentColor" viewBox="0 0 24 24">
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
            </svg>
        </div>
    </div>

    <h1 class="text-xl font-bold text-gray-800">Menu Kelola Transaksi</h1>

    <div class="nav-button-icon" onclick="location.href='{{ url('/profile') }}'">
        <svg class="w-5 h-5 nav-icon-color" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
        </svg>
    </div>

</div>


<div class="main-container">

    <div class="flex flex-col w-full mb-8">
        <div class="flex items-center space-x-4 w-full justify-start">
            <div class="tab-active text-gray-800">
                Kelola Transaksi
            </div>
        </div>
    </div>

    <div class="flex items-start w-full justify-center">
        <div class="w-0.5 bg-gray-500/30 h-96 mr-10 hidden md:block"></div>

        <div class="grid grid-cols-2 gap-8 w-full max-w-lg">

            <a href="{{ route('transaksi.create') }}" class="icon-card">
                <svg class="icon-input" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M19.5 7.5a3 3 0 0 0-3-3h-8.25a3 3 0 0 0-3 3v9a3 3 0 0 0 3 3h8.25a3 3 0 0 0 3-3V7.5ZM6 12a.75.75 0 0 1 .75-.75h2.25a.75.75 0 0 1 0 1.5H6.75A.75.75 0 0 1 6 12Zm0 3.75a.75.75 0 0 1 .75-.75h2.25a.75.75 0 0 1 0 1.5H6.75a.75.75 0 0 1-.75-.75ZM15.75 9a.75.75 0 0 0-1.5 0v2.25H12a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H18a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
                </svg>
                <span class="font-bold text-lg text-gray-900 mt-2">Input Transaksi</span>
            </a>

            <a href="{{ route('transaksi.manage', ['mode'=>'edit']) }}" class="icon-card">
                <svg class="icon-edit" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.18 1.18a2.625 2.625 0 0 0 3.712 3.712l1.18-1.18a2.625 2.625 0 0 0 0-3.712ZM19.513 8.118l-3.693 3.693L2.25 22.139V18.44L15.82 4.872l3.693 3.693Z" />
                </svg>
                <span class="font-bold text-lg text-gray-900 mt-2">Edit Transaksi</span>
            </a>

            <a href="{{ route('transaksi.manage', ['mode'=>'delete']) }}" class="icon-card">
                <svg class="icon-delete" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.5 4.478v.227a48.846 48.846 0 0 0-1.123 7.518c.073.443.35.815.72.867 1.131.14 1.948.598 1.948 1.097 0 .499-.817.957-1.948 1.097-.37.052-.647.424-.72.866a48.847 48.847 0 0 1-1.123 7.518v.227c0 1.562-2.503 1.562-2.503 0V4.478c0-1.562 2.503-1.562 2.503 0Z" clip-rule="evenodd" />
                    <path fill-rule="evenodd" d="M4.5 7.757V4.243c0-1.12.879-2.032 1.973-2.203 1.701-.269 3.416-.54 5.132-.809C13.9.729 14.075.25 14.5.25c.425 0 .59.479.4.757-1.701.269-3.416.54-5.132.809C6.38 1.971 5.5 2.883 5.5 4v3.757c0 1.12-.879 2.032-1.973 2.203-1.701.269-3.416.54-5.132.809-.4.062-.59-.408-.4-.757 1.701-.269 3.416-.54 5.132-.809C5.5.971 6.38 1.883 6.38 3.007v3.757c0 1.12-.879 2.032-1.973 2.203-1.701.269-3.416.54-5.132.809-.4.062-.59-.408-.4-.757Z" clip-rule="evenodd" />
                </svg>
                <span class="font-bold text-lg text-gray-900 mt-2">Hapus Transaksi</span>
            </a>

            <a href="{{ route('transaksi.index') }}" class="icon-card">
                <svg class="icon-detail" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.625 1.5H9a.75.75 0 0 1 .75.75v12.75a.75.75 0 0 1-.75.75H5.625a.75.75 0 0 1-.75-.75V2.25a.75.75 0 0 1 .75-.75Zm9.75 0H18a.75.75 0 0 1 .75.75v12.75a.75.75 0 0 1-.75.75h-2.625a.75.75 0 0 1-.75-.75V2.25a.75.75 0 0 1 .75-.75ZM.375 8.25a.75.75 0 0 0 0 1.5h10.5a.75.75 0 0 0 0-1.5H.375ZM12 8.25a.75.75 0 0 0 0 1.5h10.5a.75.75 0 0 0 0-1.5H12Z" clip-rule="evenodd" />
                </svg>
                <span class="font-bold text-lg text-gray-900 mt-2">Lihat Detail Transaksi</span>
            </a>

        </div>
    </div>

</div>

</body>
</html>