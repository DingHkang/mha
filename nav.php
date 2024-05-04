<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <?php 
    session_start();
    include('cdn.php'); // Ensure this includes necessary CSS/JS libraries
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    ?>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            text-align: center;
            font-size: 17px;
        }
        .navbar{
            background:#76b5c5 ;
        }
        .container {
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .mobile-bottom-nav {
            position: fixed; /* Changed from absolute to fixed for stickiness */
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            will-change: transform;
            transform: translateZ(0);
            display: flex;
            height: 50px;
            box-shadow: 0 -2px 5px -2px #333;
            background-color: #fff;
        }

        .mobile-bottom-nav__item {
            flex-grow: 1;
            text-align: center;
            font-size: 12px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .mobile-bottom-nav__item:hover, .mobile-bottom-nav__item--active {
            background-color: #f0f0f0;
        }

        .mobile-bottom-nav__item-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #555;
        }

        .mobile-bottom-nav__item-content i {
            font-size: 24px;
        }

        .mobile-bottom-nav__item--active .mobile-bottom-nav__item-content,
        .nav-item .nav-link.active {
            color: red;
        }

        /* Remove underline from links */
        .mobile-bottom-nav a{
            text-decoration: none;
            color: inherit; /* Ensures link color matches the surrounding text color */
        }

        /* Media query for tablet and PC view */
        @media only screen and (min-width: 768px) {
            .mobile-bottom-nav {
                display: none; /* Hide on larger screens */
            }
        }
        @media only screen and (max-width: 767px) {
            body{
                background-color: #fff;
                font-size: 14px ;
            }
            .navbar-expand-lg {
                display: none;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg" aria-label="Tenth navbar example">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Test</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="score.php">Score</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="wellness-hub.php">Activity Hub</a>
                    </li>
                    <li class="nav-item">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a class="nav-link" href="profile.php">Profile</a>
                        <?php else: ?>
                            <a class="nav-link" href="login.php">Login</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="navbar-brand-center my-2">
        <a class="navbar-brand" href="index.php">
            <img src="img/heal.png" alt="" width="35" height="35">
            <p class="text">HEAL</p>
        </a>
    </div>

    <nav class="mobile-bottom-nav">
        <div class="mobile-bottom-nav__item">
            <a href="index.php">
                <div class="mobile-bottom-nav__item-content">
                    <i class="material-icons">quiz</i>
                    Test
                </div>
            </a>
        </div>
        <div class="mobile-bottom-nav__item">
            <a href="score.php">
                <div class="mobile-bottom-nav__item-content">
                    <i class="material-icons">speed</i>
                    Scores
                </div>
            </a>
        </div>
        <div class="mobile-bottom-nav__item">
            <a href="wellness-hub.php">
                <div class="mobile-bottom-nav__item-content">
                    <i class="material-icons">list</i>
                    Activities
                </div>
            </a>
        </div>
        <?php if (isset($_SESSION["user_id"])): ?>
            <div class="mobile-bottom-nav__item">
                <a href="profile.php">
                    <div class="mobile-bottom-nav__item-content">
                        <i class="material-icons">person</i>
                        Profile
                    </div>
                </a>
            </div>
        <?php else: ?>
            <div class="mobile-bottom-nav__item">
                <a href="login.php">
                    <div class="mobile-bottom-nav__item-content">
                        <i class="material-icons">lock</i>
                        Log In
                    </div>
                </a>
            </div>
        <?php endif; ?>
    </nav>
<script>
        document.querySelectorAll('nav a').forEach(link => {
            link.addEventListener('mouseover', function() {
                this.style.fontWeight = 'bold';
            });

            link.addEventListener('mouseout', function() {
                this.style.fontWeight = 'normal';
            });
        });
    </script>
</body>
</html>
