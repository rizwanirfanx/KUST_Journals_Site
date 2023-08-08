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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
                           echo "<li><a href='./index.php'>Remark <span id='count'class='span-count' style='color:red'><span></a></li>
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
        <h1 class="j-heading">Journal Remark Here</h1>
        <div class="layout">
            <div class="sidebar">
                <h2>Events</h2>
                <ul>
                    <li><a href="">CONFERENCES</a></li>
                    <li><a href="">TRAININGS</a></li>
                    <li><a href="./../journals.html">JOURNALS</a></li>
                    <li><a href="./../documentWrite/index.php">PUBLISH JOURNAL</a></li>
                </ul>
            </div>
            <div class="container layout sidebar">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Remark ID</th>
                                <th>Title</th>
                                <th>Topic</th>
                                <th>Remark Message</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="report_table"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </section><!-- journal Section ends here -->
    <!-- Footer Section start here -->
    <footer>
        <p> Copyright 2015 Directsciences. All rights reserved.
            <span>Designed By</span> <a href="https://jon17.netlify.app/">Jon</a>
        </p>
    </footer><!-- Footer Section ends here -->
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Full Remark</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
    <script src="./../assets/js/remarkPageHandler.js"></script>
</body>

</html>