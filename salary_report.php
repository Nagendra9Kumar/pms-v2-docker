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
  <title>Salary Report</title>
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
    z-index: 1001; /* Ensure header is on top */
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
    margin-top: 80px; /* Offset for fixed header */
    z-index: 1; /* Ensure container content flows under header */
    position: relative; /* Position relative to control stacking */
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
    height: calc(100% + 60px); /* Full height minus header */
    background-color: #2d3b55; /* Darker background */
    padding-top: 20px;
    transform: translateX(-250px); /* Initially hidden */
    transition: transform 0.3s ease-in-out;
    z-index: 1000; /* Ensure sidebar is below header */
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

.table-wrapper table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 14px;
}

.table-wrapper  th, td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: left;
}

.table-wrapper th {
    background-color: #2d3b55;
    color: white;
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
        margin-top: 60px; /* Adjust margin for small screens */
    }

    .header {
        padding: 15px;
        position: fixed;
    }

    .header h1 {
        font-size: 1.5rem; /* Adjusted font size */
    }

    .content {
        overflow-x: auto;
        margin: 0;
        padding-left: 2px;
        padding-right: 2px;
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
        margin-top: 80px; /* Offset for fixed header */
    }

    .header {
        padding: 20px;
        position: fixed;
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
.button1 {
    height: 45px;
    width: 120px;
    border: 1px solid transparent;
    border-radius: 4px;
    background-color: #17a1bb;
    margin: 10px auto; /* This centers the button horizontally */
    padding: 5px;
    color: #ffffff;
    display: block; /* Ensure it's treated as a block element */
}

.salary-slip {
  margin: 15px;
}

.salary-slip .empDetail {
  width: 100%;
  text-align: left;
  border: 2px solid black;
  border-collapse: collapse;
  table-layout: fixed;
}

.salary-slip .head {
  margin: 10px;
  margin-bottom: 50px;
  width: 100%;
}

.salary-slip .companyName {
  text-align: center;
  font-size: 25px;
  font-weight: bold;
}

.salary-slip .salaryMonth {
  text-align: center;
}

.salary-slip .table-border-bottom {
  border-bottom: 1px solid;
}

.salary-slip .table-border-right {
  border-right: 1px solid;
}

.salary-slip .myBackground {
  padding-top: 10px;
  text-align: left;
  border: 1px solid black;
  height: 40px;
}

.salary-slip .myAlign {
  text-align: center;
  border-right: 1px solid black;
}

.salary-slip .myTotalBackground {
  padding-top: 10px;
  text-align: left;
  background-color: #EBF1DE;
  border-spacing: 0px;
}

.salary-slip .align-4 {
  width: 25%;
  float: left;
}

.salary-slip .tail {
  margin-top: 35px;
}

.salary-slip .align-2 {
  margin-top: 25px;
  width: 50%;
  float: left;
}

.salary-slip .border-center {
  text-align: center;
}

.salary-slip .border-center th,
.salary-slip .border-center td {
  border: 1px solid black;
}

.salary-slip th,
.salary-slip td {
  padding-left: 6px;
  padding: 10px;
}

.salary-slip .tfoot,
.salary-slip .tbody {
  border: 2px solid black;
  margin: 5px;
}

/* Add responsiveness and overflow for smaller screens */
@media (max-width: 768px) {
  .salary-slip {
    overflow-x: auto; /* Enable horizontal scroll */
  }

  .salary-slip .empDetail {
    min-width: 600px; /* Ensure table doesn’t shrink too much */
  }
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
            echo "<a href='emp_home.php'><button class='button'>Home</button></a>";
            echo "<a href='emp_list.php'><button class='button'>Employee List</button></a>";
            echo "<a href='class.php'><button class='button'>Class</button></a>";
            echo "<a href='salary.php'><button class='button'>Salary</button></a>";
            echo "<a href='salary_report.php'><button class='button active'>Salary Report</button></a>";
            echo "<a href='logout.php'><button class='button'>Logout</button></a>";
        } else {
            echo "<a href='emp_home.php'><button class='button'>Home</button></a>";
            echo "<a href='emp_profile.php'><button class='button'>My Profile</button></a>";
            echo "<a href='salary_report.php'><button class='button active'>Salary Report</button></a>";
            echo "<a href='logout.php'><button class='button'>Logout</button></a>";
        }
        ?>
    </div>

  <div class="container">
    <div class="content">
      <?php if (isset($_SESSION["empid"])) {
        $empid = $_SESSION["empid"];

        if (!isset($_POST['btn'])) {
          echo "<form action='salary_report.php' method='post'>";

          if ($empid == "admin") {
            $sql = "SELECT * FROM Salary";
          } else {
            $sql = "SELECT * FROM Salary WHERE empid='$empid'";
          }
          $result = mysqli_query($conn, $sql);
          echo "<div class='table-wrapper'><table class='fl-table'>
            <tr><th width='100'>Empid</th><th>Payment Id</th><th>Month</th><th>Year</th><th>Class</th><th>Receipt</th>";
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr><td>" . $row["empid"] . "</td><td>" . $row["payment_id"] . "</td><td>" . $row["month"] . "</td><td>" . $row["year"] . "</td><td>" . $row["class"] . "</td><td><button type='submit' name='btn' class='update_button' value='" . $row["payment_id"] . "'>View Receipt</button></td></tr>";
            }
          }
          echo "</table></div>";
          echo "</form>";
        }

        if (isset($_POST['btn'])) {
          $pi = $_REQUEST['btn'];
          $query = "SELECT * FROM Salary WHERE payment_id='$pi'";
          $result = mysqli_query($conn, $query);
          while ($row = mysqli_fetch_array($result)) {
            $id = $row['empid'];
            $class = $row['class'];

            $query1 = "SELECT * FROM rdata WHERE empid='$id'";
            $result1 = mysqli_query($conn, $query1);
            while ($rdata = mysqli_fetch_array($result1)) {
              $query2 = "SELECT * FROM Salary_Class WHERE Class='$class'";
              $result2 = mysqli_query($conn, $query2);
              while ($class1 = mysqli_fetch_array($result2)) {
                $total_d = $class1['TDS'] + $class1['PT'] + $class1['PF'];
                echo "<div id='payslip' class='salary-slip'>";
                echo "<table class='empDetail'>";
                echo "<tr height='50px' style='background-color: #c2d69b'>
                  <td colspan='8' class='companyName'>Salary Receipt</td>
                  </tr><tr>";
                echo "<th>Payment Id:</th><td colspan='2'>" . $row["payment_id"] . "</td>
                      <th>Month:</th><td colspan='2'>" . $row["month"] . "</td>
                      <th>Year:</th><td>" . $row["year"] . "</td></tr>";
                echo "<tr><th>Name:</th><td colspan='2'>" . $rdata["first_name"] . " " . $rdata["last_name"] . "</td>
                      <th>Department:</th><td>" . $rdata["department"] . "</td></tr><tr>";
                echo "<th>EmpId:</th><td colspan='2'>" . $id . "</td>
                      <th>Salary Class:</th><td colspan='2'>" . $class1["Class"] . "</td>
                      <th>Basic Salary:</th><td>" . $class1["BS"] . "</td></tr>";
                echo "<tbody class='tbody'><tr class='myBackground'><th colspan='3'>Allowances</th>
                      <th class='table-border-right'>Amount (Rs.)</th>
                      <th colspan='3'>Deductions</th>
                      <th>Amount (Rs.)</th></tr></tbody>";
                echo "<tr><td colspan='3'>Medical Allowance</td><td class='myAlign'>" . $class1["MA"] . "</td>
                      <td colspan='3'>Tax Deduction At Source</td><td>" . $class1["TDS"] . "</td></tr><tr>
                      <td colspan='3'>House Rent Allowance</td><td class='myAlign'>" . $class1["HRA"] . "</td>
                      <td colspan='3'>Professional Tax</td><td>" . $class1["PT"] . "</td></tr><tr>
                      <td colspan='3'>Travel Allowance</td><td class='myAlign'>" . $class1["TA"] . "</td>
                      <td colspan='3'>Provident Fund</td><td>" . $class1["PF"] . "</td></tr><tr>
                      <td colspan='3'>Gross Salary</td><td class='myAlign'>" . $class1["GS"] . "</td>
                      <td colspan='3'>Total Deduction</td><td>" . $total_d . "</td></tr>
                      <tfoot class='tfoot'><tr style='background-color:lightgray;'>
                      <th colspan='4'></th>
                      <th colspan='3'>Net Salary</th><td>" . $class1["NS"] . "</td></tr></tfoot>";
                echo "</table>";
                echo "</div>";

                echo "<button class='button1' onclick='downloadimage()'>Download Payslip</button>";
              }
            }
          }
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
    <script src="canvas.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script>
  function downloadimage() {
    var container = document.querySelector(".salary-slip");
    
    // Temporarily set a fixed width to ensure everything is captured
    container.style.width = "1000px"; // Example width, adjust as needed

    html2canvas(container, {
        scale: 2, // Increase resolution
        useCORS: true,
        allowTaint: true,
    }).then(function(canvas) {
        var link = document.createElement("a");
        document.body.appendChild(link);
        link.href = canvas.toDataURL('image/jpeg', 1.0);
        link.download = "salary-slip.jpg";
        link.click();

        // Revert width change after download
        container.style.width = "";
    });
}

  </script>
</body>

</html>
