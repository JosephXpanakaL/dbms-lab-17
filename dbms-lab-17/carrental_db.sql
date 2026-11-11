CREATE DATABASE IF NOT EXISTS carrental_db;
USE carrental_db;

CREATE TABLE customer (
    customer_id INT PRIMARY KEY,
    name VARCHAR(50),
    licence_no VARCHAR(30),
    phone VARCHAR(15)
);

CREATE TABLE car (
    car_id INT PRIMARY KEY,
    model VARCHAR(50),
    reg_no VARCHAR(30),
    rent_per_day DECIMAL(10,2)
);

CREATE TABLE rental (
    rental_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    car_id INT,
    start_date DATE,
    end_date DATE,
    FOREIGN KEY (customer_id) REFERENCES customer(customer_id),
    FOREIGN KEY (car_id) REFERENCES car(car_id)
);

INSERT INTO customer VALUES
(1, 'Joseph', 'KL-DL-1001', '9876500001'),
(2, 'Anu', 'KL-DL-1002', '9876500002'),
(3, 'Rahul', 'KL-DL-1003', '9876500003'),
(4, 'Meera', 'KL-DL-1004', '9876500004'),
(5, 'Arun', 'KL-DL-1005', '9876500005');

INSERT INTO car VALUES
(1, 'Swift', 'KL-07-AB-1001', 1500.00),
(2, 'Baleno', 'KL-07-AB-1002', 1800.00),
(3, 'City', 'KL-07-AB-1003', 2500.00),
(4, 'Creta', 'KL-07-AB-1004', 3000.00),
(5, 'Innova', 'KL-07-AB-1005', 3500.00);
