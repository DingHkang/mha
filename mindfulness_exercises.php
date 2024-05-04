<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mindfulness Exercises</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <?php include('cdn.php'); ?>
    <style>
        body {
            background-color: #f4f4f9;
            color: #333;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .media-library video {
            width: 100%; /* Full width of the container */
            border-radius: 8px;
        }
        .btn-info {
            width: 100%; /* Make buttons full width */
            margin-top: 10px; /* Margin top for all buttons except the first */
        }
    </style>
</head>
<body>
    <?php include('nav.php'); ?>
    <div class="container mt-5">
        <h2 class="text-center">Mindfulness Exercises</h2>
        <div class="exercise-list text-center">
            <button class="btn btn-info" onclick="playExercise('meditation')">Start Guided Meditation</button>
            <button class="btn btn-info" onclick="playExercise('breathing')">Start Breathing Exercise</button>
        </div>
        <div class="media-library mt-4">
            <video id="meditationVideo" controls style="display: none;">
                <source src="videos/meditation.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>

    <script type="text/javascript">
        function playExercise(type) {
            const videoElement = document.getElementById('meditationVideo');
            videoElement.style.display = 'block'; // Show the video element when playing
            if (type === 'meditation') {
                videoElement.src = 'videos/meditation.mp4';
            } else if (type === 'breathing') {
                videoElement.src = 'videos/breathing.mp4';
            }
            videoElement.play();
        }
    </script>
</body>
</html>
