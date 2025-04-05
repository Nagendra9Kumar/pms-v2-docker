<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: index.html");
    exit;
}

$empid = $_SESSION["empid"];

// Use prepared statements to prevent SQL injection
$query = "SELECT * FROM rdata WHERE empid=?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $empid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$image = htmlspecialchars($row['Images']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
 <style>
    /* General Body Styling */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
}

/* Header */
.header {
    background-color: #2d3b55;
    color: white;
    padding: 20px;
    text-align: center;
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000;
}

.header h1 {
    margin: 0;
    font-size: 24px;
}

/* Menu Toggle Button for Small Screens */
.menu-toggle {
    display: none;
}

/* Sidebar Navigation */
.navi {
    background-color: #2d3b55;
    position: fixed;
    top: 60px;
    left: 0;
    width: 250px;
    height: calc(100% - 60px);
    display: flex;
    flex-direction: column;
    padding-top: 20px;
    box-shadow: 2px 0px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

/* Sidebar Buttons */
.navi a {
    text-decoration: none;
}

.navi button {
    background-color: #34495e;
    border: none;
    color: white;
    padding: 15px 20px;
    width: 100%;
    text-align: left;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s ease;
    display: block;
    border-radius: 5px;
    margin-bottom: 5px;
}

.navi button:hover, .navi button.active {
    background-color: #1abc9c;
}

/* Content Container */
.container {
    padding: 20px;
    margin-left: 270px;
    margin-top: 80px;
    transition: margin-left 0.3s;
}

/* Content Box Styling */
.content {
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    max-width: 800px;
    margin: auto;
}

.content h2 {
    margin-bottom: 20px;
    font-size: 1.8rem;
    text-align: center;
}

/* Profile Image Upload */
.image-upload {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 30px;
    position: relative;
}

.image-upload img {
    border-radius: 50%;
    width: 150px;
    height: 150px;
    object-fit: cover;
    transition: 0.3s ease-in-out;
}

.image-upload input[type="file"] {
    display: none;
}

.image-upload label {
    position: relative;
    cursor: pointer;
    display: inline-block;
}

/* Overlay Effect for Image Hover */
.image-upload label:hover::after {
    content: 'Click here to upload';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    color: white;
    font-size: 16px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    opacity: 1;
    transition: 0.3s ease-in-out;
}

.image-upload label::after {
    opacity: 0;
    transition: 0.3s ease-in-out;
}

.image-upload .upload-btn {
    display: block;
    background-color: #1abc9c;
    border: none;
    padding: 10px 20px;
    color: white;
    font-size: 16px;
    border-radius: 5px;
    text-align: center;
    cursor: pointer;
    margin: 20px auto 0;
}

.image-upload .upload-btn:hover {
    background-color: #16a085;
}

/* Form Styling */
.input-field {
    width: 100%;
    padding: 12px;
    margin: 8px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

.input-field:focus {
    border-color: #1abc9c;
    outline: none;
}

/* Submit Button Styling */
.update_pss_button {
    display: block;
    width: 100%;
    background-color: #3498db;
    color: white;
    padding: 12px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 20px;
}

.update_pss_button:hover {
    background-color: #2980b9;
}

/* Responsive Styling for Smaller Screens */
@media (max-width: 768px) {
    .container {
        margin-left: 0;
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
    .header {
                padding: 15px;
                position: fixed;
            }
    .navi.show {
        transform: translateX(0);
    }

    .menu-toggle {
        display: block;
        font-size: 24px;
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        position: absolute;
        left: 20px;
        top: 15px;
    }

    .container {
        padding: 20px;
        margin-top: 80px;
        margin-left: 0;
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
        font-size: 2rem; /* Default font size */
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
        <a href='emp_home.php'><button class='button'>Home</button></a>
        <a href='emp_profile.php'><button class='button active'>My Profile</button></a>
        <a href='salary_report.php'><button class='button'>Salary Report</button></a>
        <a href='logout.php'><button class='button'>Logout</button></a>
    </div>

    <!-- Content -->
    <div class="container">
        <div class="content">
            <!-- Profile Image Update -->
            <div class="image-upload">
                <form action="datamodify.php" method="post" enctype="multipart/form-data">
                    <label for="input">
                        <img src="<?= empty($image) ? 'src/Avatar.jpg' : htmlspecialchars($image) ?>" id="output" alt="Profile Picture" />
                    </label>
                    <input id="input" type="file" name="upload" accept="image/*" onchange="preview()">
                    <button type="submit" name="update_image" class="upload-btn">Update Profile Picture</button>
                </form>
            </div>

            <!-- Change Password -->
            <form action="datamodify.php" method="post">
                <h2>Change Password</h2>
                <label for="current_password">Current Password:</label>
                <input class="input-field" type="password" name="OLDPASSWORD" required>
                <label for="new_password">New Password:</label>
                <input class="input-field" type="password" name="PASSWORD" required>
                <input type="submit" name="submit" value="Change Password" class="update_pss_button">
            </form>
        </div>
    </div>
    <script>
    function toggleMenu() {
        const navi = document.querySelector('.navi');
        navi.classList.toggle('show');
        navi.classList.toggle('hide');
    }

    // Hide the menu initially on small screens
    window.onload = function() {
        if (window.innerWidth <= 768) {
            document.querySelector('.navi').classList.add('hide');
        }
    };
</script>

    <script>
        function preview() {
            const file = document.querySelector('input[type=file]').files[0];
            const reader = new FileReader();
            reader.onloadend = function() {
                document.getElementById('output').src = reader.result;
            }
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
