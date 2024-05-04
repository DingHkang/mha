<?php
session_start();

$total_score = 0;
for ($i = 1; $i <= 10; $i++) {
    $total_score += isset($_POST["q$i"]) ? (int) $_POST["q$i"] : 0;
}

// Define condition level based on total score
if ($total_score <= 20) {
    $condition_level = "Low";
} elseif ($total_score <= 30) {
    $condition_level = "Moderate";
} elseif ($total_score <= 40) {
    $condition_level = "High";
} else {
    $condition_level = "Very High";
}

// Display assessment results and condition level
echo "<h2>Assessment Results</h2>";
echo "<p>Your total score: $total_score</p>";
echo "<p>Condition Level: $condition_level</p>";

// Provide personalized recommendations based on condition level
switch ($condition_level) {
    case "Low":
        echo "<p>Your mental health condition is relatively low. Keep up with healthy habits and seek support if needed.</p>";
        break;
    case "Moderate":
        echo "<p>Your mental health condition is moderate. Consider implementing more self-care practices and seeking support.</p>";
        break;
    case "High":
        echo "<p>Your mental health condition is high. It's essential to prioritize self-care and seek professional help if necessary.</p>";
        break;
    case "Very High":
        echo "<p>Your mental health condition is very high. Please seek immediate professional assistance and support.</p>";
        break;
}

?>
