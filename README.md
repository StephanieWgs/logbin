# Aplikasi Logbin 
Aplikasi berbasis web yang website yang digunakan untuk menuliskan jurnal secara digital!
Dibuat Oleh:
- Stephanie (03081220016)
- Rosita Darianty (03081220014)
- 22SI2 Universitas Pelita Harapan

## Cara Menjalankan Logbin
Berikut adalah langkah-langkah untuk menjalankan logbin
### Persyaratan Perangkat Lunak
Pastikan Anda telah menginstal perangkat lunak berikut sebelum menjalankan logbin:
- XAMPP Control Panel v3.3.0
- Jika belum ada, silakan install melalui https://www.apachefriends.org/
  
### Instalasi
- Buat sebuah folder baru bernama logbin di c:\xampp\htdocs
- Clone repository ini ke dalam folder tersebut
- Buka hasil clone tersebut, dan lihat apakah ada file logbin.sql
- Aktifkan Apache dan MySQL di XAMPP
- Kunjungi browser ke http://localhost/phpmyadmin/
- Tekan new, kemudian tekan import
- Masukkan file logbin.sql untuk di-import
- Kemudian, tekan import
  
NOTE:
Jika phpmyadmin Anda memiliki password, pastikan untuk menambahkan password Anda di file db.php. File db.php berada di c:\xampp\htdocs\logbin\assets\inc\db.php
$pdo = new PDO('mysql:host=127.0.0.1:3306;dbname=logbin', 'root', 'password Anda');

### Menjalankan Aplikasi Web
- Pastikan Apache dan MySQL sudah aktif atau menyala
- Kunjungi logbin melalui browser ke http://localhost/logbin/

### Requirement
- XAMPP (Apache dan MySQL Aktif)
