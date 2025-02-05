<?php include 'sidebar.php'?>
<style>
    :root {
        --main-color: #000;
        --second-color: #119aaf;
        --cart-color: white;
        --button-bg: #03535fea;
        --button-hover: #0d7d89;
        --button-text: #fff;
    }

   

    .row-container {
        width: 100%;
        min-height: 100vh;
        background-color: var(--cart-color);
        border-radius: 10px;
        color: var(--main-color);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .contact-container {
        width: 100%;
        max-width: 1000px;
        background: var(--cart-color);
        border-radius: 8px;
        padding: 20px;
      
    }

    .contact-container input {
        width: 100%;
        height: 40px;
        border-radius: 5px;
        padding: 10px;
        border: 1px solid #ccc;
        background-color: #f9f9f9;
        font-size: 14px;
    }

    h1 {
        text-align: center;
        color: #333;
        font-size: 28px;
        margin-bottom: 20px;
    }

    .contact-info {
        margin-bottom: 20px;
    }

    .contact-info p {
        margin: 10px 0;
        font-size: 16px;
        color: #555;
        line-height: 1.6;
    }

    .contact-info p strong {
        color: var(--main-color);
    }

    .reply-section {
        border-top: 1px solid #ccc;
        padding-top: 20px;
        margin-top: 20px;
    }

    .reply-section h2 {
        color: #555;
        font-size: 20px;
        margin-bottom: 10px;
    }

    textarea {
        width: 100%;
        height: 100px;
        margin-top: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: none;
        font-size: 14px;
        background-color: #f9f9f9;
    }

    button {
        background-color: var(--button-bg);
        color: var(--button-text);
        border: none;
        padding: 10px 15px;
        margin-top: 10px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: var(--button-hover);
    }

    .user-container {
        width: 100%;
        height: 90vh;
        background-color: var(--cart-color);
        box-shadow: none;
        margin: 0;
        color: var(--main-color);
        display: grid;
        flex-wrap: wrap;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .row-container, .contact-container {
            padding: 20px;
        }

        .contact-container {
            width: 100%;
            margin: 0 auto;
        }

        textarea {
            height: 80px;
        }

        button {
            width: 100%;
        }
    }
</style>

</style>
<div class="row-container">
    <div class="contact-container">
        <h1>Contact Information</h1>
        <div class="contact-info">
            <?php
            include '../connection.php'; 
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
            }

            $query = "SELECT * FROM contact WHERE id='$id'";
            $result = mysqli_query($conn, $query);
           
            if (mysqli_num_rows($result) > 0) {
                if ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($row['name']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($row['phone']); ?></p>
                    <p><strong>Address:</strong> <?php echo htmlspecialchars($row['address']); ?></p>
                    <p><strong>Time:</strong> <?php echo htmlspecialchars($row['time']); ?></p>
                    <p><strong>Status:</strong> <?php echo htmlspecialchars($row['status']); ?></p>
                    <p><strong>Subject:</strong> <?php echo htmlspecialchars($row['subject']); ?></p>
                    <p><strong>Content:</strong><br> 
                        <input type="text" value="<?php echo htmlspecialchars($row['massage']); ?>" disabled>
                    </p>
                    <?php
                }
            } else {
                echo "<p>No contact information found for this user.</p>";
            }
            ?>
        </div>
        <div class="reply-section">
    <h2>Replies</h2>
    <form action="reply_massage_back_end.php" method="POST" onsubmit="return validateForm()">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <textarea name="reply" id="reply" placeholder="Type your reply here..." ></textarea>
        <button type="submit" name="replybtn">Send Reply</button>
    </form>
</div>

<script>
    function validateForm() {
        const reply = document.getElementById("reply").value.trim();
        if (reply === "") {
            alert("Reply cannot be empty!");
            return false;
        }
        return true;
    }
</script>

    </div>
</div>
