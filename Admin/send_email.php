<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; 

include('../connection.php'); 

if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']); 

    $query = "SELECT 
            orders.order_id, 
            orders.order_date, 
            orders.total,
            users.name AS user_name, 
            users.email AS user_email
        FROM orders
        INNER JOIN users ON orders.user_id = users.user_id
        WHERE orders.order_id = $order_id
        LIMIT 1";

    if ($conn) { 
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $order_date = $row['order_date'];
            $user_name = $row['user_name'];
            $user_email = $row['user_email'];

            $amount = $row['total'];

            $products_query = "SELECT 
                    products.name AS product_name, 
                    orders.total 
                FROM orders
                INNER JOIN products ON orders.product_id = products.product_id
                WHERE orders.order_id = $order_id";
            $products_result = mysqli_query($conn, $products_query);

            if ($products_result && mysqli_num_rows($products_result) > 0) {
                $products_list = [];
                while ($product_row = mysqli_fetch_assoc($products_result)) {
                    $products_list[] = $product_row['product_name'];
                }

                $products_string = implode(", ", $products_list); 

                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP(); 
                    $mail->Host = 'smtp.gmail.com'; 
                    $mail->SMTPAuth = true;
                    $mail->Username = 'praveen.manupriya@ecyber.com'; 
                    $mail->Password = 'yowemmaguisnnsty'; 
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
                    $mail->Port = 587; 

                    $mail->setFrom('technova@gmail.com', 'TECH NOVA'); 
                    $mail->addAddress($user_email, $user_name);

                    $mail->isHTML(true); 
                    $mail->Subject = "Order Delivery Date Information";
                    $mail->Body = "
                        <p>Hello <strong>{$user_name}</strong>,</p>
                        <p>Order Date: <strong>{$order_date}</strong></p>
                        <p>Products in your order: <strong>{$products_string}</strong></p>
                        <p>Amount: <strong>Rs. $amount</strong></p>
                        <p>Thank you for placing your order with <strong>TECH NOVA</strong>!</p>
                        <p>Your order is currently being processed and is expected to be delivered within <strong>3 to 4 days</strong>.</p>
                        <p>If you have any questions about your order or need further assistance, please feel free to contact us at <a href='mailto:technova@gmail.com'>technova@gmail.com</a> or call us at <strong>+94-389-1726</strong>.</p>
                        <p>Thank you for choosing TECH NOVA. We value your trust and look forward to serving you again!</p>
                        <p>Best regards,<br>TECH NOVA Team</p>";

                    $mail->send(); 

                    $update_query = "UPDATE orders SET is_mail = 1 WHERE order_id = $order_id";
                    mysqli_query($conn, $update_query);

                    header("Location: order.php?success=sendmail");
                } catch (Exception $e) {
                    echo "Failed to send the email. Error: " . $mail->ErrorInfo;
                }
            } 
        } 
    } 
} 

$conn->close(); 
?>
