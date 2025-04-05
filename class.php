<?php include 'db_connect.php';
                
           session_start();
           if (!isset($_SESSION["login"])) {
           header("location: index.html");
           exit;
           }
           
           if (isset($_SESSION["empid"])) {
           $empid = $_SESSION["empid"];
           }
       ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    position: absolute;
    top: 60px; /* Below header */
    left: 0;
    width: 250px; /* Sidebar width */
    height: calc(100% + 500px); /* Full height minus header */
    background-color: #2d3b55; /* Darker background */
    padding-top: 20px;
    transform: translateX(-250px); /* Initially hidden */
    transition: transform 0.3s ease-in-out;
    z-index: 1000;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
    display: flex;
    flex-direction: column;
    overflow: hidden;
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
    transition: background-color 0.3s ease, padding-left 0.3s ease;
    font-size: 16px; /* Larger font size */
    border-radius: 5px;
    margin-bottom: 5px;
    position: relative;
    display: inline-block;
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
    .content {
                overflow-x: auto;
            }

    .header {
        padding: 15px;
        position: relative;
    }

    .header h1 {
        font-size: 1.5rem; /* Adjusted font size */
    }

    .content {
        padding: 10px; /* Reduce padding for smaller screens */
        margin: 10px; /* Reduce margin for smaller screens */
    }

    table {
        width: 100%;
        overflow-x: auto; /* Enable horizontal scrolling if needed */
        display: block;
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
    .content {
                overflow-x: auto;
            }
    .header h1 {
        font-size: 2rem; /* Default font size */
    }

    .content {
        padding: 20px;
        margin: 20px;
    }
}
.update_button, .update_button1 {
            height: 36px;
            width: 120px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: #17a1bb;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            margin: 10px 0;
            padding: 5px;
        }

        .update_button:hover, .update_button1:hover {
            background-color: #1597a4;
        }

/* Table Styles */
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

tr:nth-child(even) {
    background-color: #f2f2f2; /* Alternating row colors */
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


/* Responsive Table Container */
.table-container {
    overflow-x: auto;
    width: 100%;
}

.table-container table {
    min-width: 600px; /* Prevent table from shrinking too much */
}

/* Responsive Styles for Small Screens */
@media (max-width: 768px) {
    .table-container table {
        font-size: 12px; /* Smaller font size for smaller screens */
    }

    .table-container th, .table-container td {
        padding: 8px; /* Reduce padding for smaller screens */
    }
}


/* Style for delete icon */
.fas.fa-trash {
    font-size: 18px;
    cursor: pointer;
    color: red;
    transition: color 0.3s ease;
}


.input-field {
            border: 1px solid #ddd;
            height: 36px;
            width: 100%;
            border-radius: 4px;
            margin: 10px -10px;
            padding: 0 10px;
            font-size: 16px;
        }
.fas.fa-trash:hover {
    color: darkred;
}

   </style>
    
    <script>
    function add() {
    var bs = document.getElementById("bs");
    var hra = document.getElementById("hra");
    var ta = document.getElementById("ta");
    var ma = document.getElementById("ma");
    var tds = document.getElementById("tds");
    var pt = document.getElementById("pt");
    var pf = document.getElementById("pf");
    
    var BS = parseFloat(bs.value);
    if (isNaN(BS)) BS = 0;
    var HRA = parseFloat(hra.value);
    if (isNaN(HRA)) HRA = 0;
    var TA = parseFloat(ta.value);
    if (isNaN(TA)) TA = 0;
    var MA = parseFloat(ma.value);
    if (isNaN(MA)) MA = 0;
    var TDS = parseFloat(tds.value);
    if (isNaN(TDS)) TDS = 0;
    var PT = parseFloat(pt.value);
    if (isNaN(PT)) PT = 0;
    var PF = parseFloat(pf.value);
    if (isNaN(PF)) PF = 0;
    var gross = BS + HRA +TA + MA;
    var net= gross - (TDS + PT + PF);
    document.getElementById("gs").value = gross;
    document.getElementById("ns").value = net;
    
    }
    </script>
</head>

<body>
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
            echo "<a href='emp_home.php'><button class='button '>Home</button></a>";
            echo "<a href='emp_list.php'><button class='button'>Employee List</button></a>";
            echo "<a href='class.php'><button class='button active'>Class</button></a>";
            echo "<a href='salary.php'><button class='button'>Salary</button></a>";
            echo "<a href='salary_report.php'><button class='button'>Salary Report</button></a>";
            echo "<a href='logout.php'><button class='button'>Logout</button></a>";
        } else {
            echo "<a href='emp_home.php'><button class='button'>Home</button></a>";
            echo "<a href='emp_profile.php'><button class='button'>My Profile</button></a>";
            echo "<a href='salary_report.php'><button class='button'>Salary Report</button></a>";
            echo "<a href='logout.php'><button class='button'>Logout</button></a>";
        }
        ?>
    </div>
    <div class="container">
    <div class="content">
     <p>
            <?php

    if (isset($_POST['table'])) {
        echo '<form action="class.php" method="post">';
        echo '<div class="main_form">';
        echo '<label for="class">Class:</label>';
        echo '<input class="input-field" type="text" name="class" id="class" required /><br />';
        // Div for Allowances
        echo '<div class="allowances">';
        echo '<b>Allowances</b><br /><br />';
        echo '<label for="bs">Basic Salary:</label>';
        echo '<input class="input-field" type="number" name="bs" id="bs" oninput="add()" required /><br />';
        echo '<label for="hra">House Rent Allowance:</label>';
        echo '<input class="input-field" type="number" name="hra" id="hra" oninput="add()" required /><br />';
        echo '<label for="ta">Travel Allowance:</label>';
        echo '<input class="input-field" type="number" name="ta" id="ta" oninput="add()" required /><br />';
        echo '<label for="ma">Medical Allowance:</label>';
        echo '<input class="input-field" type="number" name="ma" id="ma" oninput="add()" required /><br />';
        echo '</div>';
    
        // Div for Basic Salary and Deductions
        echo '<div class="deductions">';
       
        echo '<b>Deductions</b><br /><br />';
        echo '<label for="tds">Tax Deduction At Source:</label>';
        echo '<input class="input-field" type="number" name="tds" id="tds" oninput="add()" required /><br />';
        echo '<label for="pt">Professional Tax:</label>';
        echo '<input class="input-field" type="number" name="pt" id="pt" oninput="add()" required /><br />';
        echo '<label for="pf">Employee Provident Fund:</label>';
        echo '<input class="input-field" type="number" name="pf" id="pf" oninput="add()" required /><br />';
        echo '<label for="gs">Gross Salary:</label>';
        echo '<input class="input-field" type="number" name="gs" id="gs" readonly /><br />';
        echo '<label for="ns">Net Salary:</label>';
        echo '<input class="input-field" type="number" name="ns" id="ns" readonly /><br />';
        echo '</div>';
    
        echo '</div>'; // End of main_form div
        echo '<input class="update_button1" type="submit" id="update" name="update" value="Update" />';
        echo '</form>';
    }
    
    


            if (!isset($_POST['table']))
            {
            $sql = "SELECT * FROM Salary_Class ORDER BY BS DESC ";
            $result = mysqli_query($conn, $sql);
            echo "<form action=class.php method=post>";
            echo "<table class=fl-table><thead>
            <tr><th >Class</th><th>Basic Salary</th><th>House Rent Allowance</th><th>Travel Allowance</th><th>Medical Allowance</th><th>T.D.S</th><th>Professional Tax</th><th>Provident Fund</th><th>Gross Salary</th><th>Net Salary</th><th>Delete class</th></tr></thead>";
            if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
            echo "<tbody><tr><td>".$row["Class"]."</td><td>".$row["BS"]."</td><td>".$row["HRA"]."</td><td>".$row["TA"]."</td><td>".$row["MA"]."</td><td>".$row["TDS"]."</td><td>".$row["PT"]."</td><td>".$row["PF"]."</td><td>".$row["GS"]."</td><td>".$row["NS"]."</td><td><button type=submit name=btn id=btn class=update_button value='$row[Class]' style='background-color: red;'>Delete</button></td></tr>";
            }
            }
            echo "</tbody></table>";
            echo "<input type=submit class=update_button id=table name=table value='Create Class'>";
            echo "</form>";
            }
            
            ?>
            
            <?php
            
            if (isset($_POST['update']))
            {
            $class =  $_REQUEST['class'];
            
            $bs = $_REQUEST['bs'];
            
            $hra = $_REQUEST['hra'];
            
            $ta = $_REQUEST['ta'];
            
            $ma =  $_REQUEST['ma'];
            
            $tds = $_REQUEST['tds'];
            
            $pt = $_REQUEST['pt'];
            
            $pf = $_REQUEST['pf'];
            
            $gs = $_REQUEST['gs'];
            
            $ns = $_REQUEST['ns'];
            
            $query = "select Class from Salary_Class where Class = '$class'";
            $fire = mysqli_query($conn,$query);
            if (mysqli_num_rows($fire)>0) {
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('$class is already exist');
            window.location.href='class.php';
            </script>");
            }
            else
            {
            
            $sql = "INSERT INTO Salary_Class VALUES ('$class', 
            
            '$bs','$hra','$ta','$ma','$tds','$pt','$pf','$gs','$ns') ";
            
            if(mysqli_query($conn, $sql)){
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Class Created Successfully');
            window.location.href='class.php';
            </script>");
            }
            
            else{
            
            echo "ERROR: Hush! Sorry $sql. "
            . mysqli_error($conn);
            
            }
            }
            }
            
            ?>
            
            <?php
            
            if(isset($_POST['btn']))
            {
            $id =  $_REQUEST['btn'];
            $sql = "DELETE FROM Salary_Class WHERE Class='$id'";
            if(mysqli_query($conn,$sql))
            {
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Class Deleted Successfully');
            window.location.href='class.php';
            </script>");
            }
            else
            {
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Class Not Deleted');
            window.location.href='class.php';
            </script>");
            }
            }
            ?>
            
            
        </p>  
         
   </div></div>
   
   <script>
        function toggleMenu() {
            const navi = document.querySelector('.navi');
            navi.classList.toggle('show');
        }
    </script>
</body>
</html>
