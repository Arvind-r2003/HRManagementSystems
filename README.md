# HR Management System

## Introduction

HR Management System is a web-based application that helps manage human resources efficiently. It provides features to manage employees, attendance, salary, leaves, and various other functionalities related to human resources.

## Features

- Employee Management: Add, edit, delete, and view employee details.
- Attendance Management: Mark attendance, and view attendance reports.
- Salary Management: Manage salary details, and generate payslips.
- Leave Management: Manage leave applications, and approve or reject leaves.
- Reporting: Generate various reports like employee lists, attendance reports, leave reports, etc.

1. **User Authentication**
    - User Registration
    - User login
    - Display a welcome message with the user's first and last name upon login

2. **Notifications Management**
    - Add new notifications
    - View all notifications
    - Mark notifications as read

3. **User Interface**
    - Custom login and registration pages
    - Sidebar navigation with links to various sections of the HRMS
    - Clock display in the header
    - Logout functionality

## Installation

1. Clone the repository: `git clone https://github.com/your-username/hrms.git`
2. Create a new database and import the `hrms.sql` file.
3. Update the database connection details in `db.php`.
4. Run the application by accessing the `index.php` file.

### Database Setup

1. Create a database named `hrms`.
2. Create the `hr_user` table with the following structure:
    ```sql
    CREATE TABLE `hr_user` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `username` VARCHAR(50) NOT NULL UNIQUE,
        `password` VARCHAR(255) NOT NULL,
        `first_name` VARCHAR(50) NOT NULL,
        `last_name` VARCHAR(50) NOT NULL
    );
    ```
3. Populate the `hr_user` table with sample data:
    ```sql
    INSERT INTO `hr_user` (`username`, `password`, `first_name`, `last_name`)
    VALUES
    ('john.doe', 'password123', 'John', 'Doe'),
    ('jane.smith', 'password123', 'Jane', 'Smith'),
    ('ram.kumar', 'password123', 'Ram', 'Kumar'),
    ('anita.sharma', 'password123', 'Anita', 'Sharma');

### Instructions

1. Clone the repository to your local machine.
2. Configure the database connection in `includes/db.php`:
    ```php
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hrms";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>
    ```
3. Start the Apache server using XAMPP or any other method.
4. Navigate to `http://localhost/hrms/login.php` to access the login page.

## Pages and Functionalities

### Login Page (`login.php`)

- Users can log in with their username and password.
- On successful login, the user is redirected to the dashboard (`index.php`).
- Displays a welcome message with the user's first and last name on the header of the dashboard.

### Registration Page (`register.php`)

- Users can register by providing their username, password, first name, and last name.
- On successful registration, the user is redirected to the login page.

### Dashboard (`index.php`)

- Displays the overall portal and features in one page.
- Displays a welcome message with the user's first and last name.
- Includes a sidebar with navigation links.
- Shows a real-time 12-hour clock with AM/PM.

### Notifications Page (`notifications.php`)

- Displays all notifications.
- Users can mark notifications as read.

### Add Notification Page (`add-notification.php`)

- Users can add new notifications.

### Logout Page (`logout.php`)

- Logs out the user and displays a message "You have been logged out."
- Provides a hyperlink to redirect to the login page and a timer that redirects after 10 seconds if not clicked.


## Contributing

Contributions are welcome. If you find any issues or have suggestions for improvements, please open an issue or create a pull request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.
