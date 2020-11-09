<?php
setcookie("userUid", "", time() - 3600, "/");
header("location: ../login.php?message=logoutsuccess");
exit();