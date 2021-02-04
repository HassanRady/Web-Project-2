<?php


/**
 * @param array $data 
 * @param string $type data's type that it belongs to
 * @param string $pageName the url of the current page
 * @return void
 * 
 */
function printStudentsData($data, $type, $pageName)
{
    foreach ($data as $row) {

        echo "<tr>
        <td>" . $row["student_id"] . "</td> <td>" . $row["arabic_name"] . "</td> 
        <td>" . $row["email"] . "</td> <td>" . $row["level"] . "</td> <td>";
        // a link button element for editing 
        aElement("btn btn-outline-primary right-btn", "edit", $row['id_user'], "update_student.php?id={$row['id_user']}&type={$type}", "Edit");
        echo "<td>";
        aElement("btn btn-outline-primary right-btn", "remove", $row['id_user'], "{$pageName}?delete={$row['id_user']}", "Remove");

        echo "</td></tr>";
    }
}


/**
 * @param array $data 
 * @param string $type data's type that it belongs to
 * @param string $pageName the url of the current page
 * @return void
 * 
 */
function printProfessorsData($data, $type, $pageName)
{
    foreach ($data as $row) {

        echo "<tr>
        <td>" . $row["first_name"] . "</td> <td>" . $row["email"] . "</td> 
        <td>" . $row["mobile_number"] . "</td> <td>";
        // a link button element for editing 
        aElement("btn btn-outline-primary right-btn", "edit", $row['id_user'], "update_ta.php?id={$row['id_user']}&type={$type}", "Edit");
        echo "<td>";
        aElement("btn btn-outline-primary right-btn", "remove", $row['id_user'], "{$pageName}?delete={$row['id_user']}", "Remove");

        echo "</td></tr>";
    }
}


/**
 * @param array $data 
 * @param string $type data's type that it belongs to
 * @param string $pageName the url of the current page
 * @return void
 * 
 */
function printTasData($data, $type, $pageName)
{
    foreach ($data as $row) {

        echo "<tr>
        <td>" . $row["first_name"] . "</td> <td>" . $row["email"] . "</td> 
        <td>" . $row["mobile_number"] . "</td> <td>";
        // a link button element for editing 
        aElement("btn btn-outline-primary right-btn", "edit", $row['id_user'], "update_ta.php?id={$row['id_user']}&type={$type}", "Edit");
        echo "<td>";
        aElement("btn btn-outline-primary right-btn", "remove", $row['id_user'], "{$pageName}?delete={$row['id_user']}", "Remove");

        echo "</td></tr>";
    }
}


/**
 * @param array $data 
 * @param string $type data's type that it belongs to
 * @param string $pageName the url of the current page
 * @return void
 * 
 */
function printSasData($data, $type, $pageName)
{
    foreach ($data as $row) {

        echo "<tr>
        <td>" . $row["first_name"] . "</td> <td>" . $row["email"] . "</td> 
        <td>" . $row["mobile_number"] . "</td> <td>";
        // a link button element for editing 
        aElement("btn btn-outline-primary right-btn", "edit", $row['id_user'], "update_ta.php?id={$row['id_user']}&type={$type}", "Edit");
        echo "<td>";
        aElement("btn btn-outline-primary right-btn", "remove", $row['id_user'], "{$pageName}?delete={$row['id_user']}", "Remove");

        echo "</td></tr>";
    }
}