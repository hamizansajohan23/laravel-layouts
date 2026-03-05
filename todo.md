Nama sistem : Sistem Permohonan Pengguna Baru

Tujuan :
mendaftarkan pengguna-pengguna baru

Peranan :
-admin
-pengguna

Modul :
-Login
-Lupa kata laluan
-Profil Pengguna
-Tukar Kata Laluan
-Permohonan Pengguna
-Senarai Pengguna

Pangkalan data
nama_pangkalan data : laravel

Login
-id_pengguna (PK)
-kata_laluan

Lupa kata laluan
-emel

Profil Pengguna
-nama_pengguna
-nokp_pengguna
-emel_pengguna
-bahagian

Tukar kata laluan
-password
-password_baru
-pengguna_id (FK)

Permohonan ID Pengguna Baru
-nama_pengguna
-no_kp
-emel
-bahagian
-pengguna_id (FK)
-status - untuk admin menerima atau menolak permohonan pengguna

Senarai ID Pengguna
-nama_pengguna
-no_kp
-emel
-bahagian
-status enum=('aktif,tidak aktif')
-pengguna_id (FK)
