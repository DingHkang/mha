<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <?php
    include('nav.php');

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php'); // Redirect if not logged in
        exit();
    }
    $user_id = $_SESSION['user_id'];

    // Fetch current user data
    $current_data_sql = "SELECT username, email FROM users WHERE user_id = '$user_id'";
    $current_data_result = $conn->query($current_data_sql);
    $current_data = $current_data_result->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
        $new_email = $conn->real_escape_string($_POST['new_email']);
        $new_name = $conn->real_escape_string($_POST['new_name']);
        $new_password = $conn->real_escape_string($_POST['new_password']);

        $update_sql = "UPDATE users SET email = '$new_email', username = '$new_name' WHERE user_id = '$user_id'";
        if (!empty($new_password)) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_sql = "UPDATE users SET email = '$new_email', username = '$new_name', password = '$hashed_password' WHERE user_id = '$user_id'";
        }
        if ($conn->query($update_sql) === TRUE) {
            echo "<div class='alert alert-success'>Profile updated successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error updating profile: " . $conn->error . "</div>";
        }
    }

    // Fetch user achievements
    $achievements_sql = "SELECT achievement_name, date_achieved FROM achievements WHERE user_id = '$user_id'";
    $achievements_result = $conn->query($achievements_sql);

    // Fetch score history for the user
    $scores_sql = "SELECT score, test_date FROM scores WHERE user_id = '$user_id' ORDER BY test_date DESC";
    $scores_result = $conn->query($scores_sql);

    // Close the database connection
    $conn->close();
    ?>
    <style type="text/css">
        @media only screen and (max-width: 767px) {
            .navbar-expand-lg {
                display: none;
            }
        .container {
 
            margin-bottom: 200px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Your Profile</h2>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Current Information</h4>
            <p class="card-text"><strong>Name:</strong> <?= $current_data['username']; ?></p>
            <p class="card-text"><strong>Email:</strong> <?= $current_data['email']; ?></p>

            <h4 class="mt-4">Update Profile</h4>
            <form method="POST">
                <div class="form-group">
                    <label for="new_name">New Name:</label>
                    <input type="text" class="form-control" id="new_name" name="new_name" required value="<?= $current_data['username']; ?>">
                </div>
                <div class="form-group">
                    <label for="new_email">New Email:</label>
                    <input type="email" class="form-control" id="new_email" name="new_email" required value="<?= $current_data['email']; ?>">
                </div>
                <div class="form-group">
                    <label for="new_password">New Password (leave blank to keep current):</label>
                    <input type="password" class="form-control" id="new_password" name="new_password">
                </div>
                <button type="submit" class="btn btn-primary" name="update_profile">Update Profile</button>
            </form>
        </div>
    </div>

    <h3 class="mt-4">Your Achievements</h3>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Achievement</th>
                    <th>Date Achieved</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($achievements_result->num_rows > 0) {
                    while ($row = $achievements_result->fetch_assoc()) {
                        echo "<tr><td>" . $row['achievement_name'] . "</td><td>" . date("F j, Y", strtotime($row['date_achieved'])) . "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No achievements yet.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <h3 class="mt-4">Score History</h3>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Score</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($scores_result->num_rows > 0): ?>
                    <?php while ($row = $scores_result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['score']; ?></td>
                            <td><?= date("F j, Y, g:i a", strtotime($row['test_date'])); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="2">No scores found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <button class="btn btn-secondary mt-4" onclick="location.href='logout.php'">Logout</button>
</div>
</body>
</html>
