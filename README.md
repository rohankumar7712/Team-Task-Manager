# TaskFlow 🚀

Manage your team's tasks with ease. TaskFlow is a powerful, modern task management system designed for high-velocity teams who demand clarity and efficiency in their digital workspace.

![TaskFlow Preview](https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg)

## ✨ Features

- **📊 Comprehensive Dashboard**: Get a bird's-eye view of all your projects and tasks in one place.
- **📁 Project Management**: Organize work into distinct projects with dedicated owners and team members.
- **✅ Task Tracking**: Create, assign, and track tasks with status updates, priority levels, and due dates.
- **👥 Team Collaboration**: Manage your team members and their roles within projects seamlessly.
- **🔐 Secure Authentication**: Built-in user registration and login system powered by Laravel Breeze.
- **🔌 REST API Support**: Integrate with other tools using the built-in API for projects and tasks.
- **📱 Responsive Design**: A beautiful, modern interface built with Tailwind CSS that works on all devices.

## 🛠️ Tech Stack

- **Backend**: [Laravel 12.x](https://laravel.com/) (PHP 8.2+)
- **Frontend**: [Tailwind CSS](https://tailwindcss.com/), [Alpine.js](https://alpinejs.dev/), Blade Templates
- **Authentication**: [Laravel Breeze](https://laravel.com/docs/breeze) & [Sanctum](https://laravel.com/docs/sanctum)
- **Build Tool**: [Vite](https://vitejs.dev/)
- **Database**: Supports MySQL, PostgreSQL, SQLite, and SQL Server.

## 🚀 Getting Started

Follow these steps to get the project up and running on your local machine.

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- SQLite (or any other supported database)

### Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/rohankumar7712/Team-Task-Manager.git
   cd Team-Task-Manager
   ```

2. **Install PHP dependencies**:
   ```bash
   composer install
   ```

3. **Install NPM dependencies**:
   ```bash
   npm install
   ```

4. **Environment setup**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**:
   For SQLite (default):
   ```bash
   touch database/database.sqlite
   php artisan migrate
   ```

6. **Build assets**:
   ```bash
   npm run build
   ```

7. **Run the development server**:
   ```bash
   php artisan serve
   ```

Your application should now be running at `http://localhost:8000`.

## 📡 API Documentation

TaskFlow provides a basic REST API for external integrations. All API routes require Sanctum authentication.

### Endpoints

| Method | Endpoint | Description |
| --- | --- | --- |
| `GET` | `/api/projects` | List all projects |
| `GET` | `/api/projects/{id}` | Get project details |
| `GET` | `/api/tasks` | List all tasks |
| `GET` | `/api/tasks/{id}` | Get task details |
| `GET` | `/api/user` | Get authenticated user info |

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---
Built with ❤️ using [Laravel](https://laravel.com).
