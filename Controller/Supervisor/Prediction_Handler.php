<?php

// Load the polynomial regression model from the pickle file
$model = file_get_contents('polynomial_regression_model.pickle');
$lr = unserialize($model);

// Use the trained model to make predictions
$id = 14; // ID of new data point
$profit = $lr->predict($poly->transform([[$id]])); // Predicted profit for new data point
echo "Predicted profit for ID $id: $profit";


//