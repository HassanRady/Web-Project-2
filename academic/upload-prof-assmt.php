<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>DOCTOR ASSIGNMENT 1</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../css/rootStyles.css">
    <link rel="stylesheet" href="prof-assmt.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <?php
        include_once dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . "paths.php";
        include_once $professor_sidebar_path;

        if (isset($_POST['upload'])) {
            $id_course = $_GET['course_id'];
            $id_instructor = 18;
            $id_semester = $_GET['sem_id'];
            add_assignment($id_course, $id_instructor, $id_semester);
        }
        ?>
        <!-- Page Content  -->
        <div id="content">

            <?php
            include_once $professor_navbar_path;
            ?>




            <div class="page-body">
                <!-- START HERE -->

                <div class="row">
                    <div class="col-md-12 order-md-1 col-lg-12">
                        <h4 class="mb-3">Upload Assignment</h4>
                        <hr class="mb-4">
                        <form class="needs-validation" novalidate method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-4 col-md-12 mb-3">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="assignment-title" id="title" placeholder="" value="" required>
                                    <div class="invalid-feedback">
                                        Valid title is required.
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-12 mb-3">
                                    <label for="group">Group</label>
                                    <input name="group" type="text" name="group" class="form-control" id="group" placeholder="" value="" required>
                                </div>
                                <div class="col-lg-3 col-md-12 mb-3">
                                    <label for="due date">Due Date</label>
                                    <input type="date" name="due_date" class="form-control" id="due_date" placeholder="" value="" required>
                                </div>
                                <div class="col-lg-3 col-md-12 mb-3">
                                    <label for="time">Time</label>
                                    <input type="time" name="time" class="form-control" id="time" placeholder="" value="" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label for="custom-file">Upload file</label>
                                    <div class="custom-file">
                                        <input type="file" name="assignment" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>

                                </div>

                                <div class="col-lg-12 mb-3">
                                    <label for="aboutTextArea">Description</label>
                                    <textarea class="form-control" name="description" placeholder="What is required?" id="aboutTextArea" style="resize: none; height: 150px;"></textarea>
                                </div>

                            </div>



                            <hr class="mb-4">

                            <button class="btn btn-primary btn-lg btn-block" name="upload" type="submit">Upload</button>
                        </form>
                        <br>
                    </div>
                </div>
                <!-- STOP HERE -->

            </div>


        </div>
    </div>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Navbar -->
    <script type="text/javascript" src="../js/rootJS.js"></script>
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

</body>

</html>