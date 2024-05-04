<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sleep Improvement Tools</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .audio-controls button, .form button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }
         @media only screen and (max-width: 767px) {
        .container {
 
            height: 100%;
        }

    </style>
</head>
<body>
    <?php include('nav.php'); ?>
    <div class="container my-5">
        <div class="row">
            <div class="col-6">
                <h5>Sleep Improvement Tools</h5>
                <div class="audio-controls">
                    <button class="btn btn-primary" onclick="playSound('rain')">Play Rain Sounds</button>
                    <button class="btn btn-primary mt-2" onclick="playSound('wave')">Play Ocean Waves</button>
                    <button class="btn btn-danger mt-2" onclick="stopSound()">Stop Sounds</button>
                </div>
            </div>
            <div class="col-6">
                <h5>Record Sleep Duration</h5>
                <form action="log_sleep.php" method="post">
                    <input type="date" name="date" required class="form-control mt-2">
                    <input type="number" name="duration" placeholder="Duration in hours" required class="form-control mt-2">
                    <textarea name="notes" class="form-control mt-2" placeholder="Notes about sleep quality"></textarea>
                    <button type="submit" class="btn btn-info mt-2">Save</button>
                </form>
            </div>
            <div class="col-12">
                <h5 class="my-3">Sleep Logs</h5>
            </div>
            <div class="col-md-6">
                <?php if (isset($_SESSION['user_id'])): ?>
                <div class="chart-container" style="height: 400px;">
                    <canvas id="sleepChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="table-container">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Duration (hours)</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                            <tbody id="sleepData"></tbody>
                    </table>
                </div>
                <?php else: ?>
                    <p>Please <a href="login.php">log in</a> to view your sleep logs.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var currentAudio = null; // This will hold the current audio element

        function playSound(type) {
            if (currentAudio) {
                currentAudio.pause();
                currentAudio.currentTime = 0; // Reset the time
            }
            currentAudio = new Audio(`sounds/${type}.mp3`);
            currentAudio.play();
            alert(`Playing ${type} sounds. Relax and enjoy!`);
        }

        function stopSound() {
            if (currentAudio) {
                currentAudio.pause();
                currentAudio.currentTime = 0;
                alert('Sound stopped.');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            fetchSleepDataAndRenderChart();

            function fetchSleepDataAndRenderChart() {
                fetch('api/get_sleep_data.php')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        const labels = data.map(log => log.date);
                        const sleepDuration = data.map(log => log.duration);
                        renderChart(labels, sleepDuration);
                        populateSleepTable(data);
                    })
                    .catch(error => console.error('Error fetching sleep data:', error));
            }

            function renderChart(labels, data) {
                const ctx = document.getElementById('sleepChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Sleep Duration (hours)',
                            backgroundColor: 'rgba(118, 181, 197, 0.2)',
                            borderColor: 'rgba(118, 181, 197, 1)',
                            data: data
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            function populateSleepTable(logs) {
                const tableBody = document.getElementById('sleepData');
                tableBody.innerHTML = ''; // Clear existing entries
                logs.forEach(log => {
                    const row = `<tr>
                        <td>${log.date}</td>
                        <td>${log.duration}</td>
                        <td>${log.notes || ''}</td>
                    </tr>`;
                    tableBody.innerHTML += row;
                });
            }
        });
    </script>
</body>
</html>
