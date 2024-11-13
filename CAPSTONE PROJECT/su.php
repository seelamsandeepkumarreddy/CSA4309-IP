<?php
$name = filter_input(INPUT_POST, 'name');
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');
$confirm_password = filter_input(INPUT_POST, 'confirm-password');

if (!empty($username)) {
    if (!empty($password)) {
        if (!empty($name)) {
            if ($password === $confirm_password) {
                $host = "localhost";
                $dbusername = "root";
                $dbpassword = "";
                $dbname = "travel";

                $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } else {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO users1 (name, username, password) VALUES ('$name', '$username', '$hashed_password')";

                    if ($conn->query($sql)) {
                        echo "New record inserted successfully";
                       header("refresh:3; url=login.html");

                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    $conn->close();
                }
            } else {
                echo "Passwords do not match";
            }
        } else {
            echo "Name should not be empty";
        }
    } else {
        echo "Password should not be empty";
    }
} else {
    echo "Username should not be empty";
    die();
}
?>
