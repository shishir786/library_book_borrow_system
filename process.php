<?php
function removeAllWhitespace($string)
{
    // Remove all types of whitespace using regex
    return preg_replace('/\s+/', '', $string);
}


$cookie_name = removeAllWhitespace($_POST['BookTittle']);
if (isset($_POST['submit']) && isset($_COOKIE[$cookie_name])) {
    echo "<h2>You cant borrow this Book Now</h2>";
} else {

    if (isset($_POST['submit'])) {

        $name = null;;
        $id = null;;
        $email = null;;
        $book = null;;
        $brDate = null;;
        $token = null;;
        $rtDate = null;;


        // Name validation
        $NamePattern = '/^[A-Za-z]+\.?\s([A-Z][a-z]*)+(\s[A-Z][a-z]*)*$/';
        if (preg_match($NamePattern, $_POST['Name'])) {
            $name = $_POST['Name'];
        } else {
            echo "<br><h3 style='color: red;'>Name format not matched only alphabet allowed(expect '.' ) and First letter should be capital </h3>";
        }


        // id validation
        $IdPattern = '/^\d{2}-\d{5}-\d{1}$/';
        if (preg_match($IdPattern, $_POST['Id'])) {
            $id = $_POST['Id'];
        } else {
            echo "<br><h3 style='color: red;'>invalied ID format</h3>";
        }

        // email validation
        $EmailPattern = "/^\d{2}-\d{5}-\d{1}@student\.aiub\.edu$/";
        if (preg_match($EmailPattern, $_POST['Email'])) {
            $email = $_POST['Email'];
        } else {
            echo "<br><h3 style='color: red;'>Email address format error</h3>";
        }


        $book = $_POST['BookTittle'];
        $brDate = $_POST['brDate'];
        $token = $_POST['Token'];


        // return date validation
        $temp = $_POST['RtDate'];
        $borrowDate = new DateTime($brDate);
        $returnDate = new DateTime($temp);

        // Calculate the difference in days
        $interval = $borrowDate->diff($returnDate);
        $daysDifference = $interval->days;




        // Read the available tokens (token.json)
        $json_data = file_get_contents('token.json');
        $data = json_decode($json_data, true);

        // Read the used tokens (usedToken.json)
        $used_json_data = file_get_contents('usedToken.json');
        $used_data = json_decode($used_json_data, true);



        // Ensure the 'UsedToken' array exists
        if (!isset($used_data['UsedToken'])) {
            $used_data['UsedToken'] = [];
        }


        if (in_array($token, $data['Token']) && !in_array($token, $used_data['UsedToken'])) {
            $access = 1;
        } elseif (in_array($token, $data['Token']) && in_array($token, $used_data['UsedToken'])) {
            $access = 2;
        } else {
            $access = 0;
        }



        // date validate
        if ($daysDifference > 10 && $access == 0) {
            echo " <br><h3 style='color: red;'>Invalid: Return date is more than 10 days after borrow date</h3>";
        }
        if ($daysDifference > 10 && $access == 2) {
            echo " <br><h3 style='color: red;'>Invalid: this Token already Used</h3>";
        } elseif ($daysDifference < 1) {
            echo " <br><h3 style='color: red;'>Invalid: Return date and Borrow date cannot be same day !</h3>";
        } else {
            $rtDate = $_POST['RtDate'];
        }



        if ($daysDifference > 10) {
            // Token usage logic: If more than 10 days, we mark the token as used
            $key = array_search($token, $data['Token']);
            if ($key !== false) {

                // Add the token to the used tokens array
                $used_data['UsedToken'][] = $token;

                // Optionally, write the updated data back to the files
                file_put_contents('usedToken.json', json_encode($used_data, JSON_PRETTY_PRINT));
            }
        }





        if ($id != null && $name != null && $email != null && $book != 'null' && $brDate !== null && $rtDate != null  && $daysDifference > 0 && ($daysDifference <= 10 || $daysDifference > 10 && $access == 1)) {
            $cookie_name = removeAllWhitespace($book);
            $cookie_value = $name;
            setcookie($cookie_name, $cookie_value, time() + 15);

            echo "
        <div class='Receipt'>
            <h2>Book Borrowing Receipt</h2>
            <p><span class='label'>Name:</span> <span class='value'>" . ($name) . "</span></p>
            <p><span class='label'>ID:</span> <span class='value'>" . ($id) . "</span></p>
            <p><span class='label'>Email:</span> <span class='value'>" . ($email) . "</span></p>
            <p><span class='label'>Chosen Book:</span> <span class='value'>" . ($book) . "</span></p>
            <p><span class='label'>Borrow Date:</span> <span class='value'>" . ($brDate) . "</span></p>
            <p><span class='label'>Token Number:</span> <span class='value'>" . ($token) . "</span></p>
            <p><span class='label'>Return Date:</span> <span class='value'>" . ($rtDate) . "</span></p>
        </div>";
        } else {
            echo "<br><h2 style='color: red;'>Please provide all information !</h2>";
        }
    }
}



?>


<style>
    .Receipt {
        font-family: Arial, sans-serif;
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: #37415C;
        color: white;
    }

    .Receipt h2 {
        text-align: center;
    }

    .Receipt p {
        margin: 10px 0;
    }

    .Receipt .label {
        font-weight: bold;
    }
</style>