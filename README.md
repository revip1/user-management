# User Management API

Aplikasi ini merupakan **RESTful API sederhana** untuk mengelola data pengguna (`User`) menggunakan **Laravel**. Fitur yang disediakan mencakup:
- Melihat daftar user
- Membuat user baru
- Mengupdate user
- Menghapus user

---

## Cara Menjalankan Aplikasi

1. **Clone repository**
   ```bash
   git clone https://github.com/username/user-api.git
   cd user-api
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Buat file `.env`**
   ```bash
   cp .env.example .env
   ```

4. **Konfigurasi database** di `.env`
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Generate app key**
   ```bash
   php artisan key:generate
   ```

6. **Jalankan migrasi database**
   ```bash
   php artisan migrate
   ```

7. **Jalankan server lokal**
   ```bash
   php artisan serve
   ```

   API akan tersedia di:  
   ```
   http://127.0.0.1:8000
   ```

---

## Dokumentasi API

### Base URL
```
/api
```

### Endpoints

#### 1. **Get All Users**
- **Method:** `GET`
- **URL:** `/users`
- **Response:**
```json
{
  "message": "Data User berhasil diambil",
  "data": [
    {
      "id": 1,
      "name": "Revi Permana",
      "email": "revi@example.com",
      "no_telepon": "08123456789",
      "status_aktif": true,
      "department": "IT",
      "created_at": "2025-08-20T10:00:00.000000Z",
      "updated_at": "2025-08-20T10:00:00.000000Z"
    }
  ]
}
```

---

#### 2. **Create User**
- **Method:** `POST`
- **URL:** `/users`
- **Body (JSON):**
```json
{
  "name": "Revi Permana",
  "email": "revi@example.com",
  "no_telepon": "08123456789",
  "status_aktif": true,
  "department": "IT"
}
```
- **Response:**
```json
{
  "message": "User Berhasil dibuat",
  "data": {
    "id": 2,
    "name": "Revi Permana",
    "email": "revi@example.com",
    "no_telepon": "08123456789",
    "status_aktif": true,
    "department": "IT",
    "created_at": "2025-08-20T10:05:00.000000Z",
    "updated_at": "2025-08-20T10:05:00.000000Z"
  }
}
```

---

#### 3. **Update User**
- **Method:** `PUT` atau `PATCH`
- **URL:** `/users/{id}`
- **Body (JSON):**
```json
{
  "name": "Revi Update",
  "email": "revi@example.com",
  "no_telepon": "082123456789",
  "status_aktif": false,
  "department": "HR"
}
```
- **Response:**
```json
{
  "message": "User Berhasil diupdate",
  "data": {
    "id": 2,
    "name": "Revi Update",
    "email": "revi@example.com",
    "no_telepon": "082123456789",
    "status_aktif": false,
    "department": "HR",
    "created_at": "2025-08-20T10:05:00.000000Z",
    "updated_at": "2025-08-20T10:10:00.000000Z"
  }
}
```

---

#### 4. **Delete User**
- **Method:** `DELETE`
- **URL:** `/users/{id}`
- **Response:**
```json
{
  "message": "User Berhasil dihapus"
}
```

---

## Validasi Field

- `name`: wajib (`string`)
- `email`: wajib unik saat create, valid saat update (`email`)
- `no_telepon`: wajib (`8–15 digit`)
- `status_aktif`: wajib (`true`/`false`)
- `department`: opsional (`string`, max 255 karakter)
