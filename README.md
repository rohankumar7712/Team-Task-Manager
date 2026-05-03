# 🚀 TaskFlow

**TaskFlow** is a modern task management system built for fast-moving teams that need clarity, structure, and real-time visibility into their work.

From project planning to execution, TaskFlow keeps everything organized in one streamlined workspace.

---

## 📸 Screenshots

### 🌐 Landing Page
![Landing Page](https://github.com/user-attachments/assets/84c481b1-a3b4-46b9-9e00-768cf9e83e49)

### 🔐 Login Page
![Login Page](https://github.com/user-attachments/assets/dde93dbf-bca0-43dc-97aa-758259aa0c6e)

### 🛠️ Admin Dashboard
![Admin Dashboard](https://github.com/user-attachments/assets/93f2fc85-629c-4853-88e9-0cc138b24aef)

### 👤 Member Dashboard
![Member Dashboard](https://github.com/user-attachments/assets/859550c7-9c2d-4295-8f0e-b77ff6894877)

### 📁 Project Creation
![Project Creation](https://github.com/user-attachments/assets/7f29a307-1a63-4a03-a631-c35cf6b8cd1a)

### ✅ Create Task
![Create Task](https://github.com/user-attachments/assets/3ed3d681-ac92-4380-97a9-fa894f3a1942)

### 👥 Team Management
![Team Management](https://github.com/user-attachments/assets/684ea099-d61a-4172-b41c-89dfa57badd2)

---

## ✨ Key Features

### 📊 Comprehensive Dashboard
- Real-time insights: Total, Active, Completed, and Overdue tasks  
- Live activity tracking across projects  
- Role-based views (Admin vs Team Member)

### 📁 Advanced Project Management
- Project ownership with team collaboration  
- Clean **bento-grid layout** for better visibility  
- Visual indicators for project health and progress  

### ✅ Task Lifecycle & Tracking
- Priority levels: Low, Medium, High  
- Status tracking: To Do → In Progress → Completed  
- Deadline-based overdue detection  
- Task assignment with notification logic  

### 👥 Team & User Management
- Role-Based Access Control (RBAC)  
- Extended user profiles (DOB, Personal Email)  
- Auto-generated secure credentials for new members  

---

## 🛠️ Technical Architecture

### ⚙️ Backend (Laravel 12.x)
- Eloquent ORM with complex relationships  
- Middleware for route protection  
- Laravel Sanctum for authentication (SPA + API ready)  

### 🎨 Frontend
- Tailwind CSS with custom HSL theme  
- Alpine.js for lightweight interactivity  
- Blade Components for reusable UI  

### 🗄️ Database
- Optimized indexing for performance  
- Scalable schema design  
- Optional soft deletes for safer data handling  

---

## 🚀 Installation & Setup

### 📌 Prerequisites
- PHP >= 8.2  
- Composer  
- Node.js & NPM  
- Database (SQLite / MySQL / PostgreSQL)  

⚡ Setup Steps
1. Clone Repository
```bash
git clone https://github.com/rohankumar7712/Team-Task-Manager.git
cd Team-Task-Manager
```
2. Install Dependencies
```bash
composer install
npm install
```
3. Configure Environment
```bash
cp .env.example .env
php artisan key:generate
```
4. Setup Database
```bash
touch database/database.sqlite
php artisan migrate --seed
```
5. Build Assets
```bash
npm run build
# or for development
npm run dev
```
6. Run Server
```bash
php artisan serve
```

---

