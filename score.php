<?php
include('db.php'); // Ensure your database connection file is correctly included

// Calculate total score from the form data
$total_score = 0;
for ($i = 1; $i <= 10; $i++) {
    $total_score += isset($_POST["q$i"]) ? (int)$_POST["q$i"] : 0;
}

$display_score = ($total_score / 40) * 100; // Map the total score to a 0-100 range

// Condition logic
$condition_level = '';
$recommendation = '';
if  ($total_score == 0) {
    $condition_level = "0";
    $recommendation = "Test Survey Questions To Know Your Health Condition.";
} elseif ($total_score <= 20) {
    $condition_level = "Low";
    $recommendation = "Keep up with healthy habits and seek support if needed.";
} elseif ($total_score <= 30) {
    $condition_level = "Moderate";
    $recommendation = "Consider implementing more self-care practices and seeking support.";
} elseif ($total_score <= 40) {
    $condition_level = "High";
    $recommendation = "Prioritize self-care and seek professional help if necessary.";
} else {
    $condition_level = "Very High";
    $recommendation = "Seek immediate professional assistance and support.";
}

// Check if the save button was pressed
if (isset($_POST['save']) && isset($_SESSION['user_id'])) {
    // Save the score in the database if the user is logged in
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("INSERT INTO scores (user_id, score) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $total_score);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Score Speedometer</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .speedometer-container {
            width: 300px;
            height: 150px;
            position: relative;
            background-image: url('img/meter.png');
            background-size: cover;
            background-repeat: no-repeat;
            margin: 30px auto;
        }

        .needle {
            width: 2px;
            height: 75px;
            background-color: red;
            position: absolute;
            bottom: 0;
            left: 50%;
            transform-origin: bottom;
            transform: rotate(-90deg);
            transition: transform 1s ease;
        }

        .value {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 1.5em;
            color: #333;
        }

        .footer {
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 30px;
            color: #333;
            margin-top: 20px;
        }

        .condition-level, .recommendation {
            flex: 1;
            border-radius: 5px;
        }

        .condition-level {
            background-color: #ffa07a; /* Light coral */
            color: white;
            font-weight: bold;
        }

        .recommendation {
            background-color: #fafad2; /* Light goldenrod yellow */
            color: #333;
            font-weight: normal;
        }
        @media only screen and (max-width: 767px) {
            body{
                background-color: #fff;;
            }
        }
    </style>
</head>
<body>
    <?php include('nav.php'); ?>
    <div class="container">
    <div class="speedometer-container">
        <div class="needle"></div>
        <div class="value"><?php echo round($display_score); ?></div>
    </div>
    <div class="footer">
        <div class="row">
            <div class="condition-level col-12 my-2">
                Condition: <?php echo $condition_level; ?>
            </div>
            <div class="recommendation col-12 my-2">
                <?php echo $recommendation; ?>
            </div>
        <form method="POST" action="save_score.php">
            <input type="hidden" name="total_score" value="<?php echo $total_score; ?>">
            <?php if (isset($_SESSION['user_id'])): ?>
                <button type="submit" name="save" class="btn btn-primary">Save Score</button>
            <?php else: ?>
                <button type="button" onclick="window.location='login.php'" class="btn btn-primary">Log in to Save Score</button>
            <?php endif; ?>
        </form>
        <div class="container-fluid">
        <?php
            // Display activities based on score
            $sql = "SELECT name, imageUrl, linkUrl, description FROM activities WHERE minScore <= $total_score AND maxScore >= $total_score";
            $result = $conn->query($sql);
            if ($result->num_rows > 0): ?>
                <div class="row mt-4">
                    <?php while($row = $result->fetch_assoc()): ?>
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <img src="<?php echo htmlspecialchars($row['imageUrl']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="<?php echo htmlspecialchars($row['linkUrl']); ?>.php"><?php echo htmlspecialchars($row['name']); ?></a></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>No activities found suitable for your condition level.</p>
            <?php endif; ?>
        </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const needle = document.querySelector('.needle');

            function updateSpeedometer(score) {
                const angle = (score / 100) * 180 - 90;
                needle.style.transform = `rotate(${angle}deg)`;
            }

            updateSpeedometer(<?php echo $display_score; ?>);
        });
    </script>

</body>
</html>
