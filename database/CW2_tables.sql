-- Insert Data into the Sessions Table
INSERT INTO Sessions (session_id, session_day, session_start_time, session_end_time, session_type, floor, price)
VALUES
(1, 'Sunday', '11:00:00', '19:00:00', 'Free', 1, 1000.00),
(2, 'Sunday', '11:00:00', '19:00:00', 'Free', 2, 500.00),
(3, 'Saturday', '11:00:00', '19:00:00', 'Free', 1, 1000.00),
(4, 'Friday', '19:00:00', '22:00:00', 'Special', 2, 1000.00);

-- Insert Data into the Staff Table
INSERT INTO Staff (staff_name, session_id, role)
VALUES
('Sujal Bohara', 1, 'Cafe'),
('Rajesh Hamal', 1, 'Maintenance'),
('Rooz Ojha', 1, 'Counter'),
('Rashi Timsina', 2, 'Counter'),
('Jack Jones', 2, 'Maintenance');

-- Insert Data into the Customers Table
INSERT INTO Customers (first_name, surname, address, member_type, membership_fee, join_date, date_of_birth)
VALUES
('Saroj', 'Upadhyay', 'Dillibazar, Kathmandu', 'Standard', 1000.00, '2023-09-01', '1998-02-01'),
('Neha', 'Kakkar', 'Putalisadak, Kathmandu', 'Premium', 14000.00, '2023-06-05', '2000-10-15'),
('Himani', 'Puri', 'Baneshwor, Kathmandu', 'Premium', 14000.00, '2023-02-29', '2001-07-20'),
('Ritesh', 'Gurung', 'Gaushala, Kathmandu', 'Standard', 1000.00, '2023-04-05', '1983-05-03');

-- Insert Data into the Booking Table
INSERT INTO Booking (session_id, customer_id, booking_date, member_status, fee, pre_paid)
VALUES
(1, 1, '2023-10-21', 'Y', NULL, NULL),
(1, 2, '2023-10-21', 'N', 1000.00, 'N'),
(1, 3, '2023-10-21', 'Y', 900.00, 'Y'),
(1, 4, '2023-10-25', 'N', 1000.00, 'N'),
(2, 4, '2023-10-23', 'Y', 450.00, 'N');

-- Insert Data into the ArcadeMachines Table
INSERT INTO ArcadeMachines (machine_id, game_name, year, floor)
VALUES
(123, 'Mario', 2005, 1),
(78, 'Grand_Theft_Auto', 2013, 1),
(12, 'Pokemon', 2016, 2),
(45, 'PUBG_Battlegrounds', 2004, 1);

-- Insert Data into the Consoles Table
INSERT INTO Consoles (game_name, pegi_rating, console, quantity)
VALUES
('FIFA 18', 'PG', 'PS1', 3),
('FIFA 18', 'PG', 'PS2', 2),
('Horizon Zero Dawn', 'PG', 'PS4', 3),
('Horizon Zero Dawn', 'PG', 'PS2', 2),
('Legend of Zelda', 'PG', 'Nintendo Switch', 2),
('Halo 3', '15', 'Xbox 360', 4);

-- Insert Data into the SessionConsoles Table
INSERT INTO SessionConsoles (session_id, console_id, console_qty, session_date)
VALUES
(1, 1, 2, '2023-10-21'),
(1, 2, 2, '2023-10-21'),
(2, 3, 3, '2023-10-22'),
(2, 4, 2, '2023-10-22');
