🏋️ Gym Management System
A modern Gym Management System built as a full-stack web application to simplify day-to-day gym administration. The system provides a centralized platform for managing members, trainers, attendance, membership plans, and payment records through a secure authentication system and an intuitive dashboard.
This project was developed for academic and portfolio purposes to demonstrate full-stack web development skills, database management, authentication, and CRUD operations.

📌 Features
🔐 Authentication
Secure Admin Login
Session-based authentication
Protected dashboard access
Logout functionality
👥 Member Management
Add new members
Update member details
Delete member records
View all registered members
Search and filter members
💪 Trainer Management
Add trainers
Update trainer information
Remove trainers
View trainer details
📅 Attendance Management
Mark attendance
View attendance records
Track member attendance history
📋 Membership Plans
Create membership plans
Edit plans
Delete plans
View available plans
💳 Payment Management
Record fee payments
Track payment history
View payment status
Maintain payment records
📊 Dashboard
Centralized admin panel
Quick navigation
Organized management interface
Easy access to all modules
📱 Responsive Design
Mobile-friendly layout
Tablet compatible
Desktop optimized
Clean and intuitive UI

🛠️ Technology Stack
Frontend
HTML5
CSS3
JavaScript
Bootstrap
Backend
PHP
Database
MySQL
Hosting
InfinityFree

📂 Project Structure
Gym-Management-System/
│
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
│
├── admin/
│
├── database/
│
├── includes/
│
├── pages/
│
├── index.php
├── login.php
├── dashboard.php
└── README.md

🚀 Live Demo
Website
https://vyomra.infinityfreeapp.com
Demo Credentials
Username:
admin
Password:
admin123
This is a demonstration account created for portfolio evaluation.

⚙️ Installation
Clone the Repository

git clone https://github.com/ajit0109/vyomrafitness.git
Move Project
Copy the project folder into your local server's root directory:

XAMPP: xampp/htdocs/


Import Database

Open phpMyAdmin in your browser (usually http://localhost/phpmyadmin).

Create a new database named gym.

Click on the Import tab and upload the .sql file located in the /database folder of this project.

Configure Database
Update your database credentials inside your configuration file (e.g., includes/db.php or whichever file handles your connection):

PHP
$host = "localhost";
$user = "root";
$password = ""; // Use your MySQL password if you have one set
$database = "gym";
Run the Project

Ensure Apache and MySQL are running in your XAMPP/WAMP Control Panel.

Open your browser and visit: http://localhost/vyomrafitness

📸 Screenshots
### 📸 Project Screenshots
For a quick visual overview of the system’s interface and features, please check the **/Screenshots** folder in this repository. 


🎯 Learning Outcomes
This project demonstrates:
Full-stack web development
Authentication implementation
CRUD operations
MySQL database integration
Responsive web design
Admin dashboard development
Session management
Form validation
Data management
Deployment on a live hosting platform

🔮 Future Improvements
Member login portal
QR code attendance
Email notifications
Online payment gateway
Trainer schedules
Workout tracking
Diet plan management
Analytics dashboard
Reports generation
Multi-admin support

🤖 AI Assistance
AI tools were used during development to assist with debugging, code optimization, problem-solving, and implementation guidance. All features were integrated, tested, and customized as part of the development process.

📄 License
This project is released for educational and portfolio purposes.
Feel free to fork, learn from, and improve the project.

👨‍💻 Author
Developed by Ajit Rathod
Portfolio Project • Full-Stack Web Development
