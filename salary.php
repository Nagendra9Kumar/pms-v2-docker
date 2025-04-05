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
    <title>Salary</title>
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
    margin-top: 5px; /* Offset for fixed header */
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
.input-field1 {
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 10px;
    font-size: 16px;
    width: calc(100% - 22px); /* Adjust width for padding and border */
    margin: 5px 0;
}

.update_button,
.update_button1 {
    background-color: #17a1bb;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 10px;
    cursor: pointer;
    font-size: 16px;
    margin: 5px 0;
    transition: background-color 0.3s ease;
}

.update_button:hover,
.update_button1:hover {
    background-color: #0e7a8a;
}

.s1, .s2, .s3, .s4 {
    margin-bottom: 15px;
}

.s1 input, .s2 input, .s3 input, .s4 input {
    width: 100%;
    margin: 5px 0;
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
    <!-- Hamburger Menu Icon -->
    <div class="hamburger" onclick="toggleMenu()">
        <div></div>
        <div></div>
        <div></div>
    </div>

    <!-- Sidebar Navigation -->
      <!-- Sidebar Navigation -->
      <div class="navi" id="navMenu">
        <a href="emp_home.php"><button class="<?= $activePage === 'home' ? 'active' : '' ?>">Home</button></a>
        <a href="emp_list.php"><button class=" <?= $activePage === 'list' ? 'active' : '' ?>">Employee List</button></a>
        <a href="class.php"><button class="<?= $activePage === 'class' ? 'active' : '' ?>">Class</button></a>
        <a href="salary.php"><button class="active <?= $activePage === 'salary' ? 'active' : '' ?>">Salary</button></a>
        <a href="salary_report.php"><button class="<?= $activePage === 'report' ? 'active' : '' ?>">Salary Report</button></a>
        <a href="logout.php"><button class="<?= $activePage === 'logout' ? 'active' : '' ?>">Logout</button></a>
    </div>

    <!-- Content Container -->
    <div class="container">
        <div class="content">
            <p>
            <?php
            echo "<form action='salary.php' method='post'>";
            $query = "SELECT * FROM Salary_Class ORDER BY BS DESC";
            $result = mysqli_query($conn, $query);
            echo "<div class='div1'>";
            echo "<input type='text' class='input-field1' placeholder='Enter Id' name='id' id='id' required />";
            echo "<label>Month:<br/></label><input type='text' class='input-field1' id='month' name='month' value='" . date('F') . "' readonly>";
            echo "<label>Year:<br/></label><input type='text' class='input-field1' id='year' name='year' value='" . date('Y') . "' readonly>";
            echo "<label>Class:<br/></label><select name='class' class='input-field1' id='class' required />";
            echo "<option value='' selected disabled>Select Class</option>";
            while ($row = mysqli_fetch_array($result)) {
                echo "<option value='$row[Class]'>$row[Class]</option>";
            }
            echo "</select>";
            echo "</div>";
            echo "<input type='submit' class='update_button' name='submit' id='submit' value='Submit'><br><br>";
            echo "</form>";
            ?>

            <?php
            if (isset($_POST['submit'])) {
                $id = $_REQUEST['id'];
                $class = $_REQUEST['class'];
                $month = $_REQUEST['month'];
                $year = $_REQUEST['year'];

                $query1 = "SELECT empid FROM Salary WHERE empid = '$id' AND month = '$month'";
                $result1 = mysqli_query($conn, $query1);
                if (mysqli_num_rows($result1) > 0) {
                    echo "Payment Is Already Generated";
                } else {
                    $query = "SELECT * FROM rdata WHERE empid='$id'";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_array($result);

                        echo "<form action='salary.php' method='post'>";
                        echo "<div class='s1'>";
                        echo "<label>Name</label><br><input class='input-field' type='text' value='$row[first_name] $row[last_name]' readonly />";
                        echo "<br><label>Empid</label><br><input class='input-field' type='text' name='empid' id='empid' value='$row[empid]' readonly /><br></div>";

                        echo "<div class='s2'>";
                        echo "<label>Month</label><br><input class='input-field' type='text' name='month' id='month' value='$month' readonly />";
                        echo "<br><label>Year</label><br><input class='input-field' type='text' name='year' id='year' value='$year' readonly /></div>";

                        $query = "SELECT * FROM Salary_Class WHERE class='$class'";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_array($result);
                        echo "<div class='s3'>";
                        echo "<br><label>Class</label><br><input class='input-field' type='text' name='class' id='class' value='$row[Class]' readonly />";
                        echo "<br><label>HRA</label><br><input class='input-field' type='text' value='$row[HRA]' readonly />";
                        echo "<br><label>TA</label><br><input class='input-field' type='text' value='$row[TA]' readonly />";
                        echo "<br><label>MA</label><br><input class='input-field' type='text' value='$row[MA]' readonly />";
                        echo "<br><label>G.S</label><br><input class='input-field' type='text' value='$row[GS]' readonly /></div>";

                        echo "<div class='s4'>";
                        echo "<label>Basic Salary</label><br><input class='input-field' type='text' value='$row[BS]' readonly />";
                        echo "<br><label>T.D.S</label><br><input class='input-field' type='text' value='$row[TDS]' readonly />";
                        echo "<br><label>P.T</label><br><input class='input-field' type='text' value='$row[PT]' readonly />";
                        echo "<br><label>PF</label><br><input class='input-field' type='text' value='$row[PF]' readonly />";
                        echo "<br><label>N.S</label><br><input class='input-field' type='text' value='$row[NS]' readonly /></div>";

                        echo "<input type='submit' class='update_button1' name='update' id='update' value='Update'><br><br>";
                        echo "</form>";
                    } else {
                        echo "No Records!";
                    }
                }
            }

            if (isset($_POST['update'])) {
                $empid = $_REQUEST['empid'];
                $month = $_REQUEST['month'];
                $year = $_REQUEST['year'];
                $class = $_REQUEST['class'];

                $sql = "INSERT INTO Salary (empid, month, year, class) VALUES ('$empid', '$month', '$year', '$class')";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>
                        alert('Salary Credited Successfully');
                        window.location.href='salary.php';
                    </script>";
                } else {
                    echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
                }
            }
            ?>
            </p>
        </div>
    </div>

    <script>
        function toggleMenu() {
            var navMenu = document.getElementById('navMenu');
            if (navMenu.style.transform === 'translateX(0px)') {
                navMenu.style.transform = 'translateX(-250px)';
            } else {
                navMenu.style.transform = 'translateX(0px)';
            }
        }
    </script>
     <script>
        function toggleMenu() {
            const navi = document.querySelector('.navi');
            navi.classList.toggle('show');
        }
    </script>
</body>
</html>
