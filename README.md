
# Web-Based Inventory Management System API (Laravel + Laravel-Admin)

A web-based inventory management system with RESTful APIs, built using **Laravel** and **Laravel-Admin**. The system helps businesses track products, manage stock levels, record transactions, and monitor inventory performance in real time.

---

## 🚀 Features

* Product management (Create, Read, Update, Delete)
* Category and supplier management
* Stock in / Stock out tracking
* Low stock alert system
* Inventory reports and analytics
* Secure authentication system
* RESTful API for mobile or third-party integration
* Admin dashboard powered by **Laravel-Admin**
* Responsive web interface

---

## 🛠 Built With

* Laravel
* Laravel-Admin
* MySQL 
* REST API
* Bootstrap 
* JavaScript 

---

## 📂 Project Structure

```
inventoryMS/
├── app/
├── public/
│   └── images/        # System images
├── routes/
│   └── api.php         # API routes
│   └── web.php         # Web routes
├── resources/
├── database/
├── README.md
```

---

## 🔧 Installation Guide

### 1. Clone the repository

```bash
git clone https://github.com/your-username/inventoryMS.git
cd inventoryMS
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Setup Environment

Duplicate `.env.example` and rename it to `.env`

Update your database credentials:

```
DB_DATABASE=inventory_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate App Key

```bash
php artisan key:generate
```

### 5. Migrate & Seed Database

```bash
php artisan migrate --seed
```

### 6. Install Laravel-Admin

```bash
php artisan admin:install
```

Login URL:

```
http://127.0.0.1:8000/admin
```

Default Credentials:

```
Username: admin
Password: admin
```

(Change after first login)

### 7. Run the Project

```bash
php artisan serve
```

Open in browser:

```
http://127.0.0.1:8000
```

---

## 📡 API Sample Endpoints

| Method | Endpoint           | Description          |
| ------ | ------------------ | -------------------- |
| GET    | /api/products      | Get all products     |
| GET    | /api/products/{id} | Get single product   |
| POST   | /api/products      | Create product       |
| PUT    | /api/products/{id} | Update product       |
| DELETE | /api/products/{id} | Delete product       |
| GET    | /api/low-stock     | View low-stock items |

Example request:

```bash
GET /api/products
```

Response:

```json
[
  {
    "id":1,
    "name":"Laptop",
    "quantity":12,
    "price":850
  }
]
```

---

## 🖼 Screenshots

<img width="2149" height="1168" alt="Image" src="https://github.com/user-attachments/assets/e9025b78-08b2-4170-9426-28a8c5f3af70" />
<img width="2159" height="1173" alt="Image" src="https://github.com/user-attachments/assets/1c235e80-a1f9-4fc0-b258-3c1fe9a8aa85" />
<img width="2159" height="935" alt="Image" src="https://github.com/user-attachments/assets/48036570-107f-4caf-9301-0f18bf5922cf" />
<img width="2146" height="1028" alt="Image" src="https://github.com/user-attachments/assets/8d3a1eeb-e8c1-4664-9ed2-b552566e7711" />
<img width="2159" height="1023" alt="Image" src="https://github.com/user-attachments/assets/7f3f71e5-86ac-4434-87b6-d846f4d0927f" />
<img width="2142" height="830" alt="Image" src="https://github.com/user-attachments/assets/edb9bbe0-d7f4-416f-a142-b583535ca29a" />
<img width="2155" height="1189" alt="Image" src="https://github.com/user-attachments/assets/95bebdae-3245-4c53-8488-ba17c516f660" />

## 👤 Author

**Mohammed Abamecha Abadiga**

* GitHub: [https://github.com/MameAbadiga](https://github.com/MameAbadiga)
* Email: mame.abadiga@gmail.com


