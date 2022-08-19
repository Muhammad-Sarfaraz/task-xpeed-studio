<?php
$page_title = 'Add New Orders';
require_once 'init.php';

$order = new Order();

$validation_errors = [];

if (isset($_POST['submit'])) {
    $insert = $order->insert($_POST);

    if (is_array($insert)) {
        $validation_errors['errors'] = $insert;
    } else if ($insert > 0) {
        Notify::setFlash('Successfully', 'order inserted.', 'success');
        header('Location: index.php');
    }
}

?>

<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Xpeed Studio Task</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1 user-scalable=no">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
</head>

<body style="">
    <!-- Site Main Content -->
    <main role="main" class="site-main">
        <header aria-labelledby="page-title" class="clearfix site-main-header">
            <div class="container">
                <h1 id="page-title">
                    Create Orders
                    <a href="./index.php" style="color:white;">Home</a>
                </h1>
                <p class="col-1-2">Please provide the valid information for successfull order submission</p>
            </div>
        </header>
        <section role="region" aria-label="contact-form" class="site-main-section">
            <div class="container">
                <div class="card contact-form-container">
                    <div class="clearfix">
                        <div class="col-2-2">
                            <?php
                            if (empty($validation_errors) !== true) {
                                echo ' <figure class="alert alert-error">';
                                foreach ($validation_errors['errors'] as $key => $error) {
                                    if ($error !== '') {
                                        echo '<div class="alert-content">
        <img src="https://s3.amazonaws.com/codecademy-content/programs/ui-design/color-ui/icon-help.svg" alt="Help indicator">
        <p>' . $error['error'] . '</p>
    </div>';
                                    }
                                }
                                echo ' </figure>';
                            }

                            ?>

                            <form action="" role="form" method="post" class="clearfix">
                                <label>Amount</label>
                                <input type="number" name="amount" placeholder="Enter Amount" <?php
                                                                                                if (empty($validation_errors['errors']['amount']) !== true) {
                                                                                                    echo 'class="input-error"';
                                                                                                }
                                                                                                ?> required="">

                                <label>Buyer</label>
                                <input type="text" name="buyer" placeholder="Enter Buyer" max="20" <?php
                                                                                                    if (empty($validation_errors['errors']['buyer']) !== true) {
                                                                                                        echo 'class="input-error"';
                                                                                                    }
                                                                                                    ?> required="">

                                <label>Receipt id</label>
                                <input type="text" name="receipt_id" placeholder="Enter Receipt id" <?php
                                                                                                    if (empty($validation_errors['errors']['receipt_id']) !== true) {
                                                                                                        echo 'class="input-error"';
                                                                                                    }
                                                                                                    ?> required="">
                                <label>Items</label>
                                <input type="text" name="items" placeholder="Enter Items" <?php
                                                                                            if (empty($validation_errors['errors']['items']) !== true) {
                                                                                                echo 'class="input-error"';
                                                                                            }
                                                                                            ?> required="">
                                <label>Buyer Email</label>
                                <input type="text" name="email" placeholder="Enter Buyer Email" <?php
                                                                                                if (empty($validation_errors['errors']['buyer_email']) !== true) {
                                                                                                    echo 'class="input-error"';
                                                                                                }
                                                                                                ?> required="">

                                <label>Note</label>
                                <textarea id="note" placeholder="Provide as much detail as you can so we can address your issue." max="30" name="note" <?php
                                                                                                                                                        if (empty($validation_errors['errors']['note']) !== true) {
                                                                                                                                                            echo 'class="input-error"';
                                                                                                                                                        }
                                                                                                                                                        ?>></textarea>


                                <label>City</label>
                                <input type="text" id="city" name="city" placeholder="Enter City" max="20" <?php
                                                                                                            if (empty($validation_errors['errors']['city']) !== true) {
                                                                                                                echo 'class="input-error"';
                                                                                                            }
                                                                                                            ?>required="">


                                <label>Phone</label>
                                <input type="text" id="phone" name="phone" placeholder="Enter Phone" max="20" <?php
                                                                                                                if (empty($validation_errors['errors']['phone']) !== true) {
                                                                                                                    echo 'class="input-error"';
                                                                                                                }
                                                                                                                ?> required="">


                                <label>Entry By</label>
                                <input type="number" name="entry_by" placeholder="Enter Entry By" <?php
                                                                                                    if (empty($validation_errors['errors']['entry_by']) !== true) {
                                                                                                        echo 'class="input-error"';
                                                                                                    }
                                                                                                    ?> required="">


                                <input type="submit" value="submit" name="submit" class="button button-primary float-right">
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <div class="site-main-background" arai-hidden="true"></div>
    </main>
    <!-- Site Wide Footer -->

</body>

</html>