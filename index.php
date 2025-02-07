<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pediatric Dose Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Pediatric Dose Calculator</h2>
        <div class="card">
            <div class="card-body">
                <form id="doseCalculator">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="weight" class="form-label">Weight (kg)*</label>
                            <input type="number" step="0.1" class="form-control" id="weight" required>
                        </div>
                        <div class="col-md-3">
                            <label for="age" class="form-label">Age (months)</label>
                            <input type="number" class="form-control" id="age">
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label">Search Medication</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="medicationSearch" placeholder="Start typing...">
                                <div id="searchResults" class="list-group mt-2" style="position: absolute; z-index: 1000; width: 100%;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="formSelect" class="form-label">Form</label>
                            <select class="form-select" id="formSelect" disabled>
                                <option value="">Select form</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="strengthSelect" class="form-label">Strength</label>
                            <select class="form-select" id="strengthSelect" disabled>
                                <option value="">Select strength</option>
                            </select>
                        </div>
                    </div>

                    <div id="calculationResult" class="mt-4"></div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="app.js"></script>
</body>
</html>
