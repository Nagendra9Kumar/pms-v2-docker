<?php
include 'db_connect.php';
session_start();
$empid = $_SESSION["empid"];
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
    <title>Employee Home</title>
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
    margin-top: 20px; /* Offset for fixed header */
    transition: margin-left 0.3s ease;
}

.content {
    background-color: white;
    padding: 20px; /* Increase padding for more internal spacing */
    margin: 20px; /* Add margin for spacing around the content */
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
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

.navi button.active,
.navi button:hover {
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

/* Responsive Styles */
@media (max-width: 768px) {
    .menu-toggle {
        display: block; /* Show hamburger menu */
    }

    .navi {
        transform: translateX(0); /* Always visible on small screens */
        display: none; /* Hide sidebar by default on small screens */
    }

    .navi.show {
        display: flex; /* Show sidebar when hamburger menu is clicked */
    }

    .container {
        margin-left: 0;
    }

    .header {
        padding: 15px;
        position: relative;
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

    .container {
        margin-left: 250px; /* Space for sidebar */
    }

    .header {
        padding: 20px;
        position: relative;
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

/* Specific Styles */
.button {
    background-color: #34495e; /* Button background */
    border: none;
    color: white;
    padding: 15px 20px;
    text-align: left;
    width: 100%;
    cursor: pointer;
    display: block;
    transition: background-color 0.3s ease;
    font-size: 16px; /* Larger font size */
    border-radius: 5px;
    margin-bottom: 5px;
}

.button.active {
    background-color: #1abc9c; /* Highlight color */
}

.details {
    padding: 10px;
}

.nm {
    font-size: 18px;
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
        if ($empid == "admin") {
            echo "<a href='emp_home.php'><button class='button active'>Home</button></a>";
            echo "<a href='emp_list.php'><button class='button'>Employee List</button></a>";
            echo "<a href='class.php'><button class='button'>Class</button></a>";
            echo "<a href='salary.php'><button class='button'>Salary</button></a>";
            echo "<a href='salary_report.php'><button class='button'>Salary Report</button></a>";
            echo "<a href='logout.php'><button class='button'>Logout</button></a>";
        } else {
            echo "<a href='emp_home.php'><button class='button action'>Home</button></a>";
            echo "<a href='emp_profile.php'><button class='button'>My Profile</button></a>";
            echo "<a href='salary_report.php'><button class='button'>Salary Report</button></a>";
            echo "<a href='logout.php'><button class='button'>Logout</button></a>";
        }
        ?>
    </div>

    <!-- Content -->
    <div class="container">
        <div class="content">
            <p>
                <?php
                if (isset($_SESSION["empid"])) {
                    $empid = $_SESSION["empid"];
                    $query = "SELECT * FROM rdata WHERE empid='$empid'";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_array($result)) {
                        if ($empid == "admin") {
                            echo "<h2>Welcome " . $row['first_name'] . "</h2>";
                        } else {
                            echo "<div class='details'>";
                            echo "<div class='nm'>";
                            echo "<h2>Welcome " . $row['first_name'] . " " . $row['last_name'] . "</h2>";
                            echo "<p>" . $row['empid'] . "</p>";
                            echo "</div></div>";
                        }
                    }
                }
                ?>
            </p>
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