<?php
header('Content-Type: application/json');
include_once "Connection.php";

$userid = isset($_POST['userid']) ? trim($_POST['userid']) : '';
if (empty($userid)) {
    echo json_encode(["status" => "error", "message" => "User ID is required"]);
    exit();
}

$BrideName = isset($_POST['BrideName']) ? trim($_POST['BrideName']) : '';
$GroomName = isset($_POST['GroomName']) ? trim($_POST['GroomName']) : '';   
$BrideTpNo = isset($_POST['BrideTpNo']) ? trim($_POST['BrideTpNo']) : '';
$GroomTpNo = isset($_POST['GroomTpNo']) ? trim($_POST['GroomTpNo']) : '';
$IsGroomLoggedIn = isset($_POST['IsGroomLoggedIn']) ? trim($_POST['IsGroomLoggedIn']) : '';
$IsBrideLoggedIn = isset($_POST['IsBrideLoggedIn']) ? trim($_POST['IsBrideLoggedIn']) : '';
$Prefered_Date = isset($_POST['Prefered_Date']) ? trim($_POST['Prefered_Date']) : '';
$Budget_Range = isset($_POST['Budget_Range']) ? trim($_POST['Budget_Range']) : '';
$Guest_count = isset($_POST['Guest_count']) ? trim($_POST['Guest_count']) : '';
$Preferred_Location = isset($_POST['Preferred_Location']) ? trim($_POST['Preferred_Location']) : '';
$Preferred_District = isset($_POST['Preferred_District']) ? trim($_POST['Preferred_District']) : '';
$Preferred_City = isset($_POST['Preferred_City']) ? trim($_POST['Preferred_City']) : '';
$Venue_Type = isset($_POST['Venue_Type']) ? trim($_POST['Venue_Type']) : '';
$ceremony_type = isset($_POST['ceremony_type']) ? trim($_POST['ceremony_type']) : '';

$Updatedcounts = 0;
$faildcounts = 0;

if ($BrideName != '') {
    $stmt = $conn->prepare("UPDATE `client-preferences` SET BrideName=? WHERE userid=?");
    $stmt->bind_param("si", $BrideName, $userid);
    if ($stmt->execute()) $Updatedcounts++; else $faildcounts++;
    $stmt->close();
}

if ($GroomName != '') {
    $stmt = $conn->prepare("UPDATE `client-preferences` SET GroomName=? WHERE userid=?");
    $stmt->bind_param("si", $GroomName, $userid);
    if ($stmt->execute()) $Updatedcounts++; else $faildcounts++;
    $stmt->close();
}

if ($BrideTpNo != '') {
    $stmt = $conn->prepare("UPDATE `client-preferences` SET BrideTpNo=? WHERE userid=?");
    $stmt->bind_param("si", $BrideTpNo, $userid);
    if ($stmt->execute()) $Updatedcounts++; else $faildcounts++;
    $stmt->close();
}

if ($GroomTpNo != '') {
    $stmt = $conn->prepare("UPDATE `client-preferences` SET GroomTpNo=? WHERE userid=?");
    $stmt->bind_param("si", $GroomTpNo, $userid);
    if ($stmt->execute()) $Updatedcounts++; else $faildcounts++;
    $stmt->close();
}

if ($IsGroomLoggedIn != '') {
    $stmt = $conn->prepare("UPDATE `client-preferences` SET IsGroomLoggedIn=? WHERE userid=?");
    $stmt->bind_param("si", $IsGroomLoggedIn, $userid);
    if ($stmt->execute()) $Updatedcounts++; else $faildcounts++;
    $stmt->close();
}

if ($IsBrideLoggedIn != '') {
    $stmt = $conn->prepare("UPDATE `client-preferences` SET IsBrideLoggedIn=? WHERE userid=?");
    $stmt->bind_param("si", $IsBrideLoggedIn, $userid);
    if ($stmt->execute()) $Updatedcounts++; else $faildcounts++;
    $stmt->close();
}

if ($Prefered_Date != '') {
    $stmt = $conn->prepare("UPDATE `client-preferences` SET Prefered_Date=? WHERE userid=?");
    $stmt->bind_param("si", $Prefered_Date, $userid);
    if ($stmt->execute()) $Updatedcounts++; else $faildcounts++;
    $stmt->close();
}

if ($Budget_Range != '') {
    $stmt = $conn->prepare("UPDATE `client-preferences` SET Budget_Range=? WHERE userid=?");
    $stmt->bind_param("si", $Budget_Range, $userid);
    if ($stmt->execute()) $Updatedcounts++; else $faildcounts++;
    $stmt->close();
}

if ($Guest_count != '') {
    $stmt = $conn->prepare("UPDATE `client-preferences` SET Guest_count=? WHERE userid=?");
    $stmt->bind_param("si", $Guest_count, $userid);
    if ($stmt->execute()) $Updatedcounts++; else $faildcounts++;
    $stmt->close();
}

if ($Preferred_Location != '') {
    $stmt = $conn->prepare("UPDATE `client-preferences` SET Preferred_Location=? WHERE userid=?");
    $stmt->bind_param("si", $Preferred_Location, $userid);
    if ($stmt->execute()) $Updatedcounts++; else $faildcounts++;
    $stmt->close();
}

if ($Preferred_District != '') {
    $stmt = $conn->prepare("UPDATE `client-preferences` SET Preferred_District=? WHERE userid=?");
    $stmt->bind_param("si", $Preferred_District, $userid);
    if ($stmt->execute()) $Updatedcounts++; else $faildcounts++;
    $stmt->close();
}

if ($Preferred_City != '') {
    $stmt = $conn->prepare("UPDATE `client-preferences` SET Preferred_City=? WHERE userid=?");
    $stmt->bind_param("si", $Preferred_City, $userid);
    if ($stmt->execute()) $Updatedcounts++; else $faildcounts++;
    $stmt->close();
}

if ($Venue_Type != '') {
    $stmt = $conn->prepare("UPDATE `client-preferences` SET Venue_Type=? WHERE userid=?");
    $stmt->bind_param("si", $Venue_Type, $userid);
    if ($stmt->execute()) $Updatedcounts++; else $faildcounts++;
    $stmt->close();
}

if ($ceremony_type != '') {
    $stmt = $conn->prepare("UPDATE `client-preferences` SET ceremony_type=? WHERE userid=?");
    $stmt->bind_param("si", $ceremony_type, $userid);
    if ($stmt->execute()) $Updatedcounts++; else $faildcounts++;
    $stmt->close();
}

echo json_encode([
    "success" => true,
    "message" => "Update completed",
    "updated" => $Updatedcounts,
    "failed" => $faildcounts
]);


$conn->close();
?>
