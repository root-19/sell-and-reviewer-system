<?php
session_start();
session_regenerate_id(true);  // Regenerate session for security
session_unset();
session_destroy();
header("Location: ../../../../../index.php");
exit;
