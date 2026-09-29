<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: auto;
            border: 1px solid #333;
        }

       .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    background: linear-gradient(45deg, #ff6ec4, #4a00e0, #ff6ec4);
}

        .header img {
            max-height: 50px;
        }

        .header .contact {
            font-size: 14px;
        }

        .social-icons {
            margin-top: 5px;
        }

        .social-icons img {
            max-height: 30px;
        }

        .social-icons a {
            margin: 0 5px;
            text-decoration: none;
        }

        .banner {
            width: 100%;
            display: block;
        }

        .message {
            padding: 20px;
            background-color: #ffffff;
            text-align: justify;
        }

        .message h1 {
            font-size: 24px;
            color: #333;
        }

        .message p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }
.footer {
    background: linear-gradient(45deg, #ffd1dc, #d0e0ff, #e0ccff); /* light pink, light blue, light purple */
    padding: 15px;
    text-align: center;
    font-size: 12px;
    color: #555; /* slightly darker for contrast */
}

        .footer a {
            color: #0073e6;
            text-decoration: none;
            margin: 0 5px;
        }

        .footer img {
            max-height: 30px;
        }
    </style>
</head>

<body>
    <table class="email-container" cellpadding="0" cellspacing="0" role="presentation">
        <!-- Header -->
        <tr>
            <td class="header">
                <img src="https://www.bollywoodproduct.com/images/bollywood_product_logo.png" alt="Bollywood Product">

            </td>
        </tr>

        <!-- Banner -->
        <tr>
            <td>
                <img src="https://www.bollywoodproduct.com/images/email-banner.jpg"
                    alt="Bollywood Product" class="banner">
            </td>
        </tr>



        <!-- Message -->
        <tr>
            <td class="message">
                <h1><?php echo $title; ?></h1>
                <p><?php echo $message; ?></p>


                <br>
            </td>
        </tr>


        <?php
        // Encode ID into base64 hash
        $hash = base64_encode($id); // $id should be the email_logs id
        $viewLink = "https://www.bollywoodproduct.com/mailer-online.php?hash=" . urlencode($hash);
        ?>
        <tr>
            <td align="center" style="padding: 20px;">
                <a href="<?php echo $viewLink; ?>" style="display: inline-block;
                      padding: 12px 25px;
                      font-size: 16px;
                      font-family: Arial, sans-serif;
                      background-color: #007BFF;
                      color: #ffffff;
                      text-decoration: none;
                      border-radius: 5px;">
                    View This Email in Browser
                </a>
            </td>
        </tr>
        <!-- Footer -->
        <tr>
            <td class="footer">
                <p>

                    <a href="https://https://www.bollywoodproduct.com/contact.php" target="_blank">Contact Us</a>
                </p>
                <p>Disclaimer: This email is intended for the designated recipient only. Please do not share its
                    contents without permission.</p>
                <p> &copy; <?php echo date("Y"); ?> Bollywood Product. All rights reserved.</p>

                </p>
            </td>
        </tr>
    </table>
</body>

</html>