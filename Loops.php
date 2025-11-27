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
        $recoMessage = "";

        $coffeeTypes = ["Flat White", "Iced Coffee", "Cold Brew", "Latte", "Macchiato"];
        $milkTypes = ["Oat Milk", "Coconut Milk", "Regular Milk"];
        $sweetnessOptions = ["Extra Sweet", "Medium Sweet", "Unsweetened"];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $coffeeType = $_POST['coffee_type'];
            $milk = $_POST['milk'];
            $sweetness = $_POST['sweetness'];
            $isCaffeineFree = $_POST['caffeine_free'];

            $counter = 1;
            do {
                $recoMessage = "Processing your choices... (Attempt: $counter)";
                $counter++;
            } while ($counter <= 1); 

            for ($i = 0; $i < 2; $i++) {
                if ($coffeeType == $coffeeTypes[$i]) {
                    $recoMessage .= " You like " . $coffeeTypes[$i] . "!";
                    break;
                }
            }

            foreach ($milkTypes as $type) {
                if ($milk == $type) {
                    $recoMessage .= " You prefer $type milk.";
                    break;
                }
            }

            $recoMessage .= ($sweetness == "Extra Sweet") ? " You like it extra sweet." : ($sweetness == "Medium Sweet" ? " You like it moderately sweet." : " You prefer unsweetened coffee.");

            $recoMessage .= ($isCaffeineFree == "yes") ? " You prefer caffeine-free." : " You're a fan of caffeine!";
        }

        include('header.php');
        ?>

        <section class="coffee-survey">
            <h2>Find Your Perfect Coffee</h2>
            <p>Take our short survey to discover your perfect coffee match!</p>

            <form method="POST" action="index.php">
                <label for="coffee_type">What type of coffee do you prefer?</label><br>
                <select name="coffee_type" id="coffee_type" required>
                    <?php
                    foreach ($coffeeTypes as $coffee) {
                        echo "<option value='$coffee' " . ($coffeeType == $coffee ? 'selected' : '') . ">$coffee</option>";
                    }
                    ?>
                </select><br><br>

                <label for="milk">What kind of milk do you prefer?</label><br>
                <select name="milk" id="milk" required>
                    <?php
                    foreach ($milkTypes as $type) {
                        echo "<option value='$type' " . ($milk == $type ? 'selected' : '') . ">$type Milk</option>";
                    }
                    ?>
                </select><br><br>

                <label for="sweetness">How sweet do you like your coffee?</label><br>
                <select name="sweetness" id="sweetness" required>
                    <option value="Extra Sweet" <?php if ($sweetness == 'Extra Sweet') echo 'selected'; ?>>Extra Sweet</option>
                    <option value="Medium Sweet" <?php if ($sweetness == 'Medium Sweet') echo 'selected'; ?>>Medium Sweet</option>
                    <option value="Unsweetened" <?php if ($sweetness == 'Unsweetened') echo 'selected'; ?>>Unsweetened</option>
                </select><br><br>

                <label for="caffeine_free">Do you prefer caffeine-free coffee?</label><br>
                <select name="caffeine_free" id="caffeine_free" required>
                    <option value="yes" <?php if ($isCaffeineFree == 'yes') echo 'selected'; ?>>Yes</option>
                    <option value="no" <?php if ($isCaffeineFree == 'no') echo 'selected'; ?>>No</option>
                </select><br><br>

                <input type="submit" value="Submit">
            </form>

            <?php
            if ($recoMessage) {
                echo "<h3>Your Coffee Recommendation:</h3>";
                echo "<p>$recoMessage</p>";
            }
            ?>
        </section>

        <?php
        include('footer.php');
        ?>
    </body>
</html>