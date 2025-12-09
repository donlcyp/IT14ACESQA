<?php
echo "<h2>GD Extension Status</h2>";
if (extension_loaded('gd')) {
    echo "<p style='color: green;'><strong>✓ GD is LOADED</strong></p>";
    $info = gd_info();
    echo "<pre>" . print_r($info, true) . "</pre>";
} else {
    echo "<p style='color: red;'><strong>✗ GD is NOT loaded</strong></p>";
    echo "<p>This is why PDF generation fails in the web context.</p>";
}

echo "<h2>PHP Information</h2>";
echo "PHP Config: " . php_ini_loaded_file() . "<br>";
echo "PHP Version: " . PHP_VERSION . "<br>";

echo "<h2>Loaded Extensions</h2>";
$extensions = get_loaded_extensions();
echo "Total: " . count($extensions) . "<br>";
echo "GD Status: " . (in_array('gd', $extensions) ? "LOADED ✓" : "NOT LOADED ✗") . "<br>";
?>
