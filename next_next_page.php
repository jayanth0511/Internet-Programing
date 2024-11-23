
<!DOCTYPE html>
<html>
<head>
    <title>Cake Order Form</title>
    <style>
        body {
            background-image: url('pink.jpg');
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }

        form {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            width: 300px;
        }

        h2 {
            text-align: center;
            margin-bottom: 700px;
            margin-left: 400px; /* Added to remove top margin */
            color: white;
            font-size: 40px; /* Added to remove top margin */
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: calc(100% - 12px);
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="date"] {
            width: calc(100% - 12px);
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        
        .success-message {
            color: white; /* Change color for success message */
            font-size: 50px;
            text-align: bottom;
            margin-bottom: 2px;
        }
        button {
        background-color: #007bff;
        border: none;
        color: whitesmoke;
        font-size: 16px; /* Decreased font size */
        padding: 8px 16px; /* Decreased padding */
        text-align: center;
        text-decoration: none;
        display: inline-block;
        margin-top: 10px;
        cursor: pointer;
        border-radius: 2px;
        transition: background-color 0.3s ease;
    }


    </style>
</head>
<body>
    <h2>Order Your Cake</h2> <!-- Moved to the top -->
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="customer_name">Customer Name:</label>
        <input type="text" id="customer_name" name="customer_name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required>
        
        <label for="cake_type">Cake Type:</label>
        <input type="text" id="cake_type" name="cake_type" required>
        
        <label for="delivery_date">Delivery Date:</label>
        <input type="date" id="delivery_date" name="delivery_date" required>
        
        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4"></textarea>
        
        <input type="submit" name="submit" value="Place Order">
        <a href="order.html"><button type="button">Submit</button></a>
    </form>

    <?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = "cake_ordering_system";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $customer_name = isset($_POST['customer_name']) ? $_POST['customer_name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $cake_type = isset($_POST['cake_type']) ? $_POST['cake_type'] : '';
        $delivery_date = isset($_POST['delivery_date']) ? $_POST['delivery_date'] : '';
        $message = isset($_POST['message']) ? $_POST['message'] : '';

        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO orders (customer_name, email, phone, cake_type, delivery_date, message) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $customer_name, $email, $phone, $cake_type, $delivery_date, $message);

        // Execute
        $stmt->execute();

        echo "<span class='success-message'>Order placed successfully!</span>";
        
        $stmt->close();
    }

    $conn->close();
    ?>
</body>
</html>
