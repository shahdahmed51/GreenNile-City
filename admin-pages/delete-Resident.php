<?php

require_once "../config/connection.php";


// Get resident ID
$residentId = $_GET['id'] ?? null;


// Check ID
if (!$residentId || !is_numeric($residentId)) {
    die("Invalid resident ID.");
}


// Start transaction
mysqli_begin_transaction($conn);

try {

    // -----------------------------------
    // 1. Check resident exists
    // -----------------------------------

    $sql = "SELECT resident_id, full_name
            FROM residents
            WHERE resident_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        throw new Exception(mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "i", $residentId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $resident = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);


    if (!$resident) {
        throw new Exception("Resident not found.");
    }


    // -----------------------------------
    // 2. Delete bills belonging to resident
    // -----------------------------------

    $sql = "DELETE FROM bills
            WHERE resident_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        throw new Exception(mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "i", $residentId);

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception(mysqli_stmt_error($stmt));
    }

    mysqli_stmt_close($stmt);


    // -----------------------------------
    // 3. Delete resident
    // -----------------------------------

    $sql = "DELETE FROM residents
            WHERE resident_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        throw new Exception(mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "i", $residentId);

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception(mysqli_stmt_error($stmt));
    }

    mysqli_stmt_close($stmt);


    // -----------------------------------
    // Everything succeeded
    // -----------------------------------

    mysqli_commit($conn);

    header("Location: resident.php?deleted=1");
    exit;


} catch (Exception $e) {

    // Undo everything if something failed
    mysqli_rollback($conn);

    die("Failed to delete resident: " . $e->getMessage());
}