<?php
include 'db_connect.php';

// Check if ID is set
if (isset($_GET['id'])) {
    $empid = $_GET['id'];

    // Prepare and execute the deletion query
    $sql = "DELETE FROM rdata WHERE empid = ?";
    $stmt = $conn->prepare($sql);

    // Bind the parameter (use 's' if empid is a string)
    $stmt->bind_param('s', $empid); // Assuming empid is a string; use 'i' if it's an integer

    if ($stmt->execute()) {
        // Redirect with success message
        header("Location: emp_list.php?message=Employee deleted successfully");
    } else {
        // Redirect with error message
        header("Location: emp_list.php?message=Error deleting employee");
    }

    $stmt->close();
} else {
    // Redirect with invalid request message
    header("Location: emp_list.php?message=Invalid request");
}

$conn->close();
?>
