
<?php
// getting connection
include_once "db_conn.php";
// helper functions
include "helper.php";

/******************************** Global variables **********************************/
$semester = getCurrentSemester();

  


function showData($one_record = false, $record_id = 0)
{
    global $conn, $students_data, $professors_data, $tas_data, $admins_data;

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
            $file_name = strtolower(basename($_SERVER['PHP_SELF']));
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

            // completing the query if one record only is asked for to show
            if ($one_record) {
                $sql .= $sql0;
            } else {
                $sql .= ";";
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
                    echo "</td></tr>";
                }
            } else {
                // error message
                die("RESULT FAILED from sql-sa-showData" . mysqli_error($conn) . " " . mysqli_errno($conn));
            }
            break;
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

// function to get user data
function userProfile()
{
    global $conn, $id_user, $type, $first_name, $middle_name, $last_name, $full_name,
        $email, $mobile_number, $home_number;
    // user id and type
    $id_user = $_GET["id"];
    // $type = $_GET["type"];

    // getting user's data
    $data = showData(true, $id_user)[$id_user];
    // Close connection
    // $conn->close();

    // what can be shown for all users
    $first_name = $data['first_name'];
    $middle_name = $data['middle_name'];
    $last_name = $data['last_name'];
    $email = $data['email'];
    $mobile_number = $data['mobile_number'];
    $home_number = $data['home_number'];
    // user full name
    $full_name = $first_name . " " . $middle_name . " " . $last_name;

    // what can't be shown
    $national_id = $data['national_id'];
    $type = $data['type'];
    $gender = $data['gender'];

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
    // connection
    // $conn->connect();

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


  
  
  
  
  
  
  
  
  
  /******************************** FUNCTIONS **********************************/
  
  //get the last semester_id in the database;
  function getCurrentSemester(){
    global $conn;
    $query = "SELECT semester_id FROM semesters ORDER BY semester_id DESC LIMIT 1";
    $query_result = mysqli_query($conn, $query);
    if($query_result){
      $result = mysqli_fetch_assoc($query_result);
      return $result['semester_id'];
    }else{
      return -1;
    }

  }


  //check the result of the query
  function checkQuery($query_result){
    global $conn;
    if(!$query_result){
      die(mysqli_error($conn));
    }
  }


  //get registered students in a course
  function getRegisteredStudents($courseId){
      global $conn;
      global $semester;
      $query = "SELECT id_student, arabic_name, level, student_group FROM course_semester_students css INNER JOIN students s ON css.id_student = s.student_id WHERE id_course = $courseId AND id_semester = $semester";
      $query_result = mysqli_query($conn, $query);
      $i = 1;
      while($row = mysqli_fetch_assoc($query_result)){
          $name = $row["arabic_name"];
          $id = $row['id_student'];
          $level = $row['level'];
          $group = $row['student_group'];
          echo "
          <tr>
              <th scope='row'>$i</th>
              <th scope='row'>$id</th>
              <td>$name</td>
              <td>$level</td>
              <td>$group</td>
          </tr>";
          $i++;
      }
  }


  //get the mark breakdown of all registered students in a course
  function getRegisteredStudentsMarks($courseId){
      global $conn;
      global $semester;
      $query = "SELECT id_student, arabic_name, grade, gpa, oral, midterm, course_work, practical, final FROM course_semester_students css INNER JOIN students s ON css.id_student = s.student_id WHERE id_course = $courseId AND id_semester = $semester";
      $query_result = mysqli_query($conn, $query);

      // echo mysqli_error($conn);

      while($row = mysqli_fetch_assoc($query_result)){
          $name = $row["arabic_name"];
          $id = $row['id_student'];
          $grade = $row['grade'] ? $row['grade'] : "F";
          $gpa = $row['gpa'];
          $oral = $row['oral'];
          $mid = $row['midterm'];
          $cw = $row['course_work'];
          $practical = $row['practical'];
          $final = $row['final'];
          $total = $mid+$oral+$cw+$practical+$final;
          echo "
          <tr>
              <th scope='row'>$id</th>
              <td>$name</td>
              <td>$mid</td>
              <td>$oral</td>
              <td>$practical</td>
              <td>$cw</td>
              <td>$final</td>
              <td>$total</td>
              <td>$grade</td>
              <td>$gpa</td>
          </tr>";  
      }
  }


  function getRegisteredStudentsMarksForEdit($courseId){
      global $conn;
      global $semester;
      $query = "SELECT id_student, arabic_name, grade, gpa, oral, midterm, course_work, practical, final FROM course_semester_students css INNER JOIN students s ON css.id_student = s.student_id WHERE id_course = $courseId AND id_semester = $semester";
      $query_result = mysqli_query($conn, $query);

      // echo mysqli_error($conn);

      while($row = mysqli_fetch_assoc($query_result)){
          $name = $row["arabic_name"];
          $id = $row['id_student'];
          $grade = $row['grade'] ? $row['grade'] : "F";
          $gpa = $row['gpa'];
          $oral = $row['oral'];
          $mid = $row['midterm'];
          $cw = $row['course_work'];
          $practical = $row['practical'];
          $final = $row['final'];
          echo "
          <tr>
            <td>$id</td>
            <td>$name</td>
            <td><input type='number' name='midterm' value='$mid'></td>
            <td><input type='number' name='oral' value='$oral'></td>
            <td><input type='number' name='practical' value='$practical'></td>
            <td><input type='number' name='cw' value='$cw'></td>
            <td><input type='number' name='final' value='$final'></td>
          </tr>"; 
      }
  }


  function getInstructorCourses($instructorId){
      global $conn;
      global $semester;
      $query = "SELECT oc.course_id, level, student_count, name FROM open_courses oc INNER JOIN open_courses_instructors oci ON oc.course_id = oci.course_id
      INNER JOIN courses c ON oc.course_id = c.course_id WHERE instructor_id = $instructorId ";
      $query_result = mysqli_query($conn, $query);

      while($row = mysqli_fetch_assoc($query_result)){
          $name = $row['name'];
          $id = $row['course_id'];
          $level = $row['level'];
          $count = $row['student_count'];
          echo"
            <div class='col-sm-12 col-md-6 col-lg-4 col-xl-3 course-item'>
            <a href='discussion.php?course_id=$id&sem_id=$semester' class='cbox'>
              <div class='course-title'>
                $name
              </div>
              <div class='course-info'>
                Level: $level
              </div>
              <div class='course-info'>
                Students: $count
              </div>
            </a>
            </div>              
          "; 
      }
  }


  function getStudentCourses($studentId){
      global $conn;
      global $semester;
      $query = "SELECT c.course_id, c.name, u.first_name, u.last_name FROM course_semester_students css 
      INNER JOIN courses c ON css.id_course = c.course_id
      INNER JOIN open_courses_instructors oci ON oci.course_id = c.course_id
      INNER JOIN instructors i on oci.instructor_id = i.instructor_id
      INNER JOIN users u on i.id_user = u.id 
      WHERE css.id_student = $studentId AND (u.type = 'professor' or u.type='admin')";
      $query_result = mysqli_query($conn, $query);

      while($row = mysqli_fetch_assoc($query_result)){
          $fname = $row['first_name'];
          $lname = $row['last_name'];
          $cname = $row['name'];
          $id = $row['course_id'];
          echo"
            <div class='col-sm-12 col-md-6 col-lg-4 col-xl-3 course-item'>
            <a href='discussion.php?std_id=$studentId&course_id=$id&sem_id=$semester' class='cbox'>
              <div class='course-title'>
                $cname
              </div>
              <div class='course-info'>
                Prof. $fname $lname
              </div>
            </a>
            </div>              
          "; 
      }
  }

  function getStudentMarksForCourse($courseId, $std_id){
    global $conn;
    global $semester;
      $query = "SELECT * FROM course_semester_students WHERE id_student = $std_id AND id_course = $courseId AND id_semester = $semester";
      $query_result = mysqli_query($conn, $query);

      while($row = mysqli_fetch_assoc($query_result)){
          $mid = $row['midterm'];
          $oral = $row['oral'];
          $cw = $row['course_work'];
          $practical = $row['practical'];
          $final = $row['final'];
          $total = $mid + $oral + $cw + $practical + $final;
          echo"
          <tr>
            <td>$mid</td>
            <td>$oral</td>
            <td>$cw</td>
            <td>$practical</td>
            <td>$final</td>
            <td>$total</td>
          </tr>              
          "; 
      }
  }

  function getCourseMaterial($courseId){
    global $conn;
    global $semester;
      $query = "SELECT m.title, u.first_name, u.last_name, material_ref FROM materials m
      INNER JOIN users u ON u.id = m.id_user
      WHERE id_course = $courseId AND semester_id = $semester";
      $query_result = mysqli_query($conn, $query);

      while($row = mysqli_fetch_assoc($query_result)){
        $title = $row['title'];
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $material = $row['material_ref'];
        echo "<div class='container-fluid'>
        <div class='row conbody  text-center text-lg-left'>
          <div class='col-lg-5 text' >
            <a href='$material' target='_blank' class='a'>$title</a>
          </div>
          <div class='col-lg-4 text'>
            <p>$fname $lname</p>
          </div>
          <div class='col-lg-3 btn-column'>
            <a href='../files/$material' download='$title' type='button' class='btn btn-primary btn-block'>Download</a>
          </div>
        </div>
      </div>";
            
      }      
  }



  function getCourseMaterialEditable($courseId){
    global $conn;
    global $semester;
      $query = "SELECT m.title, u.first_name, u.last_name, material_ref, material_id FROM materials m
      INNER JOIN users u ON u.id = m.id_user
      WHERE id_course = $courseId AND semester_id = $semester";
      $query_result = mysqli_query($conn, $query);

      while($row = mysqli_fetch_assoc($query_result)){
        $title = $row['title'];
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $material = $row['material_ref'];
        $material_id = $row['material_id'];
        echo "<div class='container-fluid'>
        <div class='row conbody  text-center text-lg-left' >
          <div class='col-lg-5 text' >
            <a href='$material' target='_blank' class='a'>$title</a>
          </div>
          <div class='col-lg-4 text'>
            <p>$fname $lname</p>
          </div>
          <div class='col-lg-3 btn-column'>
          <a  data-id='$material_id' data-title='$title' data-file='../files/$material' class='btn btn-primary btn-block launch-modal' data-toggle='modal' data-target='#modalContactForm'>Options</a>
          </div>
        </div>
      </div>";
      // <a href='../files/$material' download='$title' type='button' class='btn btn-primary btn-block'>Download</a>
            
      }      
  }


  


  function uploadMaterial ($file){
      $file_name = $file['name'];
      $file_tmp_name = $file['tmp_name'];
      $file_error = $file['error'];
      $file_size = $file['size'];
      $file_type = $file['type'];
  
      if($file_error === 0){
          $fname=explode('.' , $file_name);
          $new_file_name = uniqid('', true) . "." . strtolower(end($fname));
          $destination = "../files/". $new_file_name ;
          move_uploaded_file($file_tmp_name, $destination);
          return $destination;
      }

      return false;

  }


  function putMaterialInDB($courseId, $title, $location, $user_id){
    global $conn;
    global $semester;
    $title = mysqli_real_escape_string($conn, $title);
    $query = "INSERT INTO materials(id_course, id_user, title, material_ref, semester_id)
    VALUES('$courseId', '$user_id', '$title', '$location', '$semester')";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);
    
  }

  function updateMaterial($title, $location, $material_id){
    global $conn;
    $title = mysqli_real_escape_string($conn, $title);
    $query = "UPDATE materials SET
    title='$title',
    material_ref='$location'
    WHERE
    material_id=$material_id";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);

  }

  function deleteMaterial($material_id){
    global $conn;
    $query = "DELETE FROM materials WHERE material_id=$material_id";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);

  }


  function getCoursePrerequisite($courseId){
    global $conn;
    $prerequisite = "-" ;
    $preq_query = "SELECT name from prerequisites p
    INNER JOIN courses c on p.prerequisite_id = c.course_id
    WHERE p.id_course = $courseId";
    $preq_query_result = mysqli_query($conn, $preq_query);
    $data = mysqli_fetch_assoc($preq_query_result);
    if(mysqli_num_rows($preq_query_result)){
      $prerequisite = $data['name'];
    }
    return $prerequisite;
  }

  function getOpenCourses(){
    global $conn;
    $query = "SELECT c.name, c.course_id, c.credits, c.category, c.has_preq, u.first_name, u.last_name FROM open_courses oc
    INNER JOIN courses c ON c.course_id = oc.course_id
    INNER JOIN open_courses_instructors oci ON oci.course_id = oc.course_id
    INNER JOIN instructors i ON i.instructor_id = oci.instructor_id
    INNER JOIN users u ON u.id = i.id_user
    WHERE u.type = 'professor' OR u.type = 'admin'";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);

    while($row = mysqli_fetch_assoc($query_result)){
      $cname = $row['name'];
      $id = $row['course_id'];
      $credits = $row['credits'];
      $fname = $row['first_name'];
      $lname = $row['last_name'];
      $category = $row['category'];
      $has_preq = $row['has_preq'];
      $prerequisite = '-';

      if($category == 'sim'){
        $category = strtoupper($category);
      }else{
        $category = ucfirst($category);
      }

      if($has_preq == '1'){
        $preq_query = "SELECT name from prerequisites p
        INNER JOIN courses c on p.prerequisite_id = c.course_id
        WHERE p.id_course = $id";
        $preq_query_result = mysqli_query($conn, $preq_query);
        $data = mysqli_fetch_assoc($preq_query_result);
        if(mysqli_num_rows($preq_query_result)){
          $prerequisite = $data['name'];
        }
      }
      echo "
      <div class='conbody container-fluid'>
        <div class='row'>
          <div class='col-lg-5 col-md-12'>
            <table class='table table-borderless '>
              <tbody>
                <tr>
                  <th scope='row'>Course Name</th>
                  <td>$cname</td>
                </tr>
                <tr>
                  <th scope='row'>Course ID</th>
                  <td>$id</td>
                </tr>
                <tr>
                  <th scope='row'>Credit Hours</th>
                  <td>$credits</td>
                </tr>
                
              </tbody>
            </table>
          </div>
          <div class='col-lg-5 col-md-12'>
            <table class='table table-borderless '>
              <tbody>
                <tr>
                  <th scope='row'>Professor</th>
                  <td>Prof. $fname $lname</td>
                </tr>
                <tr>
                  <th scope='row'>Prerequisites</th>
                  <td>$prerequisite</td>
                </tr>
                <tr>
                  <th scope='row'>Category</th>
                  <td>$category</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class='btn-grp col-lg-2 col-md-12'>
            <a href='#' class='btn btn-primary'>View</a>
            <a href='#' class='btn btn-outline-primary'>Add Class</a>
            <a href='#' class='btn btn-outline-secondary'>Options</a>
          </div>
        </div>
      </div>
      ";
  
  }
  }

function getAvailableUniCourses(){
  global $conn;
  $query = "SELECT * FROM courses WHERE category='university'";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);

  while($row = mysqli_fetch_assoc($query_result)){
    $cname = $row['name'];
    $id = $row['course_id'];
    $credits = $row['credits'];
    $type = $row['elective'] == "yes" ? "Elective" : "Mandatory";
    $has_preq = $row['has_preq'];
    $prerequisite = getCoursePrerequisite($id);

    echo "
    <tr>
      <td>$id</td>
      <td>$cname</td>
      <td>$credits</td>
      <td>$type</td>
      <td>$prerequisite</td>
      <td><a data-courseId='$id' class='btn btn-primary' data-toggle='modal' data-target='#modalContactForm'>Open</a></td>
      <td><a href='edit_course.php?course_id=$id' class='btn btn-outline-secondary'>Options</a></td>
    </tr>
    ";

  }
}

function getAvailableFacultyCourses(){
  global $conn;
  $query = "SELECT * FROM courses WHERE category='faculty'";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);

  while($row = mysqli_fetch_assoc($query_result)){
    $cname = $row['name'];
    $id = $row['course_id'];
    $credits = $row['credits'];
    $type = $row['elective'] == "yes" ? "Elective" : "Mandatory";
    $has_preq = $row['has_preq'];
    $prerequisite = getCoursePrerequisite($id); 

    echo "
    <tr>
      <td>$id</td>
      <td>$cname</td>
      <td>$credits</td>
      <td>$type</td>
      <td>$prerequisite</td>
      <td><a data-courseId='$id' class='btn btn-primary' data-toggle='modal' data-target='#modalContactForm'>Open</a></td>
      <td><a href='edit_course.php?course_id=$id' class='btn btn-outline-secondary'>Options</a></td>
    </tr>
    ";
  }


}

function getAvailableSIMCourses(){
  global $conn;
  $query = "SELECT * FROM courses WHERE category='sim'";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);

  while($row = mysqli_fetch_assoc($query_result)){
    $cname = $row['name'];
    $id = $row['course_id'];
    $credits = $row['credits'];
    $type = $row['elective'] == "yes" ? "Elective" : "Mandatory";
    $has_preq = $row['has_preq'];
    $prerequisite = getCoursePrerequisite($id);

    echo "
    <tr>
      <td>$id</td>
      <td>$cname</td>
      <td>$credits</td>
      <td>$type</td>
      <td>$prerequisite</td>
      <td><a data-courseId='$id' class='btn btn-primary' data-toggle='modal' data-target='#modalContactForm'>Open</a></td>
      <td><a href='edit_course.php?course_id=$id' class='btn btn-outline-secondary'>Options</a></td>
    </tr>
    ";

  }


}


function getAvailableFreeCourses(){
  global $conn;
  $query = "SELECT * FROM courses WHERE category='free'";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);

  while($row = mysqli_fetch_assoc($query_result)){
    $cname = $row['name'];
    $credits = $row['credits'];
    $id = $row['course_id'];



    echo "
    <tr>
      <td>$cname</td>
      <td>$credits</td>
      <td><button type='submit' name='openFree' class='btn btn-primary'>Confirm</button></td>
      <td><a href='edit_course.php?course_id=$id' class='btn btn-outline-secondary'>Options</a></td>
    </tr>
    ";

  }


}

function getCoursesAsOptionsEditable($prerequisite){
  global $conn;
  $query = "SELECT * FROM courses";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);

  while($row = mysqli_fetch_assoc($query_result)){
    $id = $row['course_id'];
    $cname = $row['name'];
    if($id==$prerequisite){
      echo "
      <option value='$id' selected='selected'>$id - $cname</option>
      ";
    }else{
      echo "
      <option value='$id'>$id - $cname</option>
      ";
    }
    
  }
}

function getCoursesAsOptions(){
  global $conn;
  $query = "SELECT * FROM courses";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);

  while($row = mysqli_fetch_assoc($query_result)){
    $id = $row['course_id'];
    $cname = $row['name'];
    echo "
      <option value='$id'>$id - $cname</option>
    ";
  }
}

function addNewCourse($id, $name, $credits, $category, $type, $prerequisite, $practicalCheckbox, $sectionsCheckbox){
  global $conn;
  $course_name = $name;
  $course_id = $id;
  $course_credits = $credits;
  $course_category = $category;
  $course_type = $type;
  $course_prerequisite = $prerequisite;
  $course_practicalCheckbox = $practicalCheckbox == '1'? 1 : 0 ;
  $course_sectionsCheckbox = $sectionsCheckbox == '1'? 1 : 0;
  $course_has_prereq = $prerequisite == "" ? 0 : 1 ; 
  $query = "INSERT INTO courses(course_id, credits, has_preq, has_labs, has_practical, name, category, elective)
  VALUES('$course_id', '$course_credits', '$course_has_prereq', '$course_sectionsCheckbox', '$course_practicalCheckbox', '$course_name', '$course_category', '$course_type')";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);
  if($course_has_prereq == 1){
    $preq_query = "INSERT INTO prerequisites(id_course, prerequisite_id) VALUES('$course_id', '$course_prerequisite')";
    $preq_query_result = mysqli_query($conn, $preq_query);
    checkQuery($preq_query_result); 
  }
}

function updateCourse($old, $id, $name, $credits, $category, $type, $prerequisite, $practicalCheckbox, $sectionsCheckbox){
  global $conn;
  $course_name = $name;
  $course_id = $id;
  $course_credits = $credits;
  $course_category = $category;
  $course_type = $type;
  $course_prerequisite = $prerequisite;
  $course_practicalCheckbox = $practicalCheckbox == '1'? 1 : 0 ;
  $course_sectionsCheckbox = $sectionsCheckbox == '1'? 1 : 0;
  $course_has_prereq = $prerequisite == "" ? 0 : 1 ; 
  $query = "UPDATE courses SET course_id = $course_id, credits= $course_credits, has_preq = $course_has_prereq,
  has_labs = $course_sectionsCheckbox, has_practical = $course_practicalCheckbox,
  name = '$course_name', category = '$course_category', elective = '$course_type'
   WHERE course_id = $old";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);
  if($course_has_prereq == 1){
    $preq_query = "UPDATE prerequisites SET id_course = $course_id, prerequisite_id = $course_prerequisite WHERE id_course = $old";
    $preq_query_result = mysqli_query($conn, $preq_query);
    checkQuery($preq_query_result); 
  }
}

function deleteCourse($courseId){
  global $conn;
  $query = "DELETE FROM courses WHERE course_id = $courseId";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);
}


function checkIfCourseIsOpen($courseId){
  global $conn;
  $query = "SELECT EXISTS (SELECT * FROM open_courses WHERE course_id = $courseId)";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);
  if(mysqli_num_rows($query_result) == 1){
    return true;
  }
  return false;
}

function getCourseInfo($courseId){
  global $conn;
  $query = "SELECT * FROM courses WHERE course_id = $courseId";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);
  if(mysqli_num_rows($query_result) == 1){
    $row = mysqli_fetch_assoc($query_result);
    return $row;
  }
  return false;
}

function getProfessorList(){
  global $conn;
  $query = "SELECT u.id, u.first_name, u.middle_name, u.last_name, i.instructor_id FROM instructors i
  INNER JOIN users u on i.id_user = u.id where u.type = 'professor' or u.type = 'admin'";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);

  while($row = mysqli_fetch_assoc($query_result)){
    $id = $row['instructor_id'];
    $fname = $row['first_name'];
    $mname = $row['middle_name'];
    $lname = $row['last_name'];
    echo "
      <option value='$id'>$fname $mname $lname</option>
    ";
  }
}


function openCourse($courseId, $professorId){
  global $conn;
  $query = "INSERT INTO ";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);

  while($row = mysqli_fetch_assoc($query_result)){
    $id = $row['instructor_id'];
    $fname = $row['first_name'];
    $mname = $row['middle_name'];
    $lname = $row['last_name'];
    echo "
      <option value='$id'>$fname $mname $lname</option>
    ";
  }

}



?>
