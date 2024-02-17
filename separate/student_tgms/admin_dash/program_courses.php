<?php
// Database connection
include('../db_connection.php');

// Start session
session_start();

// Function to fetch scores for a given module
function fetchScoresForModule($con, $modCode) {
    $scores = [];
    $query = "SELECT s.regNo, s.surname, s.givenNames, r.CA, r.FE FROM student s LEFT JOIN results r ON s.regNo = r.regNo AND r.modCode = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 's', $modCode);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $scores[$row['regNo']] = $row;
    }
    return $scores;
}

// Handle form submission
if (isset($_POST['submit_scores'])) {
    // Validate and process submitted scores
    $modCode = $_POST['module_code'];
    foreach ($_POST['students'] as $regNo => $scores) {
        $caScore = $scores['ca'];
        $faScore = $scores['fa'];

        // Update or insert scores into the database
        // Add your SQL queries here to update or insert scores

        $checkQuery = "SELECT * FROM results WHERE regNo = ? AND modCode = ?";
        $stmtCheck = mysqli_prepare($con, $checkQuery);
        mysqli_stmt_bind_param($stmtCheck, 'is', $regNo, $modCode);
        mysqli_stmt_execute($stmtCheck);
        $resultCheck = mysqli_stmt_get_result($stmtCheck);

        if (mysqli_num_rows($resultCheck) > 0) {
            $updateQuery = "UPDATE results SET CA = ?, FE = ? WHERE regNo = ? AND modCode = ?";
            $stmtUpdate = mysqli_prepare($con, $updateQuery);
            mysqli_stmt_bind_param($stmtUpdate, 'iiis', $caScore, $faScore, $regNo, $modCode);
            mysqli_stmt_execute($stmtUpdate);
        } else {
            $insertQuery = "INSERT INTO results (regNo, modCode, CA, FE) VALUES (?, ?, ?, ?)";
            $stmtInsert = mysqli_prepare($con, $insertQuery);
            mysqli_stmt_bind_param($stmtInsert, 'isii', $regNo, $modCode, $caScore, $faScore);
            mysqli_stmt_execute($stmtInsert);
        }
    }
}

// Delete student if delete request is received
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['regNo'])) {
    $regNoToDelete = $_GET['regNo'];
    $deleteQuery = "DELETE FROM student WHERE regNo = ?";
    $stmtDelete = mysqli_prepare($con, $deleteQuery);
    mysqli_stmt_bind_param($stmtDelete, 'i', $regNoToDelete);
    mysqli_stmt_execute($stmtDelete);
    // Redirect back to this page after deletion or perform necessary actions
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

// Fetch all modules from the database
function fetchModules($con) {
    $modules = [];
    $query = "SELECT modCode, modName FROM module";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $modules[$row['modCode']] = $row['modName'];
    }
    return $modules;
}

// Get the selected module code from the URL
$selectedModule = $_GET['module_code'] ?? '';

// Fetch scores for the selected module
$scores = $selectedModule ? fetchScoresForModule($con, $selectedModule) : [];

// Fetch all modules
$modules = fetchModules($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add/Edit Student Scores</title>
    <!-- Include your CSS and JS files -->
</head>
<body>
    <!-- Your HTML code for displaying the form -->
    <form method="POST">
        <label for="module_code">Select Module:</label>
        <select name="module_code" id="module_code" onchange="this.form.submit()">
            <option value="">Select a Module</option>
            <?php foreach ($modules as $code => $name): ?>
                <option value="<?php echo $code; ?>" <?php if ($selectedModule == $code) echo 'selected'; ?>><?php echo $name; ?></option>
            <?php endforeach; ?>
        </select>

        <?php if ($selectedModule && !empty($scores)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Reg. No</th>
                        <th>Name</th>
                        <th>CA Score (0-60)</th>
                        <th>FA Score (0-40)</th>
                        <th>Status</th> <!-- New column for status -->
                        <th>Action</th> <!-- New column for action buttons -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($scores as $regNo => $score): ?>
                        <tr>
                            <td><?php echo $score['regNo']; ?></td>
                            <td><?php echo $score['surname'] . ' ' . $score['givenNames']; ?></td>
                            <td><input type="number" name="students[<?php echo $regNo; ?>][ca]" value="<?php echo $score['CA'] ?? ''; ?>" min="0" max="60"></td>
                            <td><input type="number" name="students[<?php echo $regNo; ?>][fa]" value="<?php echo $score['FE'] ?? ''; ?>" min="0" max="40"></td>
                            <td>
                                <?php
                                    // Determine status based on CA and FA scores
                                    $caScore = $score['CA'] ?? 0;
                                    $faScore = $score['FE'] ?? 0;
                                    if ($caScore < 23) {
                                        echo "<span style='color: red;'>Retake</span>";
                                    } elseif ($faScore < 16) {
                                        echo "<span style='color: gray;'>Carry</span>";
                                    } else {
                                        echo "<span style='color: green;'>Pass</span>";
                                    }
                                ?>
                            </td>
                            <td>
                                <!-- Action buttons -->
                                <a href="?action=delete&regNo=<?php echo $regNo; ?>" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" name="submit_scores">Submit Scores</button>
        <?php elseif ($selectedModule): ?>
            <p>No students found for this module.</p>
        <?php endif; ?>
    </form>
</body>
</html>
