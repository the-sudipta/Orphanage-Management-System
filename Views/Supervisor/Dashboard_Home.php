<?php

require_once '../../Model/Supervisor.php';

error_reporting(0);
session_start();
if (!isset($_SESSION["loginUser_Name"])) {
    header("Location: Login/Login.php");
}


$P_id = $_SESSION["P_id"];



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        .container {
            display: flex;
            height: 600px;
            margin: 20px auto;
            max-width: 1015px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .left {
            background-color: #f5f5f5;
            padding: 20px;
            width: 30%;
            border-right: 1px solid #ddd;
            box-sizing: border-box;
        }

        .left h3 {
            margin-top: 0;
        }


        /* li:hover {
            background-color: yellow;
            cursor: pointer;
        } */

        /* Set padding and margin for all <a> tags */

        .selected {
            background-color: #333;
            color: #fff;
        }

        .left a {
            display: inline-block;
            width: 200px;
            height: 20px;
            padding: 10px;
            margin: 50px;
        }

        /* Add basic styles to <a> tags */
        a {
            color: #333;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
            padding: 22px;
        }

        /* Add hover effect to <a> tags */
        .left a:hover {
            background-color: yellow;
            color: black;
            transform: scale(1.2);
        }



        .right {
            padding: 20px;
            width: 70%;
            /* Overflow for scrolling */
            /* overflow-y: hidden; */
            /* overflow-x: hidden; */
            box-sizing: border-box;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .matrix {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .row {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .column {
            width: 49%;
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            margin-bottom: 20px;
            overflow-x: auto;
            overflow-y: auto;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        li {
            margin: -34px 0;
            margin-left: -47px;
        }

        a {
            color: #333;
            text-decoration: none;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
        }

        /* Decorate Salary */

        .salary-container {
            font-family: Arial, sans-serif;
            border: 2px solid #ccc;
            padding: 10px;
            display: inline-block;
            border-radius: 5px;
        }

        .salary-label {
            font-weight: bold;
            margin-right: 5px;
        }

        .salary-amount {
            font-size: 24px;
            color: #3e3e3e;
        }

        .salary-currency {
            font-size: 18px;
            color: #666;
            margin-left: 5px;
        }

        /* Table Decoration */
        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            font-size: 14px;
            text-align: center;
        }

        thead {
            background-color: #f2f2f2;
        }

        th,
        td {
            text-align: center;
            padding: 8px;
            border: 1px solid #ddd;
        }

        th {
            font-weight: bold;
            color: #333;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        td:first-child,
        th:first-child {
            border-left: none;
        }

        td:last-child,
        th:last-child {
            border-right: none;
        }

        tbody td:nth-child(odd) {
            background-color: #f9f9f9;
        }

        tbody td:nth-child(even) {
            background-color: #fff;
        }

        li {
            display: inline-block;
            margin-right: -15px;
        }
    </style>

</head>

<body>
    <?php include '../../Layout/Supervisor/SupervisorHeader.php'; ?>


    <div class="container">
        <div class="left">
            <p>
            <h3>Home</h3>
            <hr>
            <ul>
                <li><a href="Dashboard_Home.php" class="selected">The Dashboard Home</a></li> <br>
                <li><a href="Profile.php">My Profile</a></li> <br>
                <li><a href="AddOrphans.php">Create Orphan Accounts</a></li>
                <li><a href="orphanProfiles.php">View Orphan Profiles</a></li> <br>
                <li><a href="adoptionRequests.php">View Adoption Requests</a></li> <br>
                <li><a href="ChangePassword.php">Change Password</a></li> <br>
                <li><a href="../../Controller/Supervisor/DeleteAccount_Handler.php">Delete Account</a></li>
                <!-- <li><a href="../../Controller/Logout_Handler.php">Logout</a></li> -->
            </ul>

            </p>


        </div>
        <div class="right">

            <div class="matrix">
                <div class="row">
                    <div class="column" id="event-table">

                        <!-- Showing Events -->

                        <?php

                        // Read the contents of the JSON file into a string

                        // Decode the JSON string into a PHP associative array
                        $data = show_all_events();



                        // Create an HTML table with headers
                        echo '<table border="1">';
                        echo '<tr>
                            <th>Event Name</th>
                            <th>Event Date</th>
                            </tr>';

                        // Iterate over the data and add rows to the table
                        foreach ($data as $row) {

                            echo '<tr>';
                            echo '<td>' . $row['event_name'] . '</td>';
                            echo '<td>' . $row['event_date'] . '</td>';
                            // Todo: Showing options for orphan request
                            echo '</tr>';
                        }

                        // Close the HTML table
                        echo '</table>';
                        ?>


                    </div>
                    <div class="column" id="appointment-time">

                        <!-- Showing Appointment Time Date -->

                        <?php

                        // Read the contents of the JSON file into a string

                        // Decode the JSON string into a PHP associative array
                        $data = show_all_appointments();



                        // Create an HTML table with headers
                        echo '<table border="1">';
                        echo '<tr>
                            <th>Orphan Name</th>
                            <th>adopter Name</th>
                            <th>Adopter Phone</th>
                            <th>Appointment Date</th>
                            </tr>';

                        // Iterate over the data and add rows to the table
                        foreach ($data as $row) {

                            echo '<tr>';
                            echo '<td>' . $row['orphan_name'] . '</td>';
                            echo '<td>' . $row['adopter_name'] . '</td>';
                            echo '<td>' . $row['adopter_phone'] . '</td>';
                            echo '<td>' . $row['date_time'] . '</td>';
                            // Todo: Showing options for orphan request
                            echo '</tr>';
                        }

                        // Close the HTML table
                        echo '</table>';
                        ?>


                    </div>
                </div>
                <div class="row">
                    <div class="column" id="no-use">
                    </div>
                    <div class="column" id="salary">

                        <?php
                        $supervisorData = search_specific_data("supervisor_salary", "supervisor", "supervisor_id", $P_id);

                        echo '<div class="salary-container">
                        <label class="salary-label">Salary :</label>
                        <span class="salary-amount">' . $supervisorData["supervisor_salary"] . ' /-</span>
                        <span class="salary-currency">BDT</span>
                      </div>';


                        ?>



                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php include '../../Layout/Supervisor/SupervisorFooter.php'; ?>

    <script>
        // Read the contents of the JSON file into a