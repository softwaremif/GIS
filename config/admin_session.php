<?php
// session_start();
// if (!$_SESSION['user'])
// {		
?>
<!-- <meta http-equiv="refresh" content="0; url=index"> -->
<?php
// exit;
// }

session_start();
// Define session timeout in seconds (e.g., 1800 seconds = 30 minutes)
$session_timeout = 7200;

// Check if user session is set
if (!isset($_SESSION['user'])) {
    // Redirect to the index page if the user session is not set
    header("Location: index");
    exit;
}

// Check if last activity is set
if (isset($_SESSION['last_activity'])) {
    // Calculate the session's lifetime
    $session_lifetime = time() - $_SESSION['last_activity'];

    // Check if session lifetime has exceeded the timeout period
    if ($session_lifetime > $session_timeout) {
        // Destroy the session and redirect to the index page
        session_unset();
        session_destroy();
        header("Location: index");
        exit;
    }
}

// Update last activity time
$_SESSION['last_activity'] = time();
?>