# VAM

This project was developed during my third semester at university.

## Overview
This project is an online platform for managing and purchasing tickets for various modes of transportation, including buses, trains, and flights. Users can browse available trips as guests and, after registration, purchase multiple tickets at once. The system allows filtering trips based on departure and arrival stations and by transportation type.

## Features
- **User Management**: Registration, login, and profile modification (name, email, password)
- **Ticket Management**: Purchase tickets, view purchased tickets with total cost calculation
- **Trip Filtering**: Search for trips between specific stations or filter by transportation type
- **Admin Functionality**: Create, modify, and delete tickets
- **Statistics**: View summarized statistics instead of purchased tickets on the profile page
- **Error Handling**: Visual representation of errors for better user experience

## Database Schema
### Tables:
- **Users**: Stores user details (name, email, password, role)
- **Roles**: Defines roles (e.g., admin, buyer)
- **Stations**: Stores station details (ID, name, city)
- **Trips**: Stores trip details (ID, type, departure and arrival stations, date, time)
- **Tickets**: Stores ticket details (ID, trip ID, price, available quantity)
- **PurchasedTickets**: Stores user purchases (user email, trip ID, quantity)

## Technologies Used
- **Frontend**: HTML, CSS, JavaScript, Bootstrap 5.3
- **Backend**: PHP
- **Database**: MySQL
- **Development Tools**: XAMPP, phpMyAdmin, Visual Studio Code

## Installation and Setup
1. Install XAMPP and start Apache and MySQL
2. Import the provided SQL schema into phpMyAdmin
3. Place the project files in the XAMPP `htdocs` directory
4. Configure database credentials in `config.php`
5. Run the project by accessing `http://localhost/project_folder/` in the browser


