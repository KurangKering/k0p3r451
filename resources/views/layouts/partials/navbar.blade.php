<div class="sidebar-category sidebar-category-visible">
  <div class="category-content no-padding">
    <ul class="navigation navigation-main navigation-accordion">
     <!-- Main -->
     <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
     <li class=""><a href="{{ url('/') }}"><i class="icon-circle"></i> <span>Dashboard</span></a></li>

     @role('admin')
     <li>


       <a href="{{ asset('templates/material/#') }}"><i class="icon-circle"></i> <span>Anggota</span></a>
       <ul>
         <li><a href="{{ route('anggota.index') }}">Daftar Anggota</a></li>
         <li><a href="{{ route('anggota.index_verifikasi') }}">Verifikasi Anggota</a></li>
       </ul>

     </li>
     <li><a href="{{ route('simpanan_wajib.index') }}"><i class="icon-circle"></i> <span>Simpanan Wajib</span></a></li>
     <li><a href="{{ route('simpanan_pokok.index') }}"><i class="icon-circle"></i> <span>Simpanan Pokok</span></a></li>
     <li><a href="{{ route('ambil_simpanan.index') }}"><i class="icon-circle"></i> <span>Ambil Simpanan</span></a></li>
     <li><a href="{{ route('peminjaman.index') }}"><i class="icon-circle"></i> <span>Peminjaman</span></a></li>
     <li><a href="{{ route('angsuran.index') }}"><i class="icon-circle"></i> <span>Angsuran</span></a></li>
     <li><a href="{{ route('laporan.index') }}"><i class="icon-circle"></i> <span>Laporan</span></a></li>
     <li><a href="{{ route('users.index') }}"><i class="icon-circle"></i> <span>Pengguna</span></a></li>

     @elserole('ketua')
     <li><a href="{{ route('anggota.index') }}">Daftar Anggota</a></li>
     <li><a href="{{ route('laporan.index') }}"><i class="icon-circle"></i> <span>Laporan</span></a></li>

     @elserole('anggota')

     @endrole
     
       </ul>
     </div>
   </div>