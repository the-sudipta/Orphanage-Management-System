<?php
// Get the input value from user input
$input_value = 14;

// Call the Python script with the input value as an argument
$command = escapeshellcmd("python predict.py $input_value");
$output = shell_exec($command);

if (empty($output)) {
    // Error handling if no output is returned
    echo "Error: Failed to get output from Python script";
} else {
    // Print the predicted value
    echo "Predicted value: " . $output;
}

// Debugging statement to print the command being executed
echo "Command: " . $command;
?>