# 🌍 Explore GunungKidul

**PGWEBL** (Platform Geospasial Web Gunungkidul) adalah sebuah platform **WebGIS (Web Geographic Information System)** yang menyajikan informasi spasial mengenai persebaran objek wisata di Kabupaten Gunungkidul, Yogyakarta.  
Melalui peta interaktif, pengguna dapat menjelajahi lokasi-lokasi wisata seperti pantai, goa, air terjun, bukit, dan destinasi alam lainnya secara visual dan informatif.

---

## 🚀 Fitur Utama

1. **Geolocation Otomatis**  
   Lacak posisi pengguna secara real-time langsung di peta.

2. **Informasi Objek Wisata**  
   Tampilkan detail lengkap tiap destinasi: deskripsi, foto, harga tiket, dan fasilitas.

3. **Rute & Navigasi**  
   Panduan arah terbaik menuju lokasi wisata yang dipilih.

4. **Rekomendasi Transportasi**  
   Saran moda transportasi berdasarkan medan jalan.

5. **Tambah Titik Wisata Baru**  
   Pengguna bisa menambahkan destinasi wisata baru ke dalam peta.

6. **Manajemen Data Wisata**  
   Kelola dan perbarui data wisata secara efisien melalui dashboard admin.

---

## 🧰 Teknologi yang Digunakan

- **Backend**: Laravel 11  
- **Frontend**: Blade Template, Bootstrap, FontAwesome, TailwindCSS  
- **Peta**: Leaflet.js, Leaflet.draw, OpenStreetMap, Google Satellite, GeoJSON  
- **Penyimpanan File**: Laravel Storage  
- **Database**: PostgreSQL  

---

## ⚙️ Cara Instalasi

### 📦 Prasyarat

Pastikan kamu sudah menginstall:
- PHP ≥ 8.2
- Composer
- PostgreSQL
- Node.js & NPM
- Git

### 🧪 Langkah-langkah Setup

```bash
# 1. Clone repositori
git clone https://github.com/username/PGWEBL.git
cd PGWEBL

# 2. Install dependency Laravel
composer install

# 3. Install dependency frontend
npm install && npm run build

# 4. Salin file .env dan sesuaikan konfigurasi
cp .env.example .env
# Edit DB_DATABASE, DB_USERNAME, DB_PASSWORD di file .env

# 5. Generate app key dan buat symbolic link untuk storage
php artisan key:generate
php artisan storage:link

# 6. Migrasi dan isi database
php artisan migrate --seed

# 7. Jalankan server
php artisan serve
