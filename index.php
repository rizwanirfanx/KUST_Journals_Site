<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journal front-end</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        
</head>

<body>
    <!-- Header section start here -->
    <section class="header">
        <a href="" class="logo">Direct<span>Sciences</span></a>
        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="publicationPolicy.html">Publication Policy</a></li>
                <li><a href="ethics.html">Ethics of Publication</a></li>
                <li><a href="manuscript.html">Manuscript Submission</a></li>
                <li><a href="aboutus.html">About us</a></li>
                <?php
            if (isset($_SESSION['id'])) {
                echo "<li><a href='./remark/index.php'>Remark <span id='count'class='span-count' style='color:red'><span></a></li>
                      <li><a href='./auth/logOut.php'>Log Out</a></li>";
            }
        ?>
                <?php
            if (!isset($_SESSION['id'])) {
                echo "<li><a href='./admin/pages/index.php'>Login As Admin</a></li>";
            }
        ?>
                <a href="#" id="close"><i class="fa fa-times"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section><!-- Header section ends here -->

    <!-- Hero Section start here -->
    <section class="hero">
        <div class="left">
            <h1>SOLVING PROBLEMS THROUGH SCIENTIFIC NETWORKING</h1>
            <p>Maximizing the impact of research through openness. Because science works best when research is open.</p>
            <?php
            if (!isset($_SESSION['id'])) {
                echo "<a href='./auth/register.php'><button class='btn'>Publish with us</button></a>";
            }
        ?>

        </div>
    </section><!-- Hero Section end here -->

    <!-- journal Section start here -->
    <section class="journals">
        <h1 class="j-heading">Our Journals</h1>
        <div class="layout">
            <div class="sidebar">
                <h2>Events</h2>
                <ul>
                    <li><a href="">CONFERENCES</a></li>
                    <li><a href="">TRAININGS</a></li>
                    <li><a href="journals.html">JOURNALS</a></li>
                    <li><a href="./documentWrite/index.php">PUBLISH JOURNAL</a></li>
                </ul>
            </div>
            <div class="b-container" id="showBox">
            </div>
        </div>
    </section><!-- journal Section ends here -->

    <!-- Footer Section start here -->
    <footer>
        <p> Copyright 2015 Directsciences. All rights reserved.
            <span>Designed By</span> <a href="https://jon17.netlify.app/">Jon</a>
        </p>
    </footer><!-- Footer Section ends here -->

    <!-- Script Files -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="./assets/js/homeScrpt.js"></script>
    <script src="./assets/js/remarkHandler.js"></script>
</body>

</html>