<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
/* Pegawai page header styles (shared) */
.screen-area { width:100%; max-width:1100px; background-color:#ffffff; padding:25px 40px; box-shadow:0 6px 18px rgba(17,24,39,0.06); margin:30px auto; border-radius:12px; }
.header { display:flex; justify-content:space-between; align-items:center; margin-bottom:25px; border-bottom:2px solid #e5e7eb; padding-bottom:15px; }
.header-title { font-size:28px; font-weight:700; color:#111827; flex-grow:1; text-align:center; }
.header-icons a { font-size:20px; color:#374151; margin-right:10px; text-decoration:none; border:1px solid #d1d5db; padding:8px 12px; border-radius:6px; transition:background-color 0.2s; }
.header-icons a:hover { background-color:#f3f4f6; }
.my-account i { color:#111827; font-size:2.5rem; }

.detail-table { width:100%; border-collapse:collapse; margin-top:20px; box-shadow:0 2px 8px rgba(0,0,0,0.04); }
.detail-table th, .detail-table td { border:1px solid #e5e7eb; padding:12px 10px; }
.detail-table th { background-color:#f3f4f6; color:#111827; font-weight:700; }
.detail-table td { background-color:#ffffff; }

.text-center { text-align:center; }
.text-end { text-align:right; }

.action-buttons { display:flex; justify-content:center; gap:10px; flex-wrap:wrap; }
.btn { padding:8px 20px; border:none; border-radius:6px; cursor:pointer; font-weight:700; transition:background-color 0.2s, transform 0.08s; }
.btn:active { transform:scale(0.98); }
.btn-edit { background-color:#374151; color:white; }
.btn-delete { background-color:#111827; color:white; }
.btn-view { background-color:#6b7280; color:white; }
.btn-add { background-color:#111827; color:white; margin-bottom:15px; display:inline-block; }

@media (max-width:800px) {
    .screen-area { padding:15px 20px; margin:10px; }
    .header-title { font-size:20px; }
    .detail-table th, .detail-table td { padding:8px 5px; font-size:12px; }
    .action-buttons { flex-direction:column; gap:8px; align-items:stretch; }
}
</style>

<div class="screen-area">

    <div class="header">
        <div class="header-icons">
            <a href="{{ url('/') }}" title="Home"><i class="fas fa-home"></i></a>
        </div>
        <div class="header-title">@yield('page-title', 'Daftar Pegawai')</div>
        <a href="#" class="my-account"><i class="fas fa-user-circle"></i></a>
    </div>

    {{-- Page content should follow after including this partial --}} 
</div>