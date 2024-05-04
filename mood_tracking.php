<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Tracker</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <?php include('cdn.php'); ?>
    <style type="text/css">
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .mood-form select, .mood-form input {
            width: 100%;
            margin-top: 10px;
        }
        .mood-form button {
            margin-top: 20px; /* Adds margin above the submit button */
        }


    </style>
</head>
<body>
    <?php include('nav.php'); ?>
    <div id="message" class="alert" style="display:none;"></div>
    <div class="container mt-5">
        <h2>Mood Tracker</h2>
        <form id="moodForm" class="mood-form">
            <input type="date" id="moodDate" class="form-control" required>
            <select id="moodRating" class="form-control">
                <option value="1">Very Sad</option>
                <option value="2">Sad</option>
                <option value="3">Neutral</option>
                <option value="4">Happy</option>
                <option value="5">Very Happy</option>
            </select>
            <button type="submit" class="btn btn-primary">Save Mood</button>
        </form>
       <div id="moodChart">
        <h2>Mood Logs</h2>
            <canvas id="sleepChart"></canvas>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
    // Define fetchMoods globally so it can be accessed from anywhere
function fetchMoods() {
    axios.get('api/get_moods.php')
        .then(function(response) {
            const data = response.data;
            if (data.length === 0) {
                console.log('No data received');
                return;
            }
            const labels = data.map(item => item.date);
            const moodRatings = data.map(item => parseInt(item.rating));
            const moodDescriptions = data.map(item => getMoodDescription(item.rating)); // Convert ratings to descriptions
            drawChart(labels, moodRatings, moodDescriptions);
        })
        .catch(error => console.error('Error fetching moods:', error));
}

function getMoodDescription(rating) {
    switch (rating) {
        case 1: return 'Very Sad';
        case 2: return 'Sad';
        case 3: return 'Neutral';
        case 4: return 'Happy';
        case 5: return 'Very Happy';
    }
}

function drawChart(labels, moodRatings, moodDescriptions) {
    const ctx = document.getElementById('sleepChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Mood Rating',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                data: moodRatings,
                fill: false
            }]
        },
        options: {
            tooltips: {
                callbacks: {
                    afterLabel: function(tooltipItem, data) {
                        return moodDescriptions[tooltipItem.index];
                    }
                },
                footerFontStyle: 'normal'
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value, index, values) {
                            return getMoodDescription(value);
                        }
                    }
                }
            }
        }
    });
}

document.getElementById('moodForm').onsubmit = function(event) {
    event.preventDefault();
    const moodDate = document.getElementById('moodDate').value;
    const moodRating = parseInt(document.getElementById('moodRating').value);

    axios.post('api/save_mood.php', {
        date: moodDate,
        rating: moodRating
    })
    .then(function(response) {
        console.log('Saved successfully', response);
        showMessage('Mood saved successfully!', 'alert-success');
        fetchMoods();  // Fetching moods after new data is saved
    })
    .catch(function(error) {
        console.error('Save failed', error);
        showMessage('Failed to save mood.', 'alert-danger');
    });
};

document.addEventListener('DOMContentLoaded', function() {
    fetchMoods();
});

function showMessage(message, type) {
    const messageDiv = document.getElementById('message');
    messageDiv.textContent = message;
    messageDiv.className = `alert ${type}`;
    messageDiv.style.display = 'block';
    setTimeout(() => messageDiv.style.display = 'none', 4000); // Hide the message after 4 seconds
}

    </script>
</body>
</html>
