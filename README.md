# Follow-up of Diabetic Patients (Backend)

Repository: https://github.com/MohammedAkramQudaih/My-Graduation-Project

## About
This repository contains the backend (Laravel) for **Follow-up of Diabetic Patients** — a healthcare platform that connects diabetic patients with doctors. It provides a web-based Admin dashboard for managing doctors, patients, and admins, along with a REST API consumed by a mobile application for patient/doctor interactions: appointments, blood sugar measurements, medical biographies, work hours, and doctor reviews.

## ✨ **Backend Features**

### 🔐 **Authentication & Authorization**
- ✅ Web authentication for the Admin dashboard (Laravel's built-in auth scaffolding)
- ✅ API token authentication for Doctors & Patients using Laravel Sanctum
- ✅ Role-based access control (Admin, Doctor, Patient)
- ✅ Custom `RoleMiddleware` restricting dashboard routes to Admins only
- ✅ CSRF protection for all web forms
- ✅ Password reset flow via email (send link + reset with token)

### 👨‍💼 **Admin Panel Modules**
- **Admins Management** — Full CRUD, soft delete & restore
- **Doctors Management** — CRUD, soft delete & restore, image upload, open/closed status
- **Patients Management** — CRUD, soft delete & restore, image upload
- **Doctor Work Hours** — view weekly schedules per doctor
- **Patient Biographies** — view diagnostics & medications written by doctors
- **Appointments** — view bookings per doctor/patient with status (pending / confirmed / cancelled)
- **Attachments** — view/download patient-uploaded medical files
- **Reviews** — view doctor visit reviews per doctor/patient
- **Dashboard Overview** — users, admins, doctors, and patients counters

### 🌐 **RESTful APIs**
- Sanctum-protected endpoints for Doctor & Patient mobile clients
- Consistent JSON response structure across all endpoints (`code`, `message`, `data`)
- Patient self-registration & login
- Doctor login (accounts are provisioned by the Admin, not self-registered)
- Full appointment lifecycle: booking, listing, status updates
- Blood sugar measurement logging (fasting / post-meal / random readings)
- Doctor work-hours management (add / edit / delete, with overlap validation)
- Doctor & patient search endpoints
- Doctor rating system
- Patient attachment upload/delete

### 🗄️ **Database Design**
- Relational schema with one-to-many and many-to-many relationships (`doctor_patient` pivot table)
- Migrations for full version control of the schema
- Soft deletes across core tables (`users`, `doctors`, `patients`, `appointments`, etc.) for safe restore
- Foreign key constraints for data integrity
- Seeder for a default Admin account

### 📁 **File Handling**
- Image upload for Doctor and Patient profiles (stored under `public/adminimages`)
- Patient attachment upload (stored under `public/api/patient/attachments`)
- File type and size validation on all uploads

### ✅ **Validation & Error Handling**
- Form request validation with custom rules per module
- Consistent JSON error/success responses on the API, with descriptive `code` values (200, 400, 403, 404, 409...)
- Unique-field validation across `users` and `patients` tables (e.g. email)
- Duplicate work-hours prevention (day/start/end overlap check)
- Confirmation prompts before destructive actions in the dashboard

## Requirements
- PHP >= 8.0 (check `composer.json` for exact compatibility)
- Composer
- MySQL / MariaDB
- Node.js + npm (for compiling frontend assets)
- Git (for cloning)

## Quick Setup (local)

1. Clone the repository
```sh
git clone https://github.com/MohammedAkramQudaih/My-Graduation-Project.git
cd My-Graduation-Project
```

2. Copy the example environment file
- On Git Bash / WSL:
```sh
cp .env.example .env
```
- On Windows CMD:
```bat
copy .env.example .env
```

3. Create a database (example name: `diabetes`) using your preferred tool (phpMyAdmin, MySQL Workbench, or CLI).

4. Edit `.env` and set your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=graduation-project
DB_USERNAME=root
DB_PASSWORD=your_password
```

5. Install PHP dependencies
```sh
composer install
```

6. Install JS dependencies and build assets
```sh
npm install
npm run dev
```

7. Generate the application key
```sh
php artisan key:generate
```

8. Run migrations and seeders
```sh
php artisan migrate:fresh --seed
```

9. Serve the application
```sh
php artisan serve
```

10. Visit http://localhost:8000

## Default seeded accounts
After running the seeders, a default admin account is created:
- Email: `admin@example.com`
- Password: `password`

> ⚠️ Change this password immediately after your first login (Admin → Edit Profile), especially before deploying to production.

## 📡 API Reference

Base URL: `http://localhost:8000/api`

All authenticated endpoints require a Sanctum Bearer token obtained from the corresponding login endpoint, sent via the `Authorization: Bearer {token}` header.

### 🔑 Auth

| Method | Endpoint | Description | Auth |
|---|---|---|---|
| POST | `/patient/register` | Register a new patient account | ❌ |
| POST | `/patient/login` | Log in as a patient, returns a Sanctum token | ❌ |
| POST | `/doctor/login` | Log in as a doctor, returns a Sanctum token | ❌ |
| GET | `/logout` | Revoke the current access token | ✅ |
| POST | `/forgetPassword` | Send a password reset link to the given email | ❌ |
| POST | `/resetPassword` | Reset password using the emailed token | ❌ |

### 🧑‍🦱 Patient

| Method | Endpoint | Description | Auth |
|---|---|---|---|
| GET | `/patient/profile` | Get the authenticated patient's full profile | ✅ |
| POST | `/patient/updateProfile` | Update patient profile info / image | ✅ |
| POST | `/patient/storeAttachments` | Upload a medical attachment | ✅ |
| POST | `/patient/deleteAttachments/{attachment}` | Delete a medical attachment | ✅ |
| GET | `/patient/patientBiographies` | List the patient's medical biographies | ✅ |
| GET | `/patient/doctors` | List all doctors, ordered by rating | ✅ |
| GET | `/patient/searchDoctors` | Search doctors by name (`?query=`) | ✅ |
| GET | `/patient/doctorProfile/{doctor}` | Get a specific doctor's profile & work hours | ✅ |
| POST | `/patient/ratingDoctor/{doctor}` | Rate a linked doctor | ✅ |
| POST | `/patient/appointmentBooking/{doctor}` | Book an appointment with a doctor | ✅ |
| GET | `/patient/showAppointments` | List the patient's appointments | ✅ |
| POST | `/patient/storeMeasurement` | Log a blood sugar measurement | ✅ |
| GET | `/patient/showMeasurements` | List the patient's blood sugar measurements | ✅ |

### 🩺 Doctor

| Method | Endpoint | Description | Auth |
|---|---|---|---|
| GET | `/doctor/profile` | Get the authenticated doctor's profile & work hours | ✅ |
| GET | `/doctor/showAllBookedAppointments` | List all appointments booked with this doctor | ✅ |
| POST | `/doctor/updateAppointment/{appointment}` | Update an appointment's status | ✅ |
| GET | `/doctor/allPatients` | List all patients linked to this doctor | ✅ |
| GET | `/doctor/searchPatients` | Search linked patients by name (`?query=`) | ✅ |
| GET | `/doctor/patientProfile/{patient}` | Get a linked patient's full profile | ✅ |
| POST | `/doctor/addPatientBiography/{patient}` | Add diagnostics & medications for a patient | ✅ |
| POST | `/doctor/addReview/{patient}` | Add a visit review for a patient | ✅ |
| POST | `/doctor/addWorkHours` | Add a new work-hours slot | ✅ |
| POST | `/doctor/editWorkHours/{workHour}` | Edit an existing work-hours slot | ✅ |
| POST | `/doctor/deleteWorkHours/{workHour}` | Delete a work-hours slot | ✅ |

## 🗄 Database Schema Overview

| Table | Description |
|---|---|
| `users` | Core authentication table (admin / doctor / patient), soft-deletable |
| `patients` | Patient profile data (linked to `users`) |
| `doctors` | Doctor profile data (linked to `users`) |
| `appointments` | Appointment bookings between patients and doctors |
| `work_hours` | Doctor's weekly working hours |
| `measurements` | Patient blood sugar readings (fasting, post-meal, random) |
| `patient_biographies` | Diagnostics and medications written by doctors |
| `attachments` | Patient-uploaded medical files |
| `reviews` | Doctor visit records/reviews |
| `doctor_patient` | Pivot table linking confirmed doctor-patient relationships |

## 🚀 Future Improvements
- Sanctum authentication for the Admin dashboard as well (API-first admin)
- Automated unit & feature tests
- Docker support
- CI/CD pipeline
- Push notifications for appointment status changes

## 💼 Ready for Submission

This project is structured to meet evaluation criteria including:

- Clean architecture
- Proper separation of concerns (Admin vs API controllers)
- API usage with consistent JSON responses
- Validation handling
- Maintainable code structure