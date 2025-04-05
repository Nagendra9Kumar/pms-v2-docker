<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Management System</title>

    <!-- Include Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            overflow-x: hidden; /* Prevent horizontal scroll */
        }

        .header {
            background-color: #2d3b55;
            color: white;
            padding: 20px;
            text-align: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1001;
            box-sizing: border-box;
        }

        .header h1 {
            margin: 0;
            font-size: 2rem; /* Larger font size */
        }

        .container {
            padding: 20px;
            margin-top: 100px; /* Offset for fixed header */
            transition: margin-left 0.3s ease;
        }

        .content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #2d3b55;
            color: white;
        }

        /* Sidebar Navigation */
        .navi {
            position: fixed;
            top: 60px; /* Below header */
            left: 0;
            width: 250px; /* Sidebar width */
            height: calc(100% - 60px); /* Full height minus header */
            background-color: #2d3b55; /* Darker background */
            padding-top: 20px;
            transform: translateX(-250px); /* Initially hidden */
            transition: transform 0.3s ease-in-out;
            z-index: 1000;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
        }

        .navi a {
            text-decoration: none;
            color: white;
        }

        .navi button {
            background-color: #34495e; /* Button background */
            border: none;
            color: white;
            padding: 15px 20px;
            text-align: left;
            width: 100%;
            cursor: pointer;
            display: block;
            transition: background-color 0.3s ease, padding-left 0.3s ease;
            font-size: 16px; /* Larger font size */
            border-radius: 5px;
            margin-bottom: 5px;
            position: relative;
            overflow: hidden;
        }

        .navi button.active, .navi button:hover {
            background-color: #1abc9c; /* Highlight color */
        }

        .navi button.active::after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 5px;
            height: 100%;
            background-color: #1abc9c; /* Active indicator */
        }

        .navi button:hover {
            padding-left: 25px; /* Indentation on hover */
        }

        /* Hamburger Menu for Small Screens */
        .hamburger {
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 35px;
            height: 35px;
            cursor: pointer;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1002;
        }

        .hamburger div {
            width: 30px;
            height: 4px;
            background-color: white;
            margin: 5px 0;
            border-radius: 2px;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .hamburger {
                display: flex;
            }

            .navi {
                top: 60px; /* Align with header */
                height: calc(100% - 60px); /* Adjust height */
                transform: translateX(-250px); /* Initially hidden */
            }

            .container {
                margin-left: 0;
            }

            .navi.active {
                transform: translateX(0); /* Show sidebar */
            }

            .navi button {
                font-size: 14px;
                padding: 12px;
                margin-bottom: 8px; /* Space between buttons */
            }

            .header {
                padding: 15px;
            }

            .header h1 {
                font-size: 1.5rem; /* Adjusted font size */
            }

            .content {
                overflow-x: auto;
            }

            table {
                min-width: 600px; /* Prevent table from shrinking too much */
            }
        }

        @media (min-width: 768px) {
            .navi {
                transform: translateX(0); /* Always visible on large screens */
            }

            .hamburger {
                display: none;
            }

            .container {
                margin-left: 250px; /* Space for sidebar */
            }

            .header {
                padding: 20px;
            }

            .header h1 {
                font-size: 2rem; /* Default font size */
            }
        }

        /* Style for delete icon */
        .fas.fa-trash {
            font-size: 18px;
            cursor: pointer;
            color: red;
            transition: color 0.3s ease;
        }

        .fas.fa-trash:hover {
            color: darkred;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header">
        <h1>Payroll Management System</h1>
    </div>

    <!-- Hamburger Menu Icon -->
    <div class="hamburger" onclick="toggleMenu()">
        <div></div>
        <div></div>
        <div></div>
    </div>

    <!-- Sidebar Navigation -->
    <div class="navi" id="navMenu">
        <a href="emp_home.php"><button class="<?= $activePage === 'home' ? 'active' : '' ?>">Home</button></a>
        <a href="emp_list.php"><button class="active <?= $activePage === 'list' ? 'active' : '' ?>">Employee List</button></a>
        <a href="class.php"><button class="<?= $activePage === 'class' ? 'active' : '' ?>">Class</button></a>
        <a href="salary.php"><button class="<?= $activePage === 'salary' ? 'active' : '' ?>">Salary</button></a>
        <a href="salary_report.php"><button class="<?= $activePage === 'report' ? 'active' : '' ?>">Salary Report</button></a>
        <a href="logout.php"><button class="<?= $activePage === 'logout' ? 'active' : '' ?>">Logout</button></a>
    </div>

    <!-- Content Container -->
    <div class="container" id="contentContainer">
        <div class="content">
            <h2>Employees List</h2>
            <!-- PHP for table content -->
            <?php
            include 'db_connect.php';

            // SQL query to exclude admin with empid 'admin'
            $sql = "SELECT first_name, last_name, gender, empid, department, address 
                    FROM rdata 
                    WHERE empid != 'admin'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table><thead><tr><th>Sl.No</th><th>Name</th><th>Gender</th><th>Empid</th><th>Department</th><th>Address</th><th>Action</th></tr></thead><tbody>";
                $a = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $a . "</td><td>" . $row["first_name"] . " " . $row["last_name"] . "</td><td>" . $row["gender"] . "</td><td>" . $row["empid"] . "</td><td>" . $row["department"] . "</td><td>" . $row["address"] . "</td>
                    <td><a href='delete_employee.php?id=" . $row["empid"] . "' onclick=\"return confirm('Are you sure you want to delete this employee?');\" style='color: red;'><i class='fas fa-trash'></i></a></td></tr>";
                    $a++;
                }
                echo "</tbody></table>";
            } else {
                echo "<p>No employees found.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>

    <!-- Script to Toggle Menu -->
    <script>
        function toggleMenu() {
            var navMenu = document.getElementById('navMenu');
            navMenu.classList.toggle('active');
        }
    </script>

</body>

</html>
