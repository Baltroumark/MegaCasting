<?php
session_start();
session_destroy();
header("Location: ../php/auth.php");
exit();
