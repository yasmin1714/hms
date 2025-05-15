# 🏥 Hospital Management System (HMS)

A web-based Hospital Management System developed using **PHP**, **MySQL**, **JavaScript**, and **CSS** to streamline hospital operations such as appointments, billing, medical records, and user management for patients, doctors, nurses, and administrators.

---

## 📌 Features

- 🩺 **Role-based Dashboards**: Separate views and actions for Admin, Doctor, Nurse, and Patient.
- 📅 **Appointment Management**: Real-time booking, cancellation, and reminders.
- 🧾 **Billing System**: Automated bill generation, tracking, and online payment simulation.
- 📂 **Medical History & Lab Reports**: View, update, and manage reports securely.
- 💊 **Pharmacy & Inventory**: Manage medicines, quantities, expiry, and stock alerts.
- 🔐 **User Authentication**: Secure login, session management, and role-based access control.
- 🧪 **Surgery & Insurance Module**: Track surgeries and maintain patient insurance records.
- 📊 **Reports & Logs**: Admin can generate patient summaries, user logs, and more.

---

## 🛠️ Tech Stack

| Technology | Purpose |
|------------|---------|
| **PHP** | Backend scripting |
| **MySQL** | Relational Database |
| **HTML/CSS/SCSS** | Frontend design and styling |
| **JavaScript** | Client-side interactivity |
| **Bootstrap** | Responsive UI |
| **PhpMyAdmin/XAMPP** | Local hosting and DB management |

---

## 📂 Modules

1. **User Authentication** – Sign up, log in, session control
2. **Doctor & Patient Profiles** – CRUD operations and secure profile management
3. **Appointment Scheduler** – Book/Cancel/Reschedule slots
4. **Medical Records** – Diagnosis, history, lab reports
5. **Billing & Payment** – Auto-generated invoices
6. **Surgery Management** – Upcoming and past surgery tracking
7. **Pharmacy Management** – Stock management and alerts
8. **Insurance** – Policy details and validity tracking
9. **Admin Panel** – Control over all modules with logs
10. **Reports Generator** – PDF summary (optional) for analytics

---

## 🔐 Security Features

- Role-based access control (RBAC)
- Passwords hashed (using `md5()` or `password_hash()`)
- Session timeout management
- Input validation and sanitization

---

## 📦 Installation Guide

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/hms-project.git

2. **Import the SQL Database**

- Open PhpMyAdmin
- Create a database named hms
- Import the hms.sql file 

3. **Start XAMPP/WAMP**

- Start Apache and MySQL

4. **Open the project**
    ```bash
    http://localhost/hospital_management_sys/hospital/index.php

---

## 🧪 Testing

- Unit testing for each module
- Integration testing between patient-doctor and billing modules
- Functional and security tests for all login sessions

---

## 📄 License
This project is created for academic purposes under IGNOU BCSP-064. 

---

## 👤 Author
- **Name**: D.Yasmin
- **Email**: yasminddg@gmail.com
- **University**: IGNOU
- **Project Code**: BCSP-064
