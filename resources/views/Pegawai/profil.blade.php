@extends('layouts.app')
{{-- ASUMSI: Hanya data $user yang tersedia dari PegawaiProfilController --}}

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-3xl font-bold mb-8 text-gray-800 border-b pb-2">👋 Profil Pengguna (Dari Tabel Users)</h2>

    <div class="bg-white shadow-xl rounded-lg overflow-hidden max-w-2xl mx-auto">
        
        {{-- Header Profil --}}
        <div class="p-6 bg-green-600 text-white flex items-center">
            <svg class="w-10 h-10 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            <div>
                {{-- MENGGUNAKAN NAME DARI TABEL USERS --}}
                <h3 class="text-2xl font-semibold">{{ $user->name }}</h3>
                {{-- MENGGUNAKAN ID DARI TABEL USERS --}}
                <p class="text-sm opacity-90">ID User: {{ $user->id }}</p> 
            </div>
        </div>

        {{-- Detail Akun (Login) --}}
        <div class="p-8 bg-gray-50">
            <h4 class="text-xl font-bold mb-4 text-green-700">Detail Akun</h4>

            <div class="space-y-4">
                
                {{-- Data dari Tabel Users --}}
                <div class="grid grid-cols-2 gap-4 border-b pb-2">
                    <p class="font-medium text-gray-600">Email/Username:</p>
                    <p class="text-gray-900">{{ $user->email }}</p>
                </div>
                
                {{-- DATA BARU: Nomor Telepon (Asumsi ada di tabel users) --}}
                <div class="grid grid-cols-2 gap-4 border-b pb-2">
                    <p class="font-medium text-gray-600">Nomor Telepon:</p>
                    <p class="text-gray-900">{{ $user->noTelepon ?? '-' }}</p>
                </div>

                {{-- DATA BARU: Role --}}
                <div class="grid grid-cols-2 gap-4 border-b pb-2">
                    <p class="font-medium text-gray-600">Role:</p>
                    <p class="text-gray-900">{{ $user->role }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4 border-b pb-2">
                    <p class="font-medium text-gray-600">Terakhir Bergabung:</p>
                    <p class="text-gray-900">{{ $user->created_at->format('d F Y') }}</p>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="p-6 bg-gray-100 border-t">
            <a href="{{ route('dashboard.index') }}" class="text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out font-medium">
  </div> {{-- End Kotak Menu Utama --}}
    </div> {{-- End flex row --}}

</div>
@endsection