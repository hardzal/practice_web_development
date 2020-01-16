<?php

include('database_connection.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Like System with Notification using Ajax jquery</title>
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <script src="js/jquery-3.4.1.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>

</head>

<body>
    <div class="container">
        <h2 align="center">PHP System with Notification using Ajax jQuery</h2>
        <br />
        <div align="right">
            <a href="logout.php">Logout</a>
        </div>
        <br />
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Weblesson - <?php echo $_SESSION['user_name']; ?></a>
                    <ul class="dropdown-menu"></ul>
                </div>
            </div>
        </nav>
        <br />
        <br />
        <form method="post" id="form_wall">
            <textarea name="content" id="content" class="form-control" placeholder="Share any thing what's in  your mind"></textarea>
            <br />
            <div align="right">
                <input type="submit" name="submit" id="submit" class="btn btn-primary btn-sm" value="POST" />
            </div>
        </form>
        <br /><br />
        <br /><br />
        <h4>Latest Post</h4>
        <br />
        <div id="website_stuff"></div>
    </div>
    <script>
        $(document).ready(function() {
            load_stuff();

            function load_stuff() {
                $.ajax({
                    url: "load_stuff.php",
                    method: "POST",
                    success: function(data) {
                        $('#website_stuff').html(data);
                    }
                });
            }

            $('#form_wall').on('submit', function(e) {
                e.preventDefault();
                if ($.trim($('#content').val().length == 0)) {
                    alert('Please write something!');
                    return false;
                } else {
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "insert.php",
                        method: "POST",
                        data: form_data,
                        success: function(data) {
                            if (data == 'done') {
                                $('#form_wall')[0].reset();
                                load_stuff();
                            }
                        }
                    });
                }
            });

            $(document).on('click', '.like_button', function() {
                var content_id = $(this).data('content_id');
                $(this).attr('disabled', 'disabled');
                $.ajax({
                    url: "like.php",
                    method: "POST",
                    data: {
                        content_id: content_id
                    },
                    success: function(data) {
                        if (data == 'done') {
                            load_stuff();
                        }
                    }
                });
            });

            load_unseen_notification();

            function load_unseen_notification(view = '') {
                $.ajax({
                    url: "load_notification.php",
                    method: "POST",
                    data: {
                        view: view,
                    },
                    dataType: "json",
                    success: function(data) {
                        $('.dropdown-menu').html(data.notification);
                        if (data.unseen_notification > 0) {
                            $('.count').html(data.unseen_notification);
                        }
                    }
                });
            }

            $(document).on('click', '.dropdown-toggle', function() {
                $('.count').html('');
                load_unseen_notification('yes');
            });
        });
    </script>
</body>

</html>