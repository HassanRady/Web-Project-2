<?php


/**
 * @param array $data 
 * @return void
 * 
 */
function printCommonData($data)
{
    foreach ($data as $row) {

        echo "<tr>
        <td>" . $row["first_name"] . "</td> <td>" . $row["email"] . "</td> 
        <td>" . $row["mobile_number"] . "</td> <td>";
        // a link button element for editing 
        aElement("btn btn-outline-primary right-btn", "edit", $row['id_user'], "update_ta.php?id={$row['id_user']}", "Edit");
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



/**
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