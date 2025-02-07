<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pediatric Dose Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .calculator-card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .result-card {
            background: #f8f9fa;
            border-left: 4px solid #0d6efd;
        }
        .search-results {
            max-height: 300px;
            overflow-y: auto;
            z-index: 1000;
        }
        .dosage-badge {
            font-size: 1.1rem;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-calculator me-2"></i>Pediatric Dose Calculator
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="admin_formulations.php" class="btn btn-sm btn-danger">
                            <i class="fas fa-lock me-1"></i>Admin Panel
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card calculator-card">
                    <div class="card-header bg-white">
                        <h4 class="mb-0"><i class="fas fa-capsules me-2 text-primary"></i>Dose Calculator</h4>
                    </div>
                    
                    <div class="card-body">
                        <form id="doseCalculator">
                            <div class="row g-3">
                                <!-- Patient Info -->
                                <div class="col-md-6">
                                    <label class="form-label"><i class="fas fa-weight me-1 text-muted"></i>Weight (kg)*</label>
                                    <input type="number" step="0.1" class="form-control form-control-lg" 
                                           id="weight" placeholder="Enter weight" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><i class="fas fa-birthday-cake me-1 text-muted"></i>Age (months)</label>
                                    <input type="number" class="form-control form-control-lg" 
                                           id="age" placeholder="Optional">
                                </div>

                                <!-- Medication Search -->
                                <div class="col-12">
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light"><i class="fas fa-search text-muted"></i></span>
                                        <input type="text" class="form-control" 
                                               id="medicationSearch" placeholder="Search medication...">
                                    </div>
                                    <div id="searchResults" class="list-group search-results mt-1"></div>
                                </div>

                                <!-- Form Selection -->
                                <div class="col-md-6">
                                    <label class="form-label"><i class="fas fa-prescription-bottle me-1 text-muted"></i>Form</label>
                                    <select class="form-select form-select-lg" id="formSelect" disabled>
                                        <option value="">Select form</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><i class="fas fa-flask me-1 text-muted"></i>Strength</label>
                                    <select class="form-select form-select-lg" id="strengthSelect" disabled>
                                        <option value="">Select strength</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Results -->
                            <div class="card result-card mt-4">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-syringe me-2"></i>Recommended Dose</h5>
                                    <div id="calculationResult" class="mt-2">
                                        <p class="text-muted mb-0">Enter patient information to calculate dose</p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="app.js"></script>
</body>
</html>
