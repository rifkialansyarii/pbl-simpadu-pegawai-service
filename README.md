# Project Based Learning
Ini adalah repository service 2 (pegawai) dalam Project Based Learning Sistem Informasi Terpadu (SIMPADU).
## Requirements:
- Git
- Docker
- Docker Compose


## Clone our repository

```shell
git clone https://github.com/rifkialansyarii/pbl-work.git
cd pbl-work
```

## How to use:
Jika kamu **menggunakan linux / macOS** cukup jalankan perintah di bawah ini setelah melakukan cloning repository:

```bash
chmod +x ./scripts/setup.sh
./scripts/setup.sh
```

Tetapi jika kamu menggunakan **windows**, maka ikuti langkah di bawah ini:

### 1. Setup .env 
Kamu dapat menemukan file `.env.example` pada root project, lalu jalankan perintah di bawah ini untuk menyalinnya ke dalam `.env`:

#### Windows (Command Prompt / CMD):

```cmd
copy .env.example .env
```

#### Windows (PowerShell):
```ps
Copy-Item .env.example .env
```

- Atur bagian DATABASE pada .env, sesuaikan dengan kebutuhan.


### 2. Run Docker Containers:
Gunakan perintah di bawah ini untuk mem-build semua container. Tunggu hingga prosesnya selesai.

```ps
docker compose up -d --build
```

### 3. Generate Application Key:

```ps
docker exec laravel_php php artisan key:generate
```

### 4. Migrations and Seeders:

```ps
docker exec laravel_php php artisan migrate --force
docker exec laravel_php php artisan db:seed --force
```
### 5. Clear cache and configs
```ps
docker exec laravel_php php artisan config:clear
docker exec laravel_php php artisan cache:clear
docker exec laravel_php php artisan route:clear
docker exec laravel_php php artisan view:clear
```