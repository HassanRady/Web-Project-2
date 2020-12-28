<?php
// getting connection
include_once "db_conn.php";
// helper functions
include "helper.php";


function showData($one_record = false, $record_id = 0)
{
    global $conn, $students_data, $professors_data, $tas_data, $admins_data;

    $basename = basename($_SERVER['PHP_SELF']);

    // types of users
    $types = array("sa", "ta", "professor", "student");

    // subquery for displaying one recored
    $sql0 = " WHERE u.id = {$record_id};";

    if ($one_record) {
        $tmp = "SELECT type FROM users u" . $sql0;
        $result_tmp = mysqli_query($conn, $tmp);
        check_result($result_tmp, $conn);
        $type = $result_tmp->fetch_assoc()['type'];
    }

    if (!$one_record) {
        // checking that there is a type
        if (isset($_GET["type"])) {
            // getting users type
            $type = $_GET["type"];
        } else {
            // check the file name which it has any type of users
            $file_name = strtolower($basename);
            $type = which_type($file_name, $types);
        }
    }

    switch ($type) {

        case "student":
            // query for displaying students
            $sql = "SELECT s.*, u.* 
                FROM students s 
                join users u 
                    on s.id_user = u.id";

            // for searching by level
            if (isset($_POST['search'])) {
                $level_search = $_POST['student-level'][6];
                $sql_0_5 = " ORDER BY s.level = {$level_search} DESC;";
            } else {
                $sql_0_5 = " ORDER BY s.level DESC;";
            }

            // completing the query if one record only is asked for to show
            if ($one_record) {
                $sql .= $sql0;
            } else {
                $sql .= $sql_0_5;
            }

            // executing the query
            $result = mysqli_query($conn, $sql);
            $students_data = array();
            // check the query
            if ($result) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    // saving data
                    $students_data[$row['id_user']] = $row;

                    // if only one record then return with the user data
                    if ($one_record) {
                        return $students_data;
                    }

                    // displaying student data
                    echo "<tr>
                    <td>" . $row["student_id"] . "</td> <td>" . $row["arabic_name"] . "</td> 
                    <td>" . $row["email"] . "</td> <td>" . $row["level"] . "</td> <td>";
                    // a link button element for editing 
                    aElement("btn btn-outline-primary right-btn", "edit", $row['id_user'], "update_student.php?id={$row['id_user']}&type={$type}", "Edit");
                    echo "<td>";
                    aElement("btn btn-outline-primary right-btn", "remove", $row['id_user'], "{$basename}?delete={$row['id_user']}", "Remove");


                    echo "</td></tr>";
                }
            } else {
                // error message
                die("RESULT FAILED from sql-students-showData" . mysqli_error($conn) . " " . mysqli_errno($conn));
            }
            break;

        case "professor":
            // query for displaying professors
            $sql = "SELECT p.*, u.* 
                    FROM professors p 
                    join users u 
                        on p.id_user = u.id";

            // completing the query 
            if ($one_record) {
                $sql .= $sql0;
            } else {
                $sql .= ";";
            }

            // executing the query
            $result = mysqli_query($conn, $sql);
            $professors_data = array();
            // check the query
            if ($result) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    // saving data
                    $professors_data[$row['id_user']] = $row;

                    // if only one record then return with the user data
                    if ($one_record) {
                        return $professors_data;
                    }

                    // displaying professor data
                    echo "<tr>
                    <td>" . $row["first_name"] . "</td> <td>" . $row["email"] . "</td> 
                    <td>" . $row["mobile_number"] . "</td> <td>";
                    // a link button element for editing 
                    aElement("btn btn-outline-primary right-btn", "edit", $row['id_user'], "update_professor.php?id={$row['id_user']}&type={$type}", "Edit");
                    echo "<td>";
                    aElement("btn btn-outline-primary right-btn", "remove", $row['id_user'], "{$basename}?delete={$row['id_user']}", "Remove");
                    echo "</td></tr>";
                }
            } else {
                // error message
                die("RESULT FAILED from sql-professors-showData" . mysqli_error($conn) . " " . mysqli_errno($conn));
            }
            break;

        case "ta":
            // query for showing tas
            $sql = "SELECT t.*, u.* 
                FROM tas t 
                join users u 
                    on t.id_user = u.id";

            // completing the query 
            if ($one_record) {
                $sql .= $sql0;
            } else {
                $sql .= ";";
            }

            // executing the query
            $result = mysqli_query($conn, $sql);
            $tas_data = array();
            // check the query
            if ($result) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    // saving data
                    $tas_data[$row['id_user']] = $row;

                    // if only one record then return with the user data
                    if ($one_record) {
                        return $tas_data;
                    }

                    echo "<tr>
                        <td>" . $row["first_name"] . "</td> <td>" . $row["email"] . "</td> 
                        <td>" . $row["mobile_number"] . "</td> <td>";
                    // a link button element for editing 
                    aElement("btn btn-outline-primary right-btn", "edit", $row['id_user'], "update_ta.php?id={$row['id_user']}&type={$type}", "Edit");
                    echo "<td>";
                    aElement("btn btn-outline-primary right-btn", "remove", $row['id_user'], "{$basename}?delete={$row['id_user']}", "Remove");
                    echo "</td></tr>";
                }
            } else {
                // error message
                die("RESULT FAILED from sql-tas-showData" . mysqli_error($conn) . " " . mysqli_errno($conn));
            }
            break;
        case "sa":
            // query for showing tas
            $sql = "SELECT a.*, u.* 
                FROM admins a 
                join users u 
                    on a.id_user = u.id";

            // completing the query 
            if ($one_record) {
                $sql .= $sql0;
            } else {
                $sql .= ";";
            }

            $result = mysqli_query($conn, $sql);
            $admins_data = array();
            // check the query
            if ($result) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    // saving data
                    $admins_data[$row['id_user']] = $row;

                    // if only one record then return with the user data
                    if ($one_record) {
                        return $admins_data;
                    }

                    echo "<tr>
                        <td>" . $row["first_name"] . "</td> <td>" . $row["email"] . "</td> 
                        <td>" . $row["mobile_number"] . "</td> <td>";
                    // a link button element for editing 
                    aElement("btn btn-outline-primary right-btn", "edit", $row['id_user'], "update_sa.php?id={$row['id_user']}&type={$type}", "Edit");
                    echo "<td>";
                    aElement("btn btn-outline-primary right-btn", "remove", $row['id_user'], "{$basename}?delete={$row['id_user']}", "Remove");
                    echo "</td></tr>";
                }
            } else {
                // error message
                die("RESULT FAILED from sql-sa-showData" . mysqli_error($conn) . " " . mysqli_errno($conn));
            }
            break;
        default:
            die("NONE TYPE");
    }
    // Close connection
    $conn->close();
}


function add()
{
    global $conn;
    $basename = basename($_SERVER['PHP_SELF']);
    if (isset($_POST['submit'])) {

        // user type
        $type = $_GET["type"];

        // retrieving user values from the input form
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $national_id = $_POST['national_id'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $mobile_number = $_POST['mobile_number'];
        $home_number = $_POST['home_number'];
        $password =  $national_id;         // temp until user changes it

        // handling realescape
        $email = mysqli_real_escape_string($conn, $email);

        // hashing password
        $password = encrypt_password($password);

        // query for adding the user
        $sql1 = "INSERT INTO users 
                        VALUES (default, '$first_name', '$middle_name', '$last_name', $national_id, '$type', '$email', '$password', '$gender', '$mobile_number', '$home_number');";
        // execute the query
        $result =  mysqli_query($conn, $sql1);
        // check the first query
        if ($result) {
            $last_id = mysqli_insert_id($conn);
            $sql2 = null;

            switch ($type) {

                    // adding the student user in students table with deafult values
                case "student":

                    // retrieving student values from the input form
                    $arabic_name = $_POST['arabic_name'];
                    $address = $_POST["address"];
                    $student_type = $_POST['student_type'];
                    $student_id = $_POST['student_id'];
                    $guardian_mobile_number = $_POST['guardian_mobile_number'];

                    // query for adding a student
                    $sql2 = "INSERT INTO students (id_user, student_id, arabic_name, address, guardian_mobile_number, student_type)
                                    VALUES ($last_id, $student_id, '$arabic_name', '$address', '$guardian_mobile_number', '$student_type');";

                    break;

                    // adding the professor user in professors table with deafult values
                case "professor":
                    // retrieving professor values from the input form
                    $description = $_POST['description'];
                    $instructor_id = $national_id;             // temp until we figure it out

                    // query for adding instructor
                    $sql1_5 = "INSERT INTO instructors VALUES ($last_id, $instructor_id);";
                    $result1_1 = mysqli_query($conn, $sql1_5);
                    if ($result1_1) {
                        // query for adding a professor
                        $sql2 = "INSERT INTO professors VALUES ($last_id, $instructor_id, '$description');";
                    } else {
                        // error message
                        die("Could not insert data from sql1_5-add: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                    }
                    break;

                    // adding the TA user in TAs table with deafult values
                case "ta":
                    // retrieving TA values from the input form
                    $description = $_POST['description'];
                    $instructor_id = $national_id;             // temp until we figure it out

                    // query for adding instructor
                    $sql1_5 = "INSERT INTO instructors VALUES ($last_id, $instructor_id);";
                    $result1_1 = mysqli_query($conn, $sql1_5);
                    if ($result1_1) {
                        // query for adding a TA
                        $sql2 = "INSERT INTO tas VALUES ($last_id, $instructor_id, '$description');";
                    } else {
                        // error message
                        die("Could not insert data from sql1_5-add: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                    }
                    break;

                    // adding the sa user in admins table with deafult values
                case "sa":
                    // retrieving SA values from the input form
                    $instructor_id = $national_id;             // temp until we figure it out

                    // query for adding instructor
                    $sql1_5 = "INSERT INTO instructors VALUES ($last_id, $instructor_id);";
                    $result1_1 = mysqli_query($conn, $sql1_5);
                    if ($result1_1) {
                        // query for adding an admin
                        $sql2 = "INSERT INTO admins VALUES ($last_id, $instructor_id);";
                    } else {
                        // error message
                        die("Could not insert data from sql1_5-add: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                    }
                    break;

                default:
                    echo "There is no type";
            }
            // checking sql2 is formed by one of the above cases got selected
            if (!is_null($sql2)) {

                $result2 =  mysqli_query($conn, $sql2);

                // // check the second query
                if ($result2) {
                    header("Location:./{$basename}?type={$type}&add=success");
                } else {
                    // error message
                    die("Could not insert data from sql2-add: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                }
            } else {
                // error message
                echo "sql2 wasn't formed";
            }
        } else {
            // error message
            die("Could not insert data from sql1-add: " . mysqli_error($conn) . " " . mysqli_errno($conn));
        }
    }
    // Close connection
    $conn->close();
}


function update()
{
    global $conn, $type, $first_name, $middle_name, $last_name, $national_id,
        $email, $gender, $mobile_number, $home_number;

    $id_user = (int)$_GET['id'];
    $type = $_GET['type'];
    // retrieving data
    $data = showData(true, $id_user)[$id_user];
    $first_name = $data['first_name'];
    $middle_name = $data['middle_name'];
    $last_name = $data['last_name'];
    $national_id = $data['national_id'];
    // $type_user = $data['type'];
    $email = $data['email'];
    $gender = $data['gender'];
    $mobile_number = $data['mobile_number'];
    $home_number = $data['home_number'];

    // Setting auto commit to false
    mysqli_autocommit($conn, FALSE);
    switch ($type) {
        case 'student':
            global $student_id, $arabic_name,  $address,
                $guardian_mobile_number, $student_type;

            // retrieving student data
            $student_id = $data['student_id'];
            $arabic_name = $data['arabic_name'];
            // $level = $data['level'];
            // $finished_hours = $data['finished_hours'];
            // $cgpa = $data['cgpa'];
            // $status = $data['status'];
            $address = $data['address'];
            $guardian_mobile_number = $data['guardian_mobile_number'];
            $student_type = $data['student_type'];
            // if update is pressed 
            if (isset($_POST['update'])) {

                // ------------------------------------------------------------------------
                // retrieving user values from the input form
                $first_name = $_POST['first_name'];
                $middle_name = $_POST['middle_name'];
                $last_name = $_POST['last_name'];                   // this can be written one time with two switch statments (PRIVATE)
                $national_id = $_POST['national_id'];
                $email = $_POST['email'];
                $gender = $_POST['gender'];
                $mobile_number = $_POST['mobile_number'];
                $home_number = $_POST['home_number'];
                // --------------------------------------------------------------------------

                // hashing password
                $password = $national_id;
                $password = encrypt_password($password);

                // retrieving student values from the input form
                $arabic_name = $_POST['arabic_name'];
                $address = $_POST["address"];
                $student_type = $_POST['student_type'];
                $student_id = $_POST['student_id'];
                $guardian_mobile_number = $_POST['guardian_mobile_number'];

                // handling realescape
                $email = mysqli_real_escape_string($conn, $email);
                $address = mysqli_real_escape_string($conn, $address);

                // query for updating user in users table
                $sql1 = "UPDATE users
                        SET first_name='{$first_name}', middle_name='{$middle_name}', password='{$password}',
                            last_name='{$last_name}', national_id={$national_id},
                            email='{$email}', gender='{$gender}', mobile_number='{$mobile_number}', home_number='{$home_number}'
                        WHERE id = {$id_user};";
                // query for updating student in students table
                $sql2 = "UPDATE students
                        SET student_id={$student_id}, arabic_name='{$arabic_name}', 
                            address='{$address}', guardian_mobile_number='{$guardian_mobile_number}',
                            student_type='{$student_type}'
                        WHERE id_user = {$id_user};";
                // executing query 1
                $result1 = mysqli_query($conn, $sql1);
                if (!$result1) {
                    // error message
                    die("Could not insert data from sql1-student-update\n: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                }
                // executing query 2
                $result2 = mysqli_query($conn, $sql2);
                if (!$result2) {
                    // error message
                    die("Could not insert data from sql2-student-update\n: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                } else {
                    // Commit transaction
                    mysqli_commit($conn);

                    header("Location:./Students.php?type={$type}&update=success");
                }
            }
            break;

        case "professor":
            global $description;
            // retrieving professor data
            $description = $data['description'];
            // if update is pressed
            if (isset($_POST['update'])) {

                // retrieving user values from the input form
                $first_name = $_POST['first_name'];
                $middle_name = $_POST['middle_name'];
                $last_name = $_POST['last_name'];
                $national_id = $_POST['national_id'];
                $email = $_POST['email'];
                $gender = $_POST['gender'];
                $mobile_number = $_POST['mobile_number'];
                $home_number = $_POST['home_number'];

                // handling realescape
                $email = mysqli_real_escape_string($conn, $email);

                // hashing password
                $password = $national_id;
                $password = encrypt_password($password);

                // retrieving professor values from the input form
                $instructor_id = $national_id;
                $description = $_POST['description'];

                // query for updating user in users table
                $sql1 = "UPDATE users
                        SET first_name='{$first_name}', middle_name='{$middle_name}', password='{$password}', 
                            last_name='{$last_name}', national_id={$national_id},
                            email='{$email}', gender='{$gender}', mobile_number='{$mobile_number}', home_number='{$home_number}'
                        WHERE id = {$id_user};";
                // query for updating instructor in instructors table
                $sql2 = "UPDATE instructors
                SET instructor_id='{$instructor_id}'
                WHERE id_user = {$id_user};";
                // query for updating professor in professors table
                $sql3 = "UPDATE professors
                        SET description='{$description}'
                        WHERE id_user = {$id_user};";
                // executing query 1
                $result1 = mysqli_query($conn, $sql1);
                if (!$result1) {
                    // error message
                    die("FAILED QUERY from sql1-professor-update\n: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                }
                // executing query 2
                $result2 = mysqli_query($conn, $sql2);
                if (!$result2) {
                    // error message
                    die("FAILED QUERY from sql2-professor-update\n: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                }
                // executing query 2
                $result3 = mysqli_query($conn, $sql3);
                if (!$result3) {
                    // error message
                    die("FAILED QUERY from sql3-ta-update\n: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                } else {
                    // Commit transaction
                    mysqli_commit($conn);

                    header("Location:./Professors.php?type={$type}&update=success");
                }
            }
            break;

        case "ta":
            global $department;
            // retrieving professor data
            $department = $data['department'];
            // if update is pressed
            if (isset($_POST['update'])) {

                // retrieving user values from the input form
                $first_name = $_POST['first_name'];
                $middle_name = $_POST['middle_name'];
                $last_name = $_POST['last_name'];
                $national_id = $_POST['national_id'];
                $email = $_POST['email'];
                $gender = $_POST['gender'];
                $mobile_number = $_POST['mobile_number'];
                $home_number = $_POST['home_number'];

                // handling realescape
                $email = mysqli_real_escape_string($conn, $email);

                // hashing password
                $password = $national_id;
                $password = encrypt_password($password);

                // retrieving ta values from the input form
                $instructor_id = $national_id;
                $department = $_POST['department'];

                // query for updating user in users table
                $sql1 = "UPDATE users
                        SET first_name='{$first_name}', middle_name='{$middle_name}', password='{$password}', 
                            last_name='{$last_name}', national_id={$national_id},
                            email='{$email}', gender='{$gender}', mobile_number='{$mobile_number}', home_number='{$home_number}'
                        WHERE id = {$id_user};";
                // query for updating instructor in instructors table
                $sql2 = "UPDATE instructors
                        SET instructor_id='{$instructor_id}'
                        WHERE id_user = {$id_user};";
                // query for updating professor in professors table
                $sql3 = "UPDATE tas
                        SET department='{$department}'
                        WHERE id_user = {$id_user};";
                // executing query 1
                $result1 = mysqli_query($conn, $sql1);
                if (!$result1) {
                    // error message
                    die("FAILED QUERY from sql1-ta-update\n: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                }
                // executing query 2
                $result2 = mysqli_query($conn, $sql2);
                if (!$result2) {
                    // error message
                    die("FAILED QUERY from sql2-ta-update\n: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                }
                $result3 = mysqli_query($conn, $sql3);
                if (!$result3) {
                    // error message
                    die("FAILED QUERY from sql3-ta-update\n: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                } else {
                    // Commit transaction
                    mysqli_commit($conn);

                    header("Location:./ta_list.php?type={$type}&update=success");
                }
            }
            break;
        case "sa":
            // if update is pressed
            if (isset($_POST['update'])) {

                // retrieving user values from the input form
                $first_name = $_POST['first_name'];
                $middle_name = $_POST['middle_name'];
                $last_name = $_POST['last_name'];
                $national_id = $_POST['national_id'];
                $email = $_POST['email'];
                $gender = $_POST['gender'];
                $mobile_number = $_POST['mobile_number'];
                $home_number = $_POST['home_number'];

                // handling realescape
                $email = mysqli_real_escape_string($conn, $email);

                // hashing password
                $password = $national_id;
                $password = encrypt_password($password);

                // retrieving sa values from the input form
                $instructor_id = $national_id;

                // query for updating user in users table
                $sql1 = "UPDATE users
                        SET first_name='{$first_name}', middle_name='{$middle_name}', password='{$password}', 
                            last_name='{$last_name}', national_id={$national_id},
                            email='{$email}', gender='{$gender}', mobile_number='{$mobile_number}', home_number='{$home_number}'
                        WHERE id = {$id_user};";
                // query for updating instructor in instructors table
                $sql2 = "UPDATE instructors
                        SET instructor_id='{$instructor_id}'
                        WHERE id_user = {$id_user};";
                // executing query 1
                $result1 = mysqli_query($conn, $sql1);
                if (!$result1) {
                    // error message
                    die("FAILED QUERY from sql1-ta-update\n: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                }
                // executing query 2
                $result2 = mysqli_query($conn, $sql2);
                if (!$result2) {
                    // error message
                    die("FAILED QUERY from sql2-ta-update\n: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                } else {
                    // Commit transaction
                    mysqli_commit($conn);

                    header("Location:./sa_list.php?type={$type}&update=success");
                }
            }
            break;

        default:
            die("NONE TYPE");
    }
    // Close connection
    $conn->close();
}

// function to delete a user
function delete()
{
    global $conn;

    // checking if delete button is pressed
    if (isset($_GET['delete'])) {
        // db reconnection
        reconnect();
        $id_user = $_GET['delete'];
        // getting file name to redirect
        $basename = basename($_SERVER['PHP_SELF']);
        // query for deleting a user
        $sql = "DELETE FROM users WHERE id = {$id_user};";
        $result = mysqli_query($conn, $sql);
        check_result($result, $conn, "sql-delete");
        header("Location:./{$basename}");
    }
}


// function to get user's data
function userProfile()
{
    global $conn, $id_user, $type, $first_name, $middle_name, $last_name, $full_name,
        $email, $mobile_number, $home_number;
    // user id and type
    $id_user = $_GET["id"];

    // getting user's data
    $data = showData(true, $id_user)[$id_user];
    // Close connection
    $conn->close();

    $type = $data['type'];

    // what can be shown for all users
    $first_name = $data['first_name'];
    $middle_name = $data['middle_name'];
    $last_name = $data['last_name'];
    $email = $data['email'];
    $mobile_number = $data['mobile_number'];
    $home_number = $data['home_number'];
    // user full name
    $full_name = $first_name . " " . $middle_name . " " . $last_name;

    if ($type === "student") {
        global $address, $level, $guardian_mobile_number;
        $address = $data['address'];
        $level = $data['level'];
        $guardian_mobile_number = $data['guardian_mobile_number'];
    }
}


function editProfile()
{
    userProfile();
    global $conn, $type, $id_user;
    // db reconnection
    reconnect();

    if (isset($_POST['update'])) {

        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $mobile_number = $_POST['mobile_number'];
        $home_number = $_POST['home_number'];

        // Setting auto commit to false
        mysqli_autocommit($conn, FALSE);

        if ($type === "student") {
            $address = $_POST['address'];
            $guardian_mobile_number = $_POST['guardian_mobile_number'];

            // handling realescape
            $address = mysqli_real_escape_string($conn, $address);

            // query for updating user in users table
            $sql1 = "UPDATE users
             SET first_name='{$first_name}', middle_name='{$middle_name}',
                 last_name='{$last_name}',  mobile_number='{$mobile_number}', home_number='{$home_number}'
             WHERE id = {$id_user};";
            // query for updating student in students table
            $sql2 = "UPDATE students
             SET address='{$address}', guardian_mobile_number='{$guardian_mobile_number}'
             WHERE id_user = {$id_user};";

            // executing query 1
            $result1 = mysqli_query($conn, $sql1);
            check_result($result1, $conn);

            // executing query 2
            $result2 = mysqli_query($conn, $sql2);
            check_result($result2, $conn);
        }

        // query for updating user in users table
        $sql1 = "UPDATE users
         SET first_name='{$first_name}', middle_name='{$middle_name}',
             last_name='{$last_name}',  mobile_number='{$mobile_number}', home_number='{$home_number}'
         WHERE id = {$id_user};";

        // executing query 1
        $result1 = mysqli_query($conn, $sql1);
        check_result($result1, $conn);

        // Commit transaction
        mysqli_commit($conn);
        header("Location:./my_profile.php?id={$id_user}&type={$type}&update=success");
    }

    // Close connection
    $conn->close();
}
