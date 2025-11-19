<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Transaksi Penjualan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f8ff; /* Light Blue Background */
        }
        .main-container {
            background-color: #f0fff0; /* Light Green/Cream Background */
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .icon-card {
            background-color: #ffc877; /* Soft Orange/Yellow for Cards */
            border: 2px solid #e09f3e;
            box-shadow: 0 5px 15px rgba(255, 179, 0, 0.4);
        }
        .active-menu-box {
            background-color: #f7e6c4; /* Slightly lighter shade for active box */
            color: #b38600;
            border-left: 5px solid #e09f3e;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .logout-btn {
            background-color: #fff;
            color: #555;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .search-input {
            border: 2px solid #ccc;
        }
        .search-input:focus {
            border-color: #ffc877;
            box-shadow: 0 0 0 2px rgba(255, 200, 119, 0.5);
        }
    </style>
</head>
<body class="p-4 md:p-8 flex items-center justify-center min-h-screen">

    <div class="main-container w-full max-w-5xl p-6 md:p-10">
        
        <!-- Top Navigation Bar (Back, Home, Search, Profile) -->
        <div class="flex items-center justify-between mb-8 md:mb-12">
            <div class="flex items-center space-x-4">
                <!-- Back Button -->
                <a href="#" class="text-gray-600 hover:text-gray-800 transition duration-150 p-2 rounded-full hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <!-- Home Button -->
                <a href="#" class="text-gray-600 hover:text-gray-800 transition duration-150 p-2 rounded-full hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"></path></svg>
                </a>
            </div>

            <!-- Search Bar -->
            <div class="flex-grow max-w-md mx-4 hidden md:block">
                <div class="relative">
                    <input type="text" placeholder="Cari..." 
                           class="search-input w-full py-2 pl-10 pr-4 text-lg rounded-full shadow-inner focus:outline-none transition duration-200">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                </div>
            </div>

            <!-- Profile Icon -->
            <a href="#" class="bg-blue-300 text-blue-800 font-bold p-2 rounded-full shadow-md transition duration-150 hover:bg-blue-400">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </a>
        </div>

        <!-- Main Content Area -->
        <div class="flex flex-col md:flex-row space-y-8 md:space-y-0 md:space-x-10">

            <!-- Left Sidebar (Main Menu & Logout) -->
            <div class="flex flex-col space-y-6 w-full md:w-1/4">
                
                <!-- Main Menu Box -->
                <div class="active-menu-box font-bold text-lg p-3 rounded-xl shadow-lg text-center">
                    Transaksi Penjualan
                </div>

                <!-- Logout Button -->
                <a href="{{ route('logout') }}" 
                   class="logout-btn font-semibold py-3 px-6 rounded-xl text-center hover:bg-gray-100 transition duration-200">
                    Logout
                </a>
            </div>
            
            <!-- Vertical Separator (Hidden on Mobile) -->
            <div class="hidden md:block w-0.5 bg-gray-300"></div>

            <!-- Right Content (Sub-menus Grid) -->
            <div class="flex-grow grid grid-cols-2 gap-6">

                <!-- Input Transaksi -->
                <a href="{{ route('transaksi.create') }}" 
                   class="icon-card p-4 md:p-6 rounded-xl text-center shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
                    <div class="mx-auto w-16 h-16 mb-2 flex items-center justify-center rounded-full bg-white/70 shadow-inner">
                        <svg class="w-10 h-10 text-orange-800" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-1 15.17l-3.88-3.88 1.41-1.41L11 14.36l6.47-6.47 1.41 1.41-7.88 7.87z"/>
                        </svg>
                    </div>
                    <span class="font-bold text-md md:text-lg text-gray-800">Input Transaksi</span>
                </a>

                <!-- Edit Transaksi -->
                <a href="{{ route('transaksi.manage', ['mode' => 'edit']) }}" 
                   class="icon-card p-4 md:p-6 rounded-xl text-center shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
                    <div class="mx-auto w-16 h-16 mb-2 flex items-center justify-center rounded-full bg-white/70 shadow-inner">
                        <svg class="w-10 h-10 text-orange-800" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zm.02-3.41L13.88 3.39c.2-.2.5-.2.71 0l2.5 2.5c.2.2.2.5 0 .71L6.75 17.75 3.02 18l.01-3.41z"/>
                        </svg>
                    </div>
                    <span class="font-bold text-md md:text-lg text-gray-800">Edit Transaksi</span>
                </a>

                <!-- Lihat Detail Transaksi -->
                <a href="{{ route('transaksi.index') }}" 
                   class="icon-card p-4 md:p-6 rounded-xl text-center shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
                    <div class="mx-auto w-16 h-16 mb-2 flex items-center justify-center rounded-full bg-white/70 shadow-inner">
                        <svg class="w-10 h-10 text-orange-800" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 4H8C6.9 4 6 4.9 6 6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-1 9H9v-2h6v2zm-2 4h-2v-2h2v2zM16 6h-2V5h2v1z"/>
                        </svg>
                    </div>
                    <span class="font-bold text-md md:text-lg text-gray-800">Lihat Detail Transaksi</span>
                </a>

                <!-- Hapus Transaksi -->
                <a href="{{ route('transaksi.manage', ['mode' => 'delete']) }}" 
                   class="icon-card p-4 md:p-6 rounded-xl text-center shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
                    <div class="mx-auto w-16 h-16 mb-2 flex items-center justify-center rounded-full bg-white/70 shadow-inner">
                        <svg class="w-10 h-10 text-orange-800" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zm2.46-7.3l1.41-1.41L12 12.59l2.12-2.12 1.41 1.41L13.41 14l2.12 2.12-1.41 1.41L12 15.41l-2.12 2.12-1.41-1.41L10.59 14 8.46 11.69zM15.5 4l-.71-.71C14.47 3.12 14.23 3 14 3H9.92c-.23 0-.47.09-.66.29L8.5 4H6v2h12V4h-2.5z"/>
                        </svg>
                    </div>
                    <span class="font-bold text-md md:text-lg text-gray-800">Hapus Transaksi</span>
                </a>

            </div> {{-- end sub-menus grid --}}

        </div> {{-- end main content area --}}

    </div> {{-- end main container --}}

</body>
</html>