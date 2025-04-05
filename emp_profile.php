<?php include 'db_connect.php'; 
session_start();
if (!isset($_SESSION["login"])) {
    header("location: index.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Profile</title>
    <style>
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
    display: flex;
    align-items: center;
    justify-content: center; /* Center header text */
}

.header h1 {
    margin: 0;
    font-size: 2rem; /* Larger font size */
    font-weight: bold; /* Bold text for prominence */
}
        .menu-toggle {
    display: none;
    font-size: 24px;
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    position: absolute;
    left: 20px; /* Space from the left */
    z-index: 1002;
}

        .container {
            padding: 20px;
            margin-top: 60px; /* Offset for fixed header */
            margin-left: 250px; /* Space for sidebar */
            transition: margin-left 0.3s ease;
        }

        .content {
            background-color: white;
            padding: 20px;
            margin: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .content table th,
        .content table td {
            padding: 12px;
            text-align: left;
        }

        .content table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .content table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .navi {
            position: fixed;
            top: 60px;
            left: 0;
            width: 250px;
            height: calc(100% - 60px);
            background-color: #2d3b55;
            padding-top: 20px;
            transform: translateX(-250px);
            transition: transform 0.3s ease-in-out;
            z-index: 1000;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
        }

        .navi a {
            text-decoration: none;
        }

        .navi button {
            background-color: #34495e;
            border: none;
            color: white;
            padding: 15px 20px;
            text-align: left;
            width: 100%;
            cursor: pointer;
            display: block;
            transition: background-color 0.3s ease, padding-left 0.3s ease;
            font-size: 16px;
            border-radius: 5px;
            margin-bottom: 5px;
            position: relative;
        }

        .navi button.active,
        .navi button:hover {
            background-color: #1abc9c;
        }

        .navi button.active::after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 5px;
            height: 100%;
            background-color: #1abc9c;
        }

        .navi button:hover {
            padding-left: 25px;
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }

            .navi {
                transform: translateX(0);
                display: none;
            }

            .navi.show {
                display: flex;
            }

            .container {
                margin-left: 0;
            }

            .header {
                padding: 15px;
                position: fixed;
            }

            .header h1 {
                font-size: 1.5rem;
            }

            .content {
                overflow-x: auto;
            }

            table {
                min-width: 600px;
            }
        }

        @media (min-width: 768px) {
            .navi {
                transform: translateX(0);
            }

            .container {
                margin-left: 250px;
            }

            .header {
                padding: 20px;
                position: fixed;
            }

            .header h1 {
                font-size: 2rem;
            }
        }

        .fas.fa-trash {
            font-size: 18px;
            cursor: pointer;
            color: red;
            transition: color 0.3s ease;
        }

        .fas.fa-trash:hover {
            color: darkred;
        }

        .update_pss_button {
            height: 35px;
            width: 150px;
            border: none;
            border-radius: 4px;
            background-color: #17a1bb;
            color: white;
            padding: 5px;
            text-align: center;
            cursor: pointer;
            display: block;
            margin: 20px auto;
            text-decoration: none;
            font-size: 16px;
        }

        .imageup {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            text-align: center;
            margin-bottom: 20px;
            overflow: hidden; /* Ensure image doesn't overflow */
        }

        .imageup img {
            width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <button class="menu-toggle" onclick="toggleMenu()">☰</button>
        <h1>Payroll Management System</h1>
    </div>

    <!-- Sidebar Navigation -->
    <div class="navi">
        <?php 
            echo "<a href='emp_home.php'><button class='button'>Home</button></a>";
            echo "<a href='emp_profile.php'><button class='button active'>My Profile</button></a>";
            echo "<a href='salary_report.php'><button class='button'>Salary Report</button></a>";
            echo "<a href='logout.php'><button class='button'>Logout</button></a>";
        ?>
    </div>

    <!-- Content -->
    <div class="container">
        <div class="content">
            <?php
            if (isset($_SESSION["empid"])) {
                $empid = $_SESSION["empid"];
                $query = "SELECT * FROM rdata WHERE empid='$empid'";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_array($result)) {
                    $image = $row['Images'];

                    echo "<div class='imageup'>";
                    echo "<form action='photo.php' method='post' enctype='multipart/form-data'>";

                    if (empty($image)) {
                        echo "<img src='src/Avatar.jpg' alt='Profile Picture' />";
                    } else {
                        echo "<img src='$image' alt='Profile Picture' />";
                    }

                    echo "</form></div>";

                    echo "<table>";
                    echo "<tr><th>Name</th><td>" . htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) . "</td></tr>";
                    echo "<tr><th>Empid</th><td>" . htmlspecialchars($row['empid']) . "</td></tr>";
                    echo "<tr><th>Email</th><td>" . htmlspecialchars($row['email']) . "</td></tr>";
                    echo "<tr><th>Gender</th><td>" . htmlspecialchars($row['gender']) . "</td></tr>";
                    echo "<tr><th>Department</th><td>" . htmlspecialchars($row['department']) . "</td></tr>";
                    echo "<tr><th>Address</th><td>" . htmlspecialchars($row['address']) . "</td></tr>";
                    echo "</table>";

                    echo "<a href='update.php' class='update_pss_button'>Update</a>";
                }
            }
            ?>
        </div>
    </div>

    <script>
        function toggleMenu() {
            const navi = document.querySelector('.navi');
            navi.classList.toggle('show');
        }
    </script>
</body>

</html>
