<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Телефонная книга</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <?php echo \Phalcon\Tag::stylesheetLink("css/select2.min.css"); ?>
        <?php echo \Phalcon\Tag::stylesheetLink("css/style.css"); ?>
        {% if !request.isAjax() %}
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        {% endif %}
    </head>
    <body>
        <div class="container">
            {{ content() }}
        </div>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                <?php echo \Phalcon\Tag::javascriptInclude("js/select2.full.min.js"); ?>
        <?php echo \Phalcon\Tag::javascriptInclude("js/wait.js"); ?>
        <?php echo \Phalcon\Tag::javascriptInclude("js/main.js"); ?>
    </body>
</html>
