<!DOCTYPE html>
<html>
<head>
    <title>Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #45a049;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        p {
            font-size: 18px;
            margin: 10px 0;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            margin-top: 10px;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            margin: 0 auto;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
            
        }

        #result {
            margin-top: 20px;
            font-size: 24px;
        }

        header {
            background-color: #45a049;
            padding: 5px;
        }

        h1 {
            color: #fff;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to the Quiz</h1>
    </header>

    <form action="newquiz.php" method="post">
        <?php
        // Include the database connection file (Update with your own database connection code)
        include("config.php");

        $questions_query = "SELECT * FROM new_questions";
        $questions_result = pg_query($connection, $questions_query);

        while ($question_row = pg_fetch_assoc($questions_result)) {
            $question_id = $question_row['question_id'];
            $question_text = $question_row['question_text'];

            echo "<p>$question_text</p>";

            $options_query = "SELECT * FROM new_options WHERE question_id = $question_id";
            $options_result = pg_query($connection, $options_query);

            while ($option_row = pg_fetch_assoc($options_result)) {
                $option_id = $option_row['option_id'];
                $option_text_a = $option_row['option_a'];
                $option_text_b = $option_row['option_b'];
                $option_text_c = $option_row['option_c'];
                $option_text_d = $option_row['option_d'];


                echo "<label><input type='radio' name='question_$question_id' value='" . htmlspecialchars($option_text_a) . "'> $option_text_a </label><br>";
                echo "<label><input type='radio' name='question_$question_id' value='" . htmlspecialchars($option_text_b) . "'> $option_text_b</label><br>";
                echo "<label><input type='radio' name='question_$question_id' value='" . htmlspecialchars($option_text_c) . "'> $option_text_c</label><br>";
                echo "<label><input type='radio' name='question_$question_id' value='" . htmlspecialchars($option_text_d) . "'> $option_text_d</label><br>";
            }
        }
        ?>
        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php
include("config.php"); // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $score = 0;

    // Loop through questions and check answers
    $questions_query = "SELECT * FROM new_questions";
    $questions_result = pg_query($connection, $questions_query);
    
    while ($question_row = pg_fetch_assoc($questions_result)) {
        $question_id = $question_row['question_id'];
        $selected_option_key = "question_$question_id";

        // Check if the array key exists in $_POST
        if (isset($_POST[$selected_option_key])) {
         $selected_option_id = $_POST[$selected_option_key];
        
        // Now, you have the value of the selected option in $selected_option_id
        // You can use it for further processing or checking against the correct answer
        
        $correct_option_query = "SELECT * FROM new_options WHERE correct_option = '$selected_option_id'";
        $correct_option_result = pg_query($connection, $correct_option_query);

        if (pg_num_rows($correct_option_result) > 0) {
            $score++;
        }
    }

}
    $total = pg_num_rows($questions_result);
    echo "<script>alert('Your score: $score out of $total');</script>";

    //echo "Your score: $score out of " . pg_num_rows($questions_result);
}
?>

