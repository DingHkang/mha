<?php
include('db.php'); // Assuming db.php contains your database connection setup

$sql = "SELECT name, imageUrl, linkUrl, description FROM activities";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Wellness Activities</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            text-align: center;
        }

        .card-img-top {
            width: 100%;
            height: auto;
        }
        
    </style>
</head>
<body>
    <?php include('nav.php'); ?>
    <div class="container">
        <div class="row mt-4">
            <?php if ($result->num_rows > 0): ?>
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
            <?php else: ?>
                <div class="col-12">
                    <p>No activities found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    
</body>
</html>

<?php
$conn->close();
?>
