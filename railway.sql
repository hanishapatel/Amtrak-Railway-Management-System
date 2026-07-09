-- =====================================================================
--  Amtrak Railway Management System — database schema + sample data
--  Reconstructed from the application's SQL queries (no original dump
--  was available). Import with either:
--     mysql -u root < railway.sql
--  or phpMyAdmin  ▸  Import ▸ choose this file.
--
--  Connection settings expected by connection.php:
--     host = localhost, user = root, password = "" , database = railway
--
--  Sample size: 6 stations · 6 routes · 8 trains · 8 schedules
--               5 employees · 10 passengers · 16 bookings
--               (9 of 10 passengers have >=1 booking; only 'ava' has none)
--
--  NOTE: passwords are stored in plain text because the existing app
--  (login.php) compares them directly. This matches the current system;
--  it is NOT secure for production.
-- =====================================================================

CREATE DATABASE IF NOT EXISTS railway
  CHARACTER SET utf8 COLLATE utf8_general_ci;
USE railway;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS Reservation;
DROP TABLE IF EXISTS Ticket;
DROP TABLE IF EXISTS Schedule;
DROP TABLE IF EXISTS Train;
DROP TABLE IF EXISTS Route;
DROP TABLE IF EXISTS Station;
DROP TABLE IF EXISTS Passenger;
DROP TABLE IF EXISTS Employee;
SET FOREIGN_KEY_CHECKS = 1;

-- ---------------------------------------------------------------------
-- Reference / master tables
-- ---------------------------------------------------------------------
CREATE TABLE Station (
    station_id    INT AUTO_INCREMENT PRIMARY KEY,
    station_name  VARCHAR(120) NOT NULL,
    city          VARCHAR(80),
    state         VARCHAR(40),
    address       VARCHAR(200)
) ENGINE=InnoDB;

-- origin_station / destination_station hold the station NAME strings,
-- because fetch_stations.php submits station_name and fetch_trains.php
-- matches routes on those names.
CREATE TABLE Route (
    route_id            INT AUTO_INCREMENT PRIMARY KEY,
    route_name          VARCHAR(120) NOT NULL,
    origin_station      VARCHAR(120) NOT NULL,
    destination_station VARCHAR(120) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE Train (
    train_id    INT AUTO_INCREMENT PRIMARY KEY,
    train_name  VARCHAR(120) NOT NULL,
    capacity    INT NOT NULL,
    status      VARCHAR(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB;

CREATE TABLE Schedule (
    schedule_id     INT AUTO_INCREMENT PRIMARY KEY,
    train_id        INT,
    route_id        INT,
    departure_time  TIME,
    arrival_time    TIME,
    day_of_week     VARCHAR(15),
    CONSTRAINT fk_sched_train FOREIGN KEY (train_id) REFERENCES Train(train_id),
    CONSTRAINT fk_sched_route FOREIGN KEY (route_id) REFERENCES Route(route_id)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Users
-- ---------------------------------------------------------------------
CREATE TABLE Passenger (
    passenger_id   INT AUTO_INCREMENT PRIMARY KEY,
    passenger_name VARCHAR(120),
    email          VARCHAR(120),
    address        VARCHAR(200),
    phone_number   VARCHAR(30),
    username       VARCHAR(60) NOT NULL UNIQUE,
    password       VARCHAR(120) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE Employee (
    employee_id    INT AUTO_INCREMENT PRIMARY KEY,
    employee_name  VARCHAR(120),
    email          VARCHAR(120),
    address        VARCHAR(200),
    phone_number   VARCHAR(30),
    role           VARCHAR(60),
    username       VARCHAR(60) NOT NULL UNIQUE,
    password       VARCHAR(120) NOT NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Bookings
-- ---------------------------------------------------------------------
CREATE TABLE Ticket (
    ticket_id         INT AUTO_INCREMENT PRIMARY KEY,
    passenger_id      INT,
    train_id          INT,
    departure_station VARCHAR(120),
    arrival_station   VARCHAR(120),
    departure_date    DATE,
    arrival_date      DATE,
    ticket_type       VARCHAR(30),
    price             DECIMAL(10,2),
    CONSTRAINT fk_ticket_passenger FOREIGN KEY (passenger_id) REFERENCES Passenger(passenger_id),
    CONSTRAINT fk_ticket_train     FOREIGN KEY (train_id)     REFERENCES Train(train_id)
) ENGINE=InnoDB;

CREATE TABLE Reservation (
    reservation_id   INT AUTO_INCREMENT PRIMARY KEY,
    ticket_id        INT,
    passenger_id     INT,
    seat_number      VARCHAR(20),
    special_requests VARCHAR(120),
    CONSTRAINT fk_res_ticket    FOREIGN KEY (ticket_id)    REFERENCES Ticket(ticket_id),
    CONSTRAINT fk_res_passenger FOREIGN KEY (passenger_id) REFERENCES Passenger(passenger_id)
) ENGINE=InnoDB;

-- =====================================================================
--  Sample data (Northeast Corridor)
-- =====================================================================

-- 6 stations
INSERT INTO Station (station_name, city, state, address) VALUES
    ('New York Penn Station',      'New York',     'NY', '351 W 31st St'),
    ('Washington Union Station',   'Washington',   'DC', '50 Massachusetts Ave NE'),
    ('Boston South Station',       'Boston',       'MA', '700 Atlantic Ave'),
    ('Philadelphia 30th Street',   'Philadelphia', 'PA', '2955 Market St'),
    ('Baltimore Penn Station',     'Baltimore',    'MD', '1500 N Charles St'),
    ('Providence Station',         'Providence',   'RI', '100 Gaspee St');

-- 6 routes — every station is used as an origin or destination
INSERT INTO Route (route_name, origin_station, destination_station) VALUES
    ('Acela Northeast',          'New York Penn Station',  'Washington Union Station'),
    ('Northeast Regional South', 'Boston South Station',   'Washington Union Station'),
    ('Keystone Service',         'New York Penn Station',  'Philadelphia 30th Street'),
    ('Empire Corridor',          'New York Penn Station',  'Boston South Station'),
    ('Palmetto Line',            'Baltimore Penn Station', 'Washington Union Station'),
    ('Shore Line',               'Providence Station',     'New York Penn Station');

-- 8 trains
INSERT INTO Train (train_name, capacity, status) VALUES
    ('Acela Express 2151',      220, 'Active'),
    ('Northeast Regional 171',  250, 'Active'),
    ('Keystone 645',            200, 'Active'),
    ('Palmetto 89',             180, 'Active'),
    ('Empire Service 234',      240, 'Active'),
    ('Silver Star 91',          250, 'Active'),
    ('Shore Line 490',          210, 'Active'),
    ('Vermonter 55',            190, 'Active');

-- 8 schedules — every route has at least one train; routes 1 and 4 have two.
INSERT INTO Schedule (train_id, route_id, departure_time, arrival_time, day_of_week) VALUES
    (1, 1, '06:00:00', '09:35:00', 'Monday'),
    (2, 2, '08:20:00', '13:05:00', 'Monday'),
    (3, 3, '07:15:00', '08:45:00', 'Tuesday'),
    (4, 1, '14:15:00', '18:40:00', 'Wednesday'),
    (5, 4, '09:00:00', '13:20:00', 'Friday'),
    (6, 5, '10:30:00', '11:15:00', 'Tuesday'),
    (7, 6, '16:45:00', '20:05:00', 'Thursday'),
    (8, 4, '12:00:00', '16:10:00', 'Saturday');

-- 5 employees. login.php grants the full employee dashboard only to
-- 'charlie' and 'grace'; any other employee lands on edit_employees_only.php.
INSERT INTO Employee (employee_name, email, address, phone_number, role, username, password) VALUES
    ('Charlie Reeves', 'charlie@amtrak.example', '10 Rail Ave, New York, NY',    '212-555-0101', 'Operations Manager',     'charlie', 'charlie123'),
    ('Grace Holloway', 'grace@amtrak.example',   '22 Union St, Washington, DC',  '202-555-0144', 'Station Manager',        'grace',   'grace123'),
    ('Daniel Ortiz',   'daniel@amtrak.example',  '5 Depot Rd, Boston, MA',       '617-555-0177', 'Ticket Clerk',           'daniel',  'daniel123'),
    ('Priya Nair',     'priya@amtrak.example',   '18 Market St, Philadelphia, PA','215-555-0190', 'Scheduling Coordinator', 'priya',   'priya123'),
    ('Marcus Lee',     'marcus@amtrak.example',  '9 Charles St, Baltimore, MD',  '410-555-0165', 'Maintenance Supervisor', 'marcus',  'marcus123');

-- 10 passengers
INSERT INTO Passenger (passenger_name, email, address, phone_number, username, password) VALUES
    ('John Carter',    'john@example.com',    '88 Elm St, New York, NY',       '917-555-0110', 'john',   'john123'),
    ('Maria Alvarez',  'maria@example.com',   '14 Oak Ave, Boston, MA',        '857-555-0132', 'maria',  'maria123'),
    ('David Kim',      'david@example.com',   '203 Pine St, Washington, DC',   '202-555-0121', 'david',  'david123'),
    ('Sophie Turner',  'sophie@example.com',  '47 Maple Dr, Philadelphia, PA', '267-555-0143', 'sophie', 'sophie123'),
    ('Liam Nguyen',    'liam@example.com',    '12 Cedar Ln, Providence, RI',   '401-555-0154', 'liam',   'liam123'),
    ('Emma Brooks',    'emma@example.com',    '66 Birch Rd, Baltimore, MD',    '443-555-0165', 'emma',   'emma123'),
    ('Noah Patel',     'noah@example.com',    '31 Spruce St, New York, NY',    '646-555-0176', 'noah',   'noah123'),
    ('Olivia Rossi',   'olivia@example.com',  '5 Walnut Ave, Boston, MA',      '617-555-0187', 'olivia', 'olivia123'),
    ('Ethan Clark',    'ethan@example.com',   '77 Chestnut St, Washington, DC','202-555-0198', 'ethan',  'ethan123'),
    ('Ava Morales',    'ava@example.com',     '9 Willow Way, Philadelphia, PA','215-555-0209', 'ava',    'ava123');

-- Bookings. Distribution: john & emma have 3; maria, sophie, noah have 2;
-- david, liam, olivia, ethan have 1; ava has none. Dates fall on each
-- train's scheduled day_of_week; prices follow the app (standard 25,
-- economy 30, business 40, first 50). ticket_id auto-increments 1..16
-- in the order below, which the reservations reference.
INSERT INTO Ticket (passenger_id, train_id, departure_station, arrival_station, departure_date, arrival_date, ticket_type, price) VALUES
    (1, 1, 'New York Penn Station',  'Washington Union Station', '2026-07-13', '2026-07-13', 'business', 40.00),  -- 1  john
    (1, 3, 'New York Penn Station',  'Philadelphia 30th Street', '2026-07-14', '2026-07-14', 'economy',  30.00),  -- 2  john
    (1, 5, 'New York Penn Station',  'Boston South Station',     '2026-07-17', '2026-07-17', 'first',    50.00),  -- 3  john
    (2, 2, 'Boston South Station',   'Washington Union Station', '2026-07-20', '2026-07-20', 'first',    50.00),  -- 4  maria
    (2, 8, 'New York Penn Station',  'Boston South Station',     '2026-07-18', '2026-07-18', 'standard', 25.00),  -- 5  maria
    (3, 1, 'New York Penn Station',  'Washington Union Station', '2026-07-27', '2026-07-27', 'economy',  30.00),  -- 6  david
    (4, 3, 'New York Penn Station',  'Philadelphia 30th Street', '2026-07-21', '2026-07-21', 'standard', 25.00),  -- 7  sophie
    (4, 7, 'Providence Station',     'New York Penn Station',    '2026-07-16', '2026-07-16', 'business', 40.00),  -- 8  sophie
    (5, 7, 'Providence Station',     'New York Penn Station',    '2026-07-09', '2026-07-09', 'economy',  30.00),  -- 9  liam
    (6, 6, 'Baltimore Penn Station', 'Washington Union Station', '2026-07-07', '2026-07-07', 'business', 40.00),  -- 10 emma
    (6, 4, 'New York Penn Station',  'Washington Union Station', '2026-07-15', '2026-07-15', 'first',    50.00),  -- 11 emma
    (6, 2, 'Boston South Station',   'Washington Union Station', '2026-07-13', '2026-07-13', 'standard', 25.00),  -- 12 emma
    (7, 5, 'New York Penn Station',  'Boston South Station',     '2026-07-10', '2026-07-10', 'business', 40.00),  -- 13 noah
    (7, 1, 'New York Penn Station',  'Washington Union Station', '2026-07-20', '2026-07-20', 'standard', 25.00),  -- 14 noah
    (8, 8, 'New York Penn Station',  'Boston South Station',     '2026-07-11', '2026-07-11', 'first',    50.00),  -- 15 olivia
    (9, 4, 'New York Penn Station',  'Washington Union Station', '2026-07-22', '2026-07-22', 'economy',  30.00);  -- 16 ethan

INSERT INTO Reservation (ticket_id, passenger_id, seat_number, special_requests) VALUES
    (1,  1, 'A(30)', 'none'),
    (2,  1, 'A(50)', 'vegetarian'),
    (3,  1, 'A(10)', 'extra-legroom'),
    (4,  2, 'A(0)',  'vegetarian'),
    (5,  2, 'A(60)', 'none'),
    (6,  3, 'A(31)', 'none'),
    (7,  4, 'A(51)', 'none'),
    (8,  4, 'A(40)', 'non-vegetarian'),
    (9,  5, 'A(41)', 'extra-legroom'),
    (10, 6, 'A(0)',  'none'),
    (11, 6, 'A(32)', 'vegetarian'),
    (12, 6, 'A(1)',  'none'),
    (13, 7, 'A(11)', 'extra-legroom'),
    (14, 7, 'A(33)', 'none'),
    (15, 8, 'A(61)', 'non-vegetarian'),
    (16, 9, 'A(34)', 'none');
