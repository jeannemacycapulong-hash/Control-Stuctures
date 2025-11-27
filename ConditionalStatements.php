<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Corner</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    $coffeeType = $milk = $sweetness = $isCaffeineFree = "";
    $recommendationMessage = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $coffeeType = $_POST['coffee_type'];
        $milk = $_POST['milk'];
        $sweetness = $_POST['sweetness'];
        $isCaffeineFree = $_POST['caffeine_free'];

        if ($coffeeType == "Espresso") {
            $recommendationMessage = "Espresso is perfect for you.";
        } else if ($coffeeType == "Cappuccino") {
            $recommendationMessage = "Cappuccino gives you a nice creamy experience.";
        }

        if ($milk == "regular") {
            $recommendationMessage .= " You prefer regular milk, nice and creamy!";
        } else {
            $recommendationMessage .= " Almond milk adds a nice nutty flavor to your coffee!";
        }

        switch ($sweetness) {
            case "sweet":
                $recommendationMessage .= " You like sweet coffee.";
                break;
            case "unsweet":
                $recommendationMessage .= " You prefer unsweetened coffee.";
                break;
        }

        if ($isCaffeineFree == "yes") {
            $recommendationMessage .= " You prefer a caffeine-free option!";
        } else {
            $recommendationMessage .= " You're a fan of caffeine!";
        }
    }

    include('header.php');
    ?>

    <section class="coffee-survey">
        <h2>Find Your Perfect Coffee</h2>
        <p>Take our short survey to discover your perfect coffee match!</p>

        <form method="POST" action="index.php">
            <label for="coffee_type">What type of coffee do you prefer?</label><br>
            <select name="coffee_type" id="coffee_type" required>
                <option value="Espresso" <?php if ($coffeeType == 'Espresso') echo 'selected'; ?>>Espresso</option>
                <option value="Cappuccino" <?php if ($coffeeType == 'Cappuccino') echo 'selected'; ?>>Cappuccino</option>
            </select><br><br>

            <label for="milk">What kind of milk do you prefer?</label><br>
            <select name="milk" id="milk" required>
                <option value="regular" <?php if ($milk == 'regular') echo 'selected'; ?>>Regular Milk</option>
                <option value="almond" <?php if ($milk == 'almond') echo 'selected'; ?>>Almond Milk</option>
            </select><br><br>

            <label for="sweetness">How sweet do you like your coffee?</label><br>
            <select name="sweetness" id="sweetness" required>
                <option value="sweet" <?php if ($sweetness == 'sweet') echo 'selected'; ?>>Sweet</option>
                <option value="unsweet" <?php if ($sweetness == 'unsweet') echo 'selected'; ?>>Unsweetened</option>
            </select><br><br>

            <label for="caffeine_free">Do you prefer caffeine-free coffee?</label><br>
            <select name="caffeine_free" id="caffeine_free" required>
                <option value="yes" <?php if ($isCaffeineFree == 'yes') echo 'selected'; ?>>Yes</option>
                <option value="no" <?php if ($isCaffeineFree == 'no') echo 'selected'; ?>>No</option>
            </select><br><br>

            <input type="submit" value="Submit">
        </form>

        <?php
        if ($recommendationMessage) {
            echo "<h3>Your Personalized Coffee Recommendation:</h3>";
            echo "<p>$recommendationMessage</p>";
        }
        ?>
    </section>

    <?php
    include('footer.php');
    ?>

    </body>
</html>