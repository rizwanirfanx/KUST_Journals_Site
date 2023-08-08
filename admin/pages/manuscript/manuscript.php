<?php
session_start();
    if(!isset($_SESSION['userName'])){
        header("Location:./../index.php");
    }
    ?>
<!doctype html>
<html lang="en">

<head>
    <title>SERVED HUMANITY</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="./../../assets/css/style.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row  nav-row">
            <div class="col-lg-12">
                <nav class="nav d-flex justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link active" href="./../home.html"><span class="fa fa-user mr-2"></span>Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0)"
                            onclick="LogOut(sessionStorage.getItem('user'));"><span
                                class="fa fa-sign mr-2"></span>Logout</a>
                    </li>
                </nav>
            </div>
        </div>
        <div class="row">
            <?php include_once("./../../include/header.php")  ?>
            <div class="col-lg-10">
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">Manuscripts</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 15%;">Title</th>
                                                    <th style="width: 25%;">Abstract</th>
                                                    <th style="width: 25%;">Keywords</th>
                                                    <th style="width: 25%;">Authors</th>
                                                    <th style="width: 5%;">File</th>
                                                    <th style="width: 15%;">Status</th>
                                                    <th style="width: 15%;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="manuscript-table"></tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="" class="modal-image" alt="Image" style="max-width: 100%; max-height: 100%;">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="remarkModal" tabindex="-1" role="dialog" aria-labelledby="remarkModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="remarkModalLabel">Add Remark</h5>
                    <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
    <script src="./../../assets/js/manuscript.js"></script>
</body>

</html>