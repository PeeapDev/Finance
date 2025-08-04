# Finance - Acculance Financial Management System

A comprehensive Laravel + Vue.js financial management application with advanced features for business accounting, education management, and financial tracking.

## Features

- **Account Management**: Bank accounts, transactions, and balance tracking
- **Education Section**: School management with multi-step subscription forms
- **ID Card Management**: Student and staff ID card orders
- **Invoice System**: Automated invoicing with email notifications
- **Dashboard**: Modern responsive dashboard with financial insights

## Tech Stack

- **Backend**: Laravel 9+ with RESTful APIs
- **Frontend**: Vue.js 2.7.x SPA
- **Database**: SQLite (development)
- **Styling**: Bootstrap 4 with custom CSS
- **Authentication**: Laravel Sanctum

## Installation

1. Clone the repository
2. Install dependencies: `composer install && npm install`
3. Copy environment file: `cp .env.example .env`
4. Generate application key: `php artisan key:generate`
5. Run migrations: `php artisan migrate`
6. Build assets: `npm run dev`
7. Start server: `php artisan serve`

## Education Module

The Education section includes:
- Multi-step school subscription forms
- Student and staff management
- ID card order processing
- Automated invoice generation
- Email notifications for payments

## License

This project is proprietary software developed by PeeapDev.
