<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questionnaire</title>
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
            .navbar-expand-lg {
                display: none;
            }
            body{
                background-color: #fff;
                font-size: 14px ;
            }
            .container{
                margin: 0 auto;
                padding: 20px;
                height: 100vh;
            }
            .question-container {
            margin-top: 100px;

            }
        }


        .progress-container {
            width: 100%;
            background-color: #e0e0e0;
            height: 10px;
            border-radius: 5px;
            overflow: hidden;

        }
        .progress-bar {
            height: 10px;
            background-color: #76b5c5;
            width: 0%;
            transition: width 0.4s ease-in-out;
        }
        .question-container {
            display: none;
            background-color: white;
            border-radius: 10px;
            padding: 10px;
            margin-top: 20px;

        }
        .question-container.active {
            display: block;
        }
        
        .option-button {
            width: 60%;
            margin-top: 10px;
            text-align: center;
            padding: 10px;
            border-radius: 20px;
            border: 1px solid #ccc;
            background-color: transparent;
        }
        .option-button.active {
            background-color: #76b5c5;
            color: white;
        }
        .btn-primary, .btn-secondary {
            margin:0 auto;
            margin-top:5px;
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
                        <?php if ($user_id): ?>
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

<div class="container">
    <h2>Mental Health Assessment</h2>

    <div class="progress-container">
        <div class="progress-bar" id="progressBar"></div>
    </div>

    <form id="questionForm" action="score.php" method="POST">
        <!-- Placeholder where questions will be inserted -->
        <button type="submit" class="btn btn-primary mx-autov" id="submitButton" style="display: none;">Submit</button>
        <div id="resultContainer"></div>
    </form>
     <!-- Container to display results -->
</div>

<script type="text/javascript">
    const totalQuestions = 10;
    let currentQuestionNumber = 1;

    const questions = [
        "How often do you feel overwhelmed by your academic workload?",
        "Do you often feel anxious or nervous before exams or presentations?",
        "Are you experiencing changes in your appetite or eating habits?",
        "How often do you feel sad or hopeless?",
        "Do you have trouble concentrating or staying focused on your tasks?",
        "How often do you feel overwhelmed by social situations or interactions?",
        "Are you experiencing persistent feelings of fatigue or low energy?",
        "How frequently do you engage in activities that you find enjoyable or fulfilling?",
        "Do you feel a sense of isolation or loneliness?",
        "How often do you experience intrusive or unwanted thoughts?"
    ];

    function createQuestion(questionText, questionNumber) {
        const questionDiv = document.createElement('div');
        questionDiv.id = `question${questionNumber}`;
        questionDiv.classList.add('question-container');
        if (questionNumber === 1) {
            questionDiv.classList.add('active');
        }

        const questionTitle = document.createElement('div');
        questionTitle.classList.add('question-title');
        questionTitle.textContent = `${questionNumber}. ${questionText}`;
        questionDiv.appendChild(questionTitle);

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = `q${questionNumber}`;
        questionDiv.appendChild(input);

        const options = ['Always', 'Often', 'Sometimes', 'Rarely'];
        options.forEach((option, index) => {
            const button = document.createElement('button');
            button.type = 'button';
            button.classList.add('option-button');
            button.textContent = option;
            button.onclick = function() {
                updateProgressAndDisplayNextQuestion(questionNumber, index + 1);
            };
            questionDiv.appendChild(button);
        });

        return questionDiv;
    }

    function updateProgressAndDisplayNextQuestion(questionNumber, selectedOption) {
        const hiddenInput = document.querySelector(`input[name="q${questionNumber}"]`);
        hiddenInput.value = selectedOption;

        const buttons = document.querySelectorAll(`#question${questionNumber} .option-button`);
        buttons.forEach(button => button.classList.remove('active'));
        buttons[selectedOption - 1].classList.add('active');

        const progressBar = document.getElementById('progressBar');
        progressBar.style.width = ((questionNumber / totalQuestions) * 100) + '%';

        setTimeout(() => {
            if (questionNumber < totalQuestions) {
                const currentQuestion = document.getElementById(`question${questionNumber}`);
                currentQuestion.classList.remove('active');
                let nextQuestion = document.getElementById(`question${questionNumber + 1}`);
                if (!nextQuestion) {
                    nextQuestion = createQuestion(questions[questionNumber], questionNumber + 1);
                    document.getElementById('questionForm').insertBefore(nextQuestion, document.getElementById('submitButton'));
                }
                nextQuestion.classList.add('active');
            } else {
                displayFinalButtons();
            }
        }, 300);
    }

    function displayFinalButtons() {
        const submitButton = document.getElementById('submitButton');
        const resetButton = document.createElement('button');
        resetButton.type = 'button';
        resetButton.textContent = 'Reset';
        resetButton.classList.add('btn', 'btn-secondary', 'mx-auto');
        resetButton.onclick = resetForm;
        submitButton.style.display = 'block';
        submitButton.before(resetButton);
    }

    function resetForm() {
        document.getElementById('questionForm').reset();
        document.querySelectorAll('.question-container').forEach(container => {
            container.classList.remove('active');
        });
        document.getElementById('question1').classList.add('active');
        const progressBar = document.getElementById('progressBar');
        progressBar.style.width = '0%';
        document.getElementById('submitButton').style.display = 'none';
        document.querySelector('.btn-secondary').remove();
    }

    const firstQuestion = createQuestion(questions[0], 1);
    document.getElementById('questionForm').insertBefore(firstQuestion, document.getElementById('submitButton'));


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
