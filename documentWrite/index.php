<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journal front-end</title>
    <link rel="stylesheet" href="./../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
</head>

<body>
    <!-- Header section start here -->
    <section class="header">
        <a href="" class="logo">Direct<span>Sciences</span></a>
        <div>
            <ul id="navbar">
                <li><a href="./../index.php" class="active">Home</a></li>
                <li><a href="./../publicationPolicy.html">Publication Policy</a></li>
                <li><a href="./../ethics.html">Ethics of Publication</a></li>
                <li><a href="./../manuscript.html">Manuscript Submission</a></li>
                <li><a href="./../aboutus.html">About us</a></li>
                <?php
                if (isset($_SESSION['id'])) {

                    echo "<li><a href='./../remark/index.php'>Remark <span id='count'class='span-count' style='color:red'><span></a></li>
                    <li><a href='./../auth/logOut.php'>Log Out</a></li>";
                }
                ?>
                <?php
                if (!isset($_SESSION['id'])) {
                    header("Location:./../auth/register.php");
                }
                ?>
                <a href="#" id="close"><i class="fa fa-times"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section><!-- Header section ends here -->
    <!-- journal Section start here -->
    <section class="journals">
        <h1 class="j-heading">Add Journal Details Here</h1>
        <div class="layout">
            <div class="sidebar">
                <h2>Events</h2>
                <ul>
                    <li><a href="">CONFERENCES</a></li>
                    <li><a href="">TRAININGS</a></li>
                    <li><a href="./../journals.html">JOURNALS</a></li>
                    <li><a href="./index.php">PUBLISH JOURNAL</a></li>
                </ul>
            </div>
            <div class="container layout sidebar">
                <form id="submitJornel">
                    <div class="row mt-3">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="title">Enter you title here</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    placeholder="Enter Your Journal Title Here" required>
                            </div>
                        </div><div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="Topic">Enter you Topic here</label>
                                <input type="text" name="Topic" id="Topic" class="form-control"
                                    placeholder="Enter Your Journal Topic Here" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="Description">Enter you Description here</label>
                                <input type="text" name="Description" id="Description" class="form-control"
                                    placeholder="Enter Your Journal Short Description Here" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="file">Doc or PDF</label>
                                <input type="file" name="image" id="pdf" class="form-control" accept=".pdf,.doc,.docx" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="file">Image</label>
                                <input type="file" name="themeImage" id="pdf" class="form-control" accept=".png,.gif,.jpg,.jpeg" required>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <button type="submit" class="btn btn-info">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section><!-- journal Section ends here -->
    <!-- Footer Section start here -->
    <footer>
        <p> Copyright 2015 Directsciences. All rights reserved.
            <span>Designed By</span> <a href="https://jon17.netlify.app/">Jon</a>
        </p>
    </footer><!-- Footer Section ends here -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
    <script src="./../assets/js/docScript.js"></script>
    <script src="./../assets/js/remarkPageHandler.js"></script>
</body>

</html>