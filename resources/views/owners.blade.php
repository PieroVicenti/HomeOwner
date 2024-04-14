<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <!-- Button to toggle between card and JSON format -->
        <div class="row mb-3">
            <div class="col-md-12 text-right">
                <button class="btn btn-primary" id="toggleButton">Toggle JSON View</button>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12 text-right">
                <a class="btn btn-primary" href="/">Home</a>
            </div>
        </div>

        <!-- Display data in card format -->
        <div class="row" id="cardView">
            @foreach ($homeowners as $homeowner)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header">{{ $homeowner->title }}</div>
                        <div class="card-body">
                            <p><strong>First Name:</strong> {{ $homeowner->first_name }}</p>
                            <p><strong>Last Name:</strong> {{ $homeowner->last_name }}</p>
                            <p><strong>Initials:</strong> {{ $homeowner->initials }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Display data in JSON format (hidden by default) -->
        <div class="row" id="jsonView" style="display: none;">
            <div class="col-md-12">
                <pre>{{ json_encode($homeowners, JSON_PRETTY_PRINT) }}</pre>
            </div>
        </div>
    </div>

<!-- Script to toggle between card and JSON format -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var cardView = document.getElementById('cardView');
        var jsonView = document.getElementById('jsonView');
        var toggleButton = document.getElementById('toggleButton');

        toggleButton.addEventListener('click', function() {
            // Toggle between card and JSON views
            cardView.style.display = cardView.style.display === 'none' ? 'flex' : 'none';
            jsonView.style.display = jsonView.style.display === 'none' ? 'block' : 'none';

            // If card view is displayed, reset JSON view to hidden
            if (cardView.style.display === 'flex') {
                jsonView.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>
