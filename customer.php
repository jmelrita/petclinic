<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        Customers
    </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body style="background: url(https://wallpapercave.com/wp/B1sODrM.jpg); background-size: 115% ; ">
    <?php
    include "includes/config.php";
    ?>
    <header>
        <div class="logo">
            <h1>Pet Clinic</h1>
        </div>
        <button><a href="Create.php">
                <h4>Add Customer</h4>
            </a></button>
        <nav>
            <ul>
                <button> <a href="index.php">
                        <h5>Home</h5>
                    </a></button>
                <button> <a href="pets.php">
                        <h5>Pets</h5>
                    </a></button>
                <button><a href="customer.php">
                        <h5>Customers</h5>
                    </a></button>
                <button><a href="employee.php">
                        <h5>Employee</h5>
                    </a></button>
                <button><a href="service.php">
                        <h5>Service</h5>
                    </a></button>
                <button><a href="consultationz.php">
                        <h5>Consultation</h5>
                    </a></button>
            </ul>
        </nav>
        <button><?php if ((isset($_SESSION['Employee_id'])) && (basename($_SERVER['PHP_SELF']) != 'logout.php')) {
                    echo '<a href="logout.php"><h3>Logout</h3></a>';
                } else {
                    echo '<a href="login.php"><h3>Login</h3></a>';
                }
                ?></button>
    </header>
    <table>
        <thead>
            <tr>
                <th>Customer_Id</th>
                <th>First_Name</th>
                <th>Last_Name</th>
                <th>Phone_number</th>
                <th>Cust_pic</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!isset($_SESSION['Employee_id'])) {
                require('includes/login_functions.inc.php');
                echo "<p>please log in to view this customers.</p>";
                //echo "<td align='center'><a href='index.php' role='button'> <font color='brightgreek'><h2>Go Back</h2></font></a></td>";
            } else {
                $result = mysqli_query($conn, "SELECT * FROM customer ORDER BY Cust_id ASC");
                $num_rows = mysqli_num_rows($result);
                echo "There are currently $num_rows rows in the table<P>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>\n";
                    echo "<td>" . $row['Cust_id'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['Phone_number'] . "</td>";
                    echo "<td><img width = '100px' height = '100px' src =" . $row['Cust_pic'] . "></td>";
                    echo "<td align='center'><a href='edit.php?Cust_id=" . $row['Cust_id'] . "' role='button'> <h1>Update</h1></a></td>";
                    echo "<td align='center'><a href='delete.php?Cust_id=" . $row['Cust_id'] . "' role='button'> <h1>Delete</h1></a></td>";
                    echo "</tr>\n";
                }
            }
            //mysqli_free_result($result);
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</body>

</html>