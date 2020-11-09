<?php
function write_variable($name, $value) {
    $variable = "$" . $name . " = '" . $value . "';\n";
    return $variable;
}

function emptyInput($name, $uid, $email, $pwd, $pwdrepeat) {
    $result;
    if (empty($name) || empty($uid) || empty($email) || empty($pwd) || empty($pwdrepeat)){
        $result = TRUE;
    } else {
        $result = FALSE;
    }
    return $result;
}

function emptyInputLogin($uid, $pwd) {
    $result;
    if (empty($uid) || empty($pwd)){
        $result = TRUE;
    } else {
        $result = FALSE;
    }
    return $result;
}

function invalidUid($uid) {
    $result;
    if (!preg_match('#^[\\w-]{3,20}$#', $uid)) {
        $result = TRUE;
    } else {
        $result = FALSE;
    }
    return $result;
}

function invalidEmail($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function pwdNomatch($pwd, $pwdrepeat) {
    $result;
    if ($pwd !== $pwdrepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function pwdNotstrong($pwd) {
    $result;
    if (strlen($pwd) < 8) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function uidExists($conn, $uid, $email) {
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtError");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $uid, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
        $result = true;
        return $result;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $uid, $pwd) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtError");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $uid, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../signup.php?usercreated=yes");
    exit();
}

function loginUser($conn, $uid, $pwd, $stay, $pathPrelogin) {
    $uidExists = uidExists($conn, $uid, $uid);

    if ($uidExists === false) {
        header("location: ../login.php?error=usernoexist");
        exit();
    }

    if ($uidExists['usersFree'] != 1) {
        header("location: ../login.php?error=pending");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../login.php?error=wrongpwd");
        exit();
    } else if ($checkPwd === true) {

        $sql = "INSERT INTO logins (loginsUID) VALUES (?) ON DUPLICATE KEY UPDATE loginsTIME = NOW();";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../login.php?error=stmtError");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $uid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        setcookie("userUid", $uid, time() + 86400, "/");

        if (isset($pathPrelogin)) {
            header("location: ../.." . $pathPrelogin);
            exit();
        } else {
            header("location: ../index.php");
            exit();
        }
    }
}

function loggedIn($uid) {
    require_once 'config.inc.php';
    if (!isset($_COOKIE["userUid"])) {
        header("location: /admin/login.php?pathPrelogin=" . $_SERVER["REQUEST_URI"]);
        exit();
    }
    $sql = "SELECT * FROM logins WHERE loginsUID = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: /admin/signup.php?error=stmtError");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $uid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($resultData);

    if (strtotime($row["loginsTIME"]) < strtotime("-60 minutes")) {
        header("location: /admin/login.php?pathPrelogin=" . $_SERVER["REQUEST_URI"]);
        exit();
    } else if (!isset($row["loginsTIME"])) {
        header("location: /admin/login.php?pathPrelogin=" . $_SERVER["REQUEST_URI"]);
        exit();
    } else {
        $result = true;
        $sql = "INSERT INTO logins (loginsUID) VALUES (?) ON DUPLICATE KEY UPDATE loginsTIME = NOW();";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../login.php?error=stmtError");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $uid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    mysqli_stmt_close($stmt);
}



// ERFASSEN

function erfasenEmpty($sheetType, $sheetPLZ, $sheetNosig, $sheetID) {
    $result;
    if (empty($sheetType) || empty($sheetPLZ) || empty($sheetNosig) || empty($sheetID)){
        $result = TRUE;
    } else {
        $result = FALSE;
    }
    return $result;
}

function sheetIDexists($conn, $sheetID) {
    $sql = "SELECT * FROM sheet WHERE sheetID = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../sheets/?error=stmtError");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $sheetID);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        $result = true;
        return $result;
    } else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function bogenIDwrong($conn, $sheetBogenID) {
    $sql = "SELECT * FROM bogen WHERE bogenID = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../sheets/?error=stmtError");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $sheetBogenID);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        $result = false;
        return $result;
    } else {
        $result = true;
        return $result;
    }
    mysqli_stmt_close($stmt);
}


function calcBogen($conn, $sheetBogenID, $sheetNosig) {
    $sql = "UPDATE bogen SET returned = returned + ? WHERE bogenID = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../sheets/?error=stmtError");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $sheetNosig, $sheetBogenID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function addSheet($conn, $sheetBogenID, $sheetPLZ, $sheetType, $sheetNosig, $sheetID, $sheetUser) {
    $sql = "INSERT INTO sheet (sheetID, sheetBogenID, sheetPLZ, sheetType, sheetNosig, sheetUser) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../sheets/?error=stmtError");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssss", $sheetID, $sheetBogenID, $sheetPLZ, $sheetType, $sheetNosig, $sheetUser);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../sheets/?sheetadded=yes");
    exit();
}

// Edit sheet

function updateBogen($conn, $sheetBogenID, $sheetUpdateNosig) {
    $sql = "UPDATE bogen SET returned = returned + ? WHERE bogenID = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../sheets/?error=stmtError");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $sheetUpdateNosig, $sheetBogenID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function updateSheet($conn, $sheetPLZ, $sheetType, $sheetNosig, $sheetID, $sheetUser) {
    $sql = "UPDATE sheet SET sheetPLZ = ?, sheetType = ?, sheetNosig = ?, sheetUser = ? WHERE sheetID = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../sheets/editsheet.php?error=stmtError");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss", $sheetPLZ, $sheetType, $sheetNosig, $sheetUser, $sheetID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../sheets/editsheet.php?sheetupdated=yes");
    exit();
}

function deleteSheet($conn, $sheetID) {
    $sql = "DELETE FROM sheet WHERE sheetID = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../sheets/?error=stmtError");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $sheetID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    header("location: ../sheets/mysheets.php?sheetupdated=deleted");
    exit();
}


// Free Users

function userNoexist($conn, $usersID) {
    $sql = "SELECT * FROM users WHERE usersID = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../users/?error=stmtError&errorcode" .  mysqli_stmt_error());
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $usersID);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        $result = false;
        return $result;
    } else {
        $result = true;
        return $result;
    }

    mysqli_stmt_close($stmt);
} 

function freeUser($conn, $usersID) {
    $sql = "UPDATE users SET usersFree=1 WHERE usersID = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../users/?error=stmtError&errorcode" .  mysqli_stmt_error());
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $usersID);
    mysqli_stmt_execute($stmt);

    header("location: ../users/?freed=" . $usersID);
    mysqli_stmt_close($stmt);
}

// Delete User

function deleteUser($conn, $usersID) {
    $sql = "DELETE FROM users WHERE usersID = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../users/?error=stmtError&errorcode" .  mysqli_stmt_error());
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $usersID);
    mysqli_stmt_execute($stmt);

    header("location: ../users/?deleted=" . $usersID);
    mysqli_stmt_close($stmt);
}

// Update PW

function fieldEmptyPW($currPW, $newPW, $newPWre) {
    if (empty($currPW) || empty($newPW) || empty($newPWre)) {
        $result = true;
        return $result;
    } else {
        $result = false;
        return $result;
    }
}

function noMatch($newPW, $newPWre) {
    if ($newPW !== $newPWre) {
        $result = true;
        return $result;
        exit();
    } else {
        $result = false;
        return $result;
    }
}

function pwWrong($conn, $currPW, $userUid) {
    $uidExists = uidExists($conn, $userUid, $userUid);

    $currentPass = $uidExists["usersPwd"];
    $checkPwd = password_verify($currPW, $currentPass);

    if ($checkPwd === false) {
        $result = true;
        return $result;
        mysqli_stmt_close($stmt);
        exit();
    } else if ($checkPwd === true) {
        $result = false;
        return $result;
        mysqli_stmt_close($stmt);
    }
}

function updatePW($conn, $userUid, $newPW) {
    $sql = "UPDATE users SET usersPwd=? WHERE usersUid=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../users/setpw.php?error=stmtError");
        exit();
    }

    $hashedPwd = password_hash($newPW, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ss", $hashedPwd, $userUid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../users/setpw.php?success=" . $userUid);
    exit();
}