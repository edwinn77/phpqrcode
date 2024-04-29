<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Ticket Purchase</title>
    <style>
       * {
            box-sizing: border-box;
            margin: 100;
            padding: 0;
        }
        
        
        body {
            font-family: 'Times New Roman', Times, serif, sans-serif;
            background-image: url(bacground.png);
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .ticket-container {
            width: 300px;
            margin: 50px auto;
            text-align: center;
        }

         header {
            background-color: #453321;
            font-size: 15px;
            color: rgb(255, 255, 255);
            text-align: center;
            padding: 1em 40%;
            position: relative; /* Add this for positioning the logo */
        }

        header img {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 10px; /* Adjust as needed */
            max-height: 200px; /* Adjust as needed */
            cursor: pointer; /* Change cursor to pointer to indicate it's clickable */
            }

        header, nav, main {
            width: 100%;
            max-width: 2000px;
        }

        header h1 {
        font-size: 48px; /* Adjust the font size as needed */
        }

        nav {
            background-color: #1b3336;
            overflow: hidden;
        }

        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 24px;
        }

        nav button {
            float: right;
            color: black;
            font-size: 24px;
            cursor: pointer;
            margin-left: 10px; /* Adjust the margin to add space between buttons */
            margin-top: 5px;
            padding: 5px 5px; /* Adjust padding for height and width of buttons */
            border: 5px solid white; /* Adjust border properties */
            border-radius:15px; /* Optional: Add border radius for rounded corners */
            justify-content: space-between;
            }

        main {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
            bottom: 20%;
            top: 20%;
        }

        .footer {
        background-color: #1b3336;
        color: white;
        position: static;
        padding: 20px;
        left: 0%;
        bottom: 0%;
        width: 100%;
        text-align: center;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 24px; /* Adjust the font size as needed */
        }


        .footer img {
            height: 200px;
            margin-right: 10px;
        }

        .footer-links {
            display: flex;
            align-items: center;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
        }

        .footer-book-now button {
        font-size: 24px; /* Adjust the font size as needed */
        padding: 10px 20px; /* Adjust the padding to increase button size */
        }

        .footer-contact {
            margin-left: auto;
        }

        .footer-contact a {
            color: white;
            text-decoration: none;
        }

        .footer {
         /* Add padding to the top of the footer */
         padding-top: 15px; /* Adjust the value as needed */
        }


        nav button {
            float: right;
            color: black;
            font-size: 24px;
            cursor: pointer;
            margin-left: 10px; /* Adjust the margin to add space between buttons */
            margin-top: 5px;
            padding: 5px 5px; /* Adjust padding for height and width of buttons */
            border: 5px solid white; /* Adjust border properties */
            border-radius:15px; /* Optional: Add border radius for rounded corners */
            justify-content: space-between;
            }


        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            text-align: center; /* Center text in the input box */
        }

        .ticket-quantity {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 15px;
        }

        .quantity-btn {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .quantity-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<header>
        <a href="tickets.php"><img src="logo.png" alt="Kellie's Castle Logo"></a>
        <h1>Ticket Purchase</h1>
    </header>
    
    <nav>
            <a href="homepage.php">Home</a>
            <a href="about_us.php">About Us</a>
            <a href="tickets.php">Tickets</a>
            <a href="contact_us.php">Contact Us</a>
            <button onclick="location.href='sign_up.php'">Signup</button>
            <button onclick="location.href='login_signup.php'">Login</button>
            
        </nav>
    
    <div class="ticket-container">
        <h2>Ticket Purchase</h2>
        <label for="name">Enter your name:</label>
        <input type="text" id="name" placeholder="Your name">
        
        <div class="category">
            <label for="adult">Adult:</label>
            <div class="ticket-quantity">
                <button class="quantity-btn minus-btn" data-category="adult">-</button>
                <input type="text" class="quantity" name="adult-quantity" id="adult-quantity" value="0">
                <button class="quantity-btn plus-btn" data-category="adult">+</button>
            </div>
        </div>

        <div class="category">
            <label for="children">Children:</label>
            <div class="ticket-quantity">
                <button class="quantity-btn minus-btn" data-category="children">-</button>
                <input type="text" name="children_quantity" id="children-quantity" value="0">
                <button class="quantity-btn plus-btn" data-category="children">+</button>
            </div>
        </div>

        <div class="category">
            <label for="senior">Senior Citizen:</label>
            <div class="ticket-quantity">
                <button class="quantity-btn minus-btn" data-category="senior">-</button>
                <input type="text" class="quantity" name="senior-quantity" id="senior-quantity" value="0">
                <button class="quantity-btn plus-btn" data-category="senior">+</button>
            </div>
        </div>

        <div class="category">
            <label for="disabled">Disabled Individual:</label>
            <div class="ticket-quantity">
                <button class="quantity-btn minus-btn" data-category="disabled">-</button>
                <input type="text" class="quantity" name="disabled-quantity" id="disabled-quantity" value="0">
                <button class="quantity-btn plus-btn" data-category="disabled">+</button>
            </div>
        </div>

        <div class="category">
            <label for="foreigner">Foreigner:</label>
            <div class="ticket-quantity">
                <button class="quantity-btn minus-btn" data-category="foreigner">-</button>
                <input type="text" class="quantity" id="foreigner-quantity" name="foreigner-quantity" value="0">
                <button class="quantity-btn plus-btn" data-category="foreigner">+</button>
            </div>
        </div>

        <p>Total Price: <span id="total-price">$0</span></p>

        <button id="submit-btn">Submit</button>
    </div>

    <footer class="footer">
    <div class="footer-links">
        <a href="tickets.php"><img src="logo.png" alt="Kellie's Castle Logo"></a>
        <a href="index.php" onclick="changePage('home')">Homepage</a>
        <a href="tickets.php">Tickets</a>
        <a href="about_us.php">About Us</a>
        <a href="contact_us.php">Contact Us</a>
    </div>
    <div class="footer-book-now">
        <button onclick="bookTicket()">Book Now</button>
    </div>
    <div class="footer-contact">
        <p>Get in touch with us:</p>
        <p><a href="mailto:kelliekeyinfo@gmail.com">Gmail: KelliekeyInfo@gmail.com</a></p>
        <p>Contact Num: <a href="tel:+6053653381">05-365 3381</a></p>

    </div>
</footer>

    <script>
        $(document).ready(function() {
            $("#submit-btn").click(function() {
                var name = $("#name").val();
                var adultQuantity = $("#adult-quantity").val();
                var childrenQuantity = $("#children-quantity").val();
                var seniorQuantity = $("#senior-quantity").val();
                var disabledQuantity = $("#disabled-quantity").val();
                var foreignerQuantity = $("#foreigner-quantity").val();
                var totalPrice = $("#total-price").text().substring(1); 

                console.log("Adult Quantity:", adultQuantity);
                console.log("Children Quantity:", childrenQuantity);
                console.log("Senior Quantity:", seniorQuantity);
                console.log("Disabled Quantity:", disabledQuantity);
                console.log("Foreigner Quantity:", foreignerQuantity);
                console.log("Total Price:", totalPrice);

                var formData = {
                    name: name,
                    adult_quantity: adultQuantity,
                    children_quantity: childrenQuantity,
                    senior_quantity: seniorQuantity,
                    disabled_quantity: disabledQuantity,
                    foreigner_quantity: foreignerQuantity,
                    total_price: totalPrice
                };

                $.ajax({
                    type: "POST",
                    url: "submit.php", 
                    data: formData,
                    dataType: "json", // Expect JSON response from the server
                    success: function(response) {
                        console.log(response);
                        window.location.href = `qrcode.php?name=${name}&adult=${adultQuantity}&children=${childrenQuantity}&senior_citizen=${seniorQuantity}&disabled_individual=${disabledQuantity}&foreigner=${foreignerQuantity}&total_price=${totalPrice}`;
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert("Error occurred while purchasing ticket!");
                    }
                });
            });
        });

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInputs = document.querySelectorAll('.quantity');
            const minusBtns = document.querySelectorAll('.minus-btn');
            const plusBtns = document.querySelectorAll('.plus-btn');
            const totalPriceSpan = document.getElementById('total-price');

            let ticketPrices = {
                adult: 10,
                children: 5,
                senior: 8,
                disabled: 8,
                foreigner: 15
            };

            let quantities = {
                adult: 0,
                children: 0,
                senior: 0,
                disabled: 0,
                foreigner: 0
            };

            // Update quantity and total price when clicking minus or plus buttons
            minusBtns.forEach((btn, index) => {
                btn.addEventListener('click', function() {
                    if (quantities[btn.dataset.category] > 0) {
                        quantities[btn.dataset.category]--;
                        quantityInputs[index].value = quantities[btn.dataset.category];
                        updateTotalPrice();
                    }
                });
            });

            // Updated plusBtns event listeners to handle both button click and manual input
            plusBtns.forEach((btn, index) => {
                btn.addEventListener('click', function() {
                    incrementQuantity(btn.dataset.category, index);
                });

                quantityInputs[index].addEventListener
                ('input', function() {
                    const value = parseInt(this.value);
                    if (!isNaN(value) && value >= 0) {
                        quantities[btn.dataset.category] = value;
                        updateTotalPrice();
                    }
                });
            });

            // Function to increment quantity and update UI
            function incrementQuantity(category, index) {
                quantities[category]++;
                quantityInputs[index].value = quantities[category];
                updateTotalPrice();
            }

            // Update total price based on quantity
            function updateTotalPrice() {
                let totalPrice = 0;
                Object.keys(quantities).forEach(category => {
                    totalPrice += quantities[category] * ticketPrices[category];
                });
                totalPriceSpan.textContent = '$' + totalPrice;
            }

            // Handle form submission
            const submitBtn = document.getElementById('submit-btn');
            submitBtn.addEventListener('click', function() {
            const name = document.getElementById('name').value;
            const adult = document.getElementById('adult-quantity').value;
            const children = document.getElementById('children-quantity').value;
            const senior = document.getElementById('senior-quantity').value;
            const disabled = document.getElementById('disabled-quantity').value;
            const foreigner = document.getElementById('foreigner-quantity').value;
            const totalPrice = document.getElementById('total-price').textContent.replace('$', '');

            // window.location.href = `qrcode.php?name=${name}&adult=${adult}&children=${children}&senior_citizen=${senior}&disabled_individual=${disabled}&foreigner=${foreigner}&total_price=${totalPrice}`;
            });

        });
    </script>
    
      <?php if ($successMessage): ?>
        <div class="success-message">
            <?php echo $successMessage; ?>
        </div>
    <?php endif; ?>

    <?php if ($errorMessage): ?>
        <div class="error-message">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>
</body>
</html>