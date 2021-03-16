<?php
include_once dirname( __FILE__, 3) . "\\utils\\variables.php";



/**
 * @author Hassan
 * @param array $data 
 * @return void
 * 
 */
function printCommonData($data, $type)
{
    global $professorsType, $sasType, $tasType;

    $update_page = null;
    switch($type) {
        case $professorsType:
            $update_page = "update_professor.php";
            break;
        case $tasType:
            $update_page = "update_ta.php";
            break;
        case $sasType:
            $update_page = "update_sa.php";
            break;
    }


    foreach ($data as $row) {

        echo "<tr>
        <td>" . $row["first_name"] . "</td> <td>" . $row["email"] . "</td> 
        <td>" . $row["mobile_number"] . "</td> <td>";
?>

        <form action="<?php echo $update_page."?id={$row['id_user']}" ?>" method="POST">
        <input type="submit" value="Edit" name="edit" class="btn btn-primary">
        <input type="hidden" name="edit_id" value="<?php echo $row['id_user'] ?>" />
        </form>

        <td>
        <form action="" method="POST">
            <input type="submit" value="Delete" name="delete" class="btn btn-primary">
            <input type="hidden" name="delete_id" value="<?php print $row['id_user'] ?>" />
        </form>
    <?php

        echo "</td></tr>";
    }
}



/**
 * @author Hassan
 * @param array $data 
 * @return void
 * 
 */
function printStudentsData($data)
{
    
    foreach ($data as $row) {

        echo "<tr>
        <td>" . $row["student_id"] . "</td> <td>" . $row["arabic_name"] . "</td> 
        <td>" . $row["email"] . "</td> <td>" . $row["level"] . "</td> <td>";
        // a link button element for editing 
        aElement("btn btn-outline-primary right-btn", "edit", $row['id_user'], "update_student.php?id={$row['id_user']}", "Edit");
        echo "<td>";
        ?>
        <form action="" method="POST">
            <input type="submit" value="Delete" name="delete" class="btn btn-primary">
            <input type="hidden" name="delete_id" value="<?php print $row['id_user'] ?>" />
        </form>
    <?php

        echo "</td></tr>";
    }
}