# Service Pegawai
Ini adalah repository service pegawai dalam Project Based Learning Sistem Informasi Akademik Terpadu SABAR.
## Requirements:
- Git
- Docker
- Docker Compose

## Clone our repository

```bash
git clone https://github.com/rifkialansyarii/pbl-simpadu-pegawai-service.git

cd pbl-simpadu-pegawai-service
```

## How to use:
Harus dijalankan pada **Linux / MacOS / WSL** dan cukup jalankan perintah di bawah ini setelah melakukan cloning repository:

Jika dijalankan pada komputer lokal (Development)
```bash
chmod +x ./scripts/local_setup.sh
./scripts/local.sh
```

Jika dijalankan pada VPS / CLOUD / etc. (Production):
```bash
chmod +x ./scripts/prod_setup.sh
./scripts/prod_setup.sh
```

## Optional:
Kamu bisa mengubah username / password koneksi database dan nama database pada file .env sesuai dengan kebutuhan, setelah itu anda harus mematikan container dan memulai kembali.

### Mematikan:
```bash
# Untuk environment local
docker compose -f docker-compose.local.yml down

# Untuk environment production
docker compose -f docker-compose.prod.yml down
```

### Memulai kembali:
```bash
# Untuk environment local
docker compose -f docker-compose.local.yml up -d

# Untuk environment production
docker compose -f docker-compose.prod.yml up -d
```