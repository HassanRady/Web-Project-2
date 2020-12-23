<?php
// getting connection
include_once "db_conn.php";


function showData()
{
    global $conn, $students_data;

    // query for showing students
    $sql = "SELECT s.name, s.student_id, u.email, s.level, s.std_group, s.finished_hours, s.st_status, s.cgpa 
        FROM students s 
        join users u 
            on s.id = u.id
        ORDER BY s.level DESC;";
    $result = mysqli_query($conn, $sql);
    $students_data = array();
    if ($result) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            // saving data
            $students_data[] = $row;

            echo "<tr><td>" . $row["name"] . "</td><td>" . $row["student_id"] . "</td><td>"
                . $row["email"] . "</td><td>" . $row["level"] . "</td><td>" . $row["std_group"] . "</td><td>"
                . $row["finished_hours"] . "</td><td>" . $row["st_status"] . "</td><td>" . $row['cgpa'] . "</td></tr>";
        }
        echo "</table>";
        $conn->close();
    } else {
        die("RESULT FAILED" . mysqli_error($conn) . " " . mysqli_errno($conn));
    }
}


function add()
{
    global $conn;
    if (isset($_POST['submit'])) {

        // retrieving values from the user input form
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $national_id = $_POST['national_id'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $mobile_number = $_POST['mobile_number'];
        $home_number = $_POST['home_number'];
        $password =  $national_id;         // temp until user changes it
        

        $arabic_name = $_POST['arabic_name'];
        $address = $_POST["address"];
        $student_type = $_POST['student_type'];
        $student_id = $_POST['student_id'];
        $guardian_mobile_number = $_POST['guardian_mobile_number'];


        

        // handling realescape
        $email = mysqli_real_escape_string($conn, $email);

        // hashing password
        $options = ['cost' => 10,
                    ];
        $password = password_hash($password, PASSWORD_BCRYPT, $options);


        // query for adding the user
        $sql1 = "INSERT INTO users (first_name, middle_name, last_name, national_id, email, password, gender, mobile_number, home_number)
                        VALUES ('$first_name', '$middle_name', '$last_name', $national_id, '$email', '$password', '$gender', $mobile_number, $home_number);";
        // execute the query
        $result =  mysqli_query($conn, $sql1);
        // check the first query
        if ($result) {
            $last_id = mysqli_insert_id($conn);

            // adding the student user in students table with deafult values
            if ($type == "Student") {
                $sql2 = "INSERT INTO students (student_id, cgpa, finished_hours, level, std_group, st_status, id, name)
                                    VALUES ($user_id, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, $last_id , '$full_name');";
            }
            // adding the professor user in professors table with deafult values
            elseif ($type == "Professor") {
                // TODO
            }
            // adding the TA user in TAs table with deafult values
            else {
                // TODO
            }

            $result2 =  mysqli_query($conn, $sql2);

            // check the second query
            if ($result2) {
                header("Location:./add_user.php?add=success");
            } else {
                // error message
                die ("Could not insert data from sql2: " . mysqli_error($conn) . " " . mysqli_errno($conn));
            }
            $conn->close();
        } else {
            // error message
            die("Could not insert data from sql1 : " . mysqli_error($conn) . " " . mysqli_errno($conn));
        }
    }
}
