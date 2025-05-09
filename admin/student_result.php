<?php
session_start();
include_once("../fun.inc.php");

if (!isset($_SESSION['spgs_auth'])) {
    header("location: index.php");
    exit();
} else {
    $spgs_auth = $_SESSION['spgs_auth'];
    $user = $spgs_auth[1];
    $adminrec = getRecs("admin_table", "username", $user);
    $role = $adminrec['role'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['matricno'])) {
    $matricno = $_POST['matricno'];

    // Check if the student has paid the portal fee
    $conn2 = new mysqli("localhost", "root", "", "oasis_college_payments");
    $paymentCheckQuery = "SELECT * FROM payment WHERE regno = '$matricno' AND status = 'PAID'";
    $paymentResult = mysqli_query($conn2, $paymentCheckQuery);

    if (mysqli_num_rows($paymentResult) > 0) {
        // Fetch basic bio-data from screened_candidates_2022
        $bioQuery = "SELECT * FROM screened_candidates_2022 WHERE regno = '$matricno'";
        $bioResult = resultnew($bioQuery);
        $bioData = mysqli_fetch_assoc($bioResult);

        // Fetch results from the registration table
        $resultsQuery = "SELECT * FROM registration WHERE matricno = '$matricno'";
        $results = resultnew($resultsQuery);

        // Fetch performance statistics from resulttable
        $performanceQuery = "SELECT * FROM resulttable WHERE matricno = '$matricno'";
        $performanceResult = resultnew($performanceQuery);
        $performanceData = mysqli_fetch_assoc($performanceResult);
    } else {
        $error = "Portal fee has not been paid for this student.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Student Academic Performance</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <?php include_once("header.php"); ?>
    <?php include_once("sidebar.php"); ?>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Student Academic Performance</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admindashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Student Academic Performance</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Enter Student Matric Number</h5>
                            <form method="post">
                                <div class="row mb-3">
                                    <label for="matricno" class="col-sm-2 col-form-label">Matric Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="matricno" name="matricno" required>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Fetch Result</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php if (isset($bioData) && isset($results) && isset($performanceData)): ?>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Basic Information</h5>
                                <p><strong>Name:</strong> <?= $bioData['surname'] . " " . $bioData['onames'] ?></p>
                                <p><strong>Programme:</strong> <?= $bioData['programme'] ?></p>
                                <p><strong>Department:</strong> <?= $bioData['dept'] ?></p>
                                <p><strong>Matric Number:</strong> <?= $bioData['regno'] ?></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Results</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Course Code</th>
                                            <th>Course Title</th>
                                            <th>Unit</th>
                                            <th>CA</th>
                                            <th>Exam</th>
                                            <th>Total</th>
                                            <th>Grade</th>
                                            <th>Faculty</th>
                                            <th>Dept</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sn = 1;
                                        while ($result = mysqli_fetch_assoc($results)) {
                                            $grade = calculateGrade($result['ca'], $result['exam']);
                                            echo "<tr>
                                                <td>{$sn}</td>
                                                <td>{$result['courses']}</td>
                                                <td>{$result['courseTitle']}</td>
                                                <td>{$result['units']}</td>
                                                <td>{$result['ca']}</td>
                                                <td>{$result['exam']}</td>
                                                <td>{$result['total']}</td>
                                                <td>{$grade}</td>
                                                <td>{$result['faculty']}</td>
                                                <td>{$result['dept']}</td>
                                            </tr>";
                                            $sn++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Performance Summary</h5>
                                <p><strong>Total Credit Carried (TCC):</strong> <?= $performanceData['tlu'] ?></p>
                                <p><strong>Total Credit Earned (TCE):</strong> <?= $performanceData['clu'] ?></p>
                                <p><strong>CGPA:</strong> <?= $performanceData['cgpa'] ?></p>
                                <p><strong>Class of Degree:</strong> <?= $performanceData['rem'] ?></p>
                            </div>
                        </div>
                    <?php elseif (isset($error)): ?>
                        <div class="alert alert-danger">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>
    <?php include_once("footer.php"); ?>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>

<?php
function calculateGrade($ca, $exam) {
    $total = $ca + $exam;
    if ($total >= 70) return 'A';
    if ($total >= 60) return 'B';
    if ($total >= 50) return 'C';
    if ($total >= 45) return 'D';
    if ($total >= 40) return 'E';
    return 'F';
}
?>
