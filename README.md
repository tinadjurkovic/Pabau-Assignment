# Employee Appreciation Voting System

This project is an Employee Appreciation Voting System, which allows employees to vote for their colleagues in pre-defined categories. The system monitors votes, it does not allow self-voting, and generates certificates to the winners. The code is divided into several parts: login, voting, results display and certificate generation.

## Prerequisites

To run and test the code on your local machine, ensure you have the following installed:

### 1. PHP

### 2. phpMyAdmin

### 3. XAMPP

#### Additionally, make sure you have a web browser to test the front-end interface.

## Setup Instructions

### 1. Clone the repository

Clone this repository to your local machine using the following command:

git clone https://github.com/tinadjurkovic/Pabau-Assignment.git

### 2. Setup Database

Open phpMyAdmin.
Create a new database: employee_voting.
Import the SQL file employee_voting.sql into the database.
Configure the database connection in config/database.php with your phpMyAdmin credentials.

### 3. Configure File Permissions

Ensure that the generate_certificate.php and other PHP files have appropriate read/write permissions on your server.

### 4. Start the Server

Place the project files in your web server's document root (e.g., htdocs for Apache).
Start your local server (Apache, Nginx, or PHP built-in server).
Access the project by navigating to:
http://localhost/Pabau-Assignment/index.php

## Testing the System

### Login:

Open index.php in your browser.
Enter your username and password (make sure you have an employee record in the database).

### Vote:

After logging in, you'll be redirected to the voting page where you can vote for your colleagues in different categories.
Your vote will be saved in the database.

### Generate Certificates:

After votes are tallied, you can click on voters and see the voters who voted the most often in descending order, or go to the winners.php page to view the winners.
Click the "Get Certificate" button to generate and download the certificate for the winner.

### Logout:

Click on the logout link to log out of the system and return to the login page.
