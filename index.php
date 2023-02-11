<?php
// Alerts Setting
$inertsuc = false;
$update = false;
$delete = false;
$error = false;
// Connecting To Sever and DB
$server = "localhost";
$username = "root";
$pass = "";
$dbname = "crudapp";

$con = mysqli_connect($server, $username, $pass, $dbname);
if (!$con) {
    die("Error Occured Which is given below: <br>" . $mysqli_connect_err);
} else {
    // echo"sucessfully Connected";
}

// Delete Records
if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];
    $sql = "DELETE FROM `crudapp` WHERE `S.no` = $sno";
    $result = mysqli_query($con, $sql);
    if ($result) {

        // header('Location: '.$_SERVER['LocalHost']);
        header("Location: " . "/projects/CRUD APP/index.php" . $_SERVER['localhost'] . $location);
        $delete = true;
        echo ("Hasssadxc");
    } else {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Sucess!</strong> Error Occured. Please Try again later.. Sorry for Incivnince.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update Notes
    if (isset($_POST['snoEdite'])) {
        $num = $_POST["snoEdite"];
        $title = $_POST["titleedit"];
        $description = $_POST["descripedit"];
        if (strlen(string: $title) > 2 && strlen(string: $description) > 5) {
            $sql = "UPDATE `crudapp` SET `Title` = '$title', `Description` = '$description' WHERE `crudapp`.`S.no` = $num ";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $update = true;
            } else {
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Error Occured</strong>Please Try again later.. Sorry for Incivnince.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
            }
        } else {
            $error = true;
        }
    } else {

        // Add Notes
        $title = $_POST['title'];
        $desc = $_POST['descrip'];
        if (strlen(string: $title) > 2 && strlen(string: $desc) > 5) {
            $mysqliinsert = "INSERT INTO `crudapp`.`crudapp`(`S.no`, `Title`, `Description`, `additional`) VALUES ('[value-1]','$title','$desc', current_timestamp())";
            $inserthassa = mysqli_query($con, $mysqliinsert);
            if (!$inserthassa) {
                die("Error:" . $inserthassa_connect_err);
            } else {
                $inertsuc = true;
            }
        } else {
            $error = true;
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- fontawesome Links -->
    <script src="https://kit.fontawesome.com/0bd3a7a619.js" crossorigin="anonymous"></script>

    <!-- Jquery Links+Datatable -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    <!-- CSS file Link -->
    <link href="style.css" rel="stylesheet">

    <!-- bootstrap Links -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Data Table Setting -->
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <title>CRUDE</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fs-3" href="#">Create Read Update Delete</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active fs-5" aria-current="page" href="#">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar Ends -->
    <!-- Sucess Alerts -->
    <?php
    if ($inertsuc) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Sucess!</strong> Notes Added Successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    ?>
    <?php
    if ($update) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Updated!</strong> Notes has been Updated Successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    ?>
    <?php
    if ($delete) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Deleted!</strong> Notes has been Deleted.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    ?>
    <?php
    if ($error) {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong> Error Occured!</strong> Input field cannot be left Empty.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    ?>
    <!-- Sucess Alerts -->
    <h1 class="crud1">Created by PERDEV.</h1>

    <!-- Add Note -->
    <form class="w-75 m-auto" method="POST" action="/projects/CRUD APP/index.php">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Enter a Short Title.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Description</label>
            <input type="text" class="form-control" name="descrip" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">++Add Notes++</button>
    </form>
    <!-- Add Notes End -->



    <!-- Modal -->
    <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Notes</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <form method="POST" action="/projects/CRUD APP/index.php">
                    <input type="hidden" name="snoEdite" id="snoEdite">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Update Note</label>
                            <input type="text" class="form-control" name="titleedit" id="titleedit" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Description</label>
                            <input type="text" class="form-control" name="descripedit" id="descripedit">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Now!</button>
                        </div>
                </form>
            </div>

        </div>
    </div>
    </div>
    <!-- Modal End -->

    <!-- Table Start Here -->
    <div class="w-75 m-auto pt-5 my-4">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $fetch = "SELECT * FROM `crudapp`";
                $hassan = mysqli_query($con, $fetch);
                $checknum = mysqli_num_rows($hassan);
                if ($checknum > 0) {
                    $snor = 1;
                    while ($rows = mysqli_fetch_assoc($hassan)) {
                        echo "<tr>
                <th scope='row'>" . $snor . " </th>
                <td>" . $rows['Title'] . "</td>
                <td>" . $rows['Description'] . "</td>
                <td><button type='button' style='margin:10px;' class='edit btn btn-primary' id=" . $rows['S.no'] . ">Edit</button>
                <button type='button' class='delete btn btn-primary' id=d" . $rows['S.no'] . " >Delete</button></td>
                </tr>";
                        $snor++;
                    }
                } else {
                    echo ("<center><strong>No Record Found</strong></center>");
                }

                ?>
            </tbody>
        </table>
        <hr>
    </div>

    <!-- Table Ends Here -->


    <!-- Footer Starts Here -->
    <section class="contact-area" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="contact-content text-center">
                        <a class="hover-target" target="_blank" href="https://www.youtube.com/@perdev2081"><img src="logo.png" alt="logo"></a>
                        <p>Please Consider subscribing  my Channel <a class="hover-target" target="_blank" href="https://www.youtube.com/@perdev2081">PEREV</a> </p>
                        <div class="hr"></div>
                        <div class="contact-social">
                            <ul>
                                <li><a class="hover-target" target="_blank" href="https://www.facebook.com/perdev58"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a class="hover-target" target="_blank" href="https://github.com/hassankhattak58/"><i class="fab fa-github"></i></a></li>
                                <li><a class="hover-target" target="_blank" href="https://www.youtube.com/@perdev2081"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <p style="margin-bottom: 0px;">Copyright &copy; 2023 <a class="hover-target" target="_blank" href="https://www.youtube.com/@perdev2081"><img src="logo.png" alt="logo"></a> All Rights Reserved.</p>
    </footer>
    <!-- Footer Ends Here -->



    <!-- Javascript Code -->
    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit");
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                descrip = tr.getElementsByTagName("td")[1].innerText;
                snoooo = e.target.id;
                console.log(snoooo);
                console.log(title, descrip);
                titleedit.value = title;
                descripedit.value = descrip;
                snoEdite.value = snoooo;
                console.log(snoEdite.value);
                $('#editmodal').modal('toggle');
            })
        });


        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ");

                sno = e.target.id.substr(1);
                checkallll = window.location;
                window.location = `/projects/CRUD APP/index.php?delete=${sno}`;

                // if (confirm("Are you sure you want to delete this note!")) {
                //   console.log("yes");

                //   // TODO: Create a form and use post request to submit a form
                // }
                // else {
                //   console.log("no");
                // }
            })
        })
    </script>
    <!-- Javascript Code -->


</body>

</html>