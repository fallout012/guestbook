<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Guestbook</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
          integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>
</head>
<body>

<div class="container">

    <div class="panel panel-primary">
        <div class="panel-heading">
            Гостевая книга
        </div>
        <div class="panel-body">
            <form>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>Имя</label>
                    <input type="text" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>Текст</label>
                    <textarea class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary"/>
                </div>
            </form>

            <hr/>

            <div class="post-block">
                <b>Василий</b> <i>vasiliy@gmail.com</i> <i style="text-decoration: underline;">20.12.2015</i>

                <p>
                    Привет всем, отличный сайт, спасибо за информацию.
                </p>
            </div>


            <div class="post-block">
                <b>Петр</b> <i>petr@gmail.com</i> <i style="text-decoration: underline;">20.12.2015</i>

                <p>
                    Привет всем, отличный сайт, спасибо за информацию.
                </p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
