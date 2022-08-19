<?php
$page_title = 'List of Orders';
require_once 'init.php';

$db = new Database();
$orders = '';
$query = "SELECT * FROM orders";
$db->query($query);
$orders = $db->resultAll();

if (isset($_POST['search'])) {
    $search = new Order();
    $data = $search->searchOrder($_POST['keyword']);
    $orders = $data;
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
    <link rel="stylesheet" type="text/css" href="styles.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body style="">
    <!-- Site Wide Header -->
    <div id="notify">
        <center>
            <?php Notify::flash(); ?>
        </center>
    </div>

    <header role="banner" aria-label="site-wide-navigation" class="">
        <div class="">
            <nav role="navigation" aria-label="navigation" class="site-header-nav">
                <ul class="site-nav-left">
                    <li>
                        <a href="#">
                            <img src="https://xpeedstudio.com/wp-content/uploads/2019/06/xpeedstudio_logo_header.png" alt="Xpeed Studio" class="logo" style="background:white;">
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </header>
    <!-- Site Main Content -->
    <main role="main" class="site-main">
        <h2 id="page-title" style="color:white;">
            List Of Orders
            <a href="./form.php" style="color:white;">New Submission</a>
        </h2>



        <section role="region" aria-label="contact-form" class="site-main-section">
            <div class="">
                <div class="card">

                    <?php

                    if (empty($orders) !== true) : ?>

                        <form action="" role="form" method="post" class="clearfix">
                            <label>Serach Orders</label>
                            <input type="text" name="keyword" placeholder="Enter Id" required="">
                            <input type="submit" value="search" name="search" class="button button-primary float-right">
                        </form>

                        <table>
                            <tbody>
                                <tr>
                                    <th>Amount</th>
                                    <th>Buyer</th>
                                    <th>Receipt Id</th>
                                    <th>Items</th>
                                    <th>Buyer Email</th>
                                    <th>Buyer Ip</th>
                                    <th>Note</th>
                                    <th>City</th>
                                    <th>Phone</th>
                                    <th>Entry At</th>
                                    <th>Entry By</th>
                                </tr>

                                <?php
                                foreach ($orders as $order) {
                                    echo '<tr>';
                                    echo '<td>' . $order['amount'] . '</td>';
                                    echo '<td>' . $order['buyer'] . '</td>';
                                    echo '<td>' . $order['receipt_id'] . '</td>';
                                    echo '<td>' . $order['items'] . '</td>';
                                    echo '<td>' . $order['buyer_email'] . '</td>';
                                    echo '<td>' . $order['buyer_ip'] . '</td>';
                                    echo '<td>' . $order['note'] . '</td>';
                                    echo '<td>' . $order['city'] . '</td>';
                                    echo '<td>' . $order['phone'] . '</td>';
                                    echo '<td>' . $order['entry_at'] . '</td>';
                                    echo '<td>' . $order['entry_by'] . '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>

                    <?php else :; ?>

                        <center>
                            <h3>No data found</h3>
                        </center>

                    <?php endif; ?>

                </div>
            </div>
        </section>
        <div class="site-main-background" arai-hidden="true"></div>
    </main>
    <!-- Site Wide Footer -->
    <script>
        function notify() {
            var div = document.querySelector('#notify');
            setTimeout(function() {
                div.remove();
            }, 5000);
        }
        notify();
    </script>

</body>

</html>