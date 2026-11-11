# Car Rental System - DBMS Mini Project

Question: 17  
Database: carrental_db

## Files
- db.php: Connects PHP to MySQL.
- rental.php: Displays the rental form and inserts a rental record.
- report.php: Displays rental details using INNER JOIN.
- carrental_db.sql: Creates the database, tables and sample records.

## How to run
1. Start Apache and MySQL in XAMPP.
2. Open phpMyAdmin and import carrental_db.sql.
3. Copy the car_rental_project folder into C:/xampp/htdocs/.
4. Open http://localhost/car_rental_project/rental.php.

The form reads customers and cars from their tables. When submitted, PHP inserts the selected customer, car and dates into the rental table. The report page joins all three tables to display the rental details.
