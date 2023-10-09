
<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>ログイン</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/sign-in/signin.css" rel="stylesheet">
</head>

<body class="text-center">
<form class="form-signin" method="POST" action="final_login_act.php">
    <img class="mb-4" src="./jpg/logo2.jpg" alt="" width="" height="" style="display: block; margin: auto;">
    <h1 class="h3 mb-3 font-weight-normal">会社案内データベース</h1>
    <label for="" class="sr-only">社員番号</label>
    <input type="text" name="lid" class="form-control" placeholder="社員番号" required autofocus>
    <label for="inputPassword" class="sr-only">パスワード</label>
    <input type="password" name="lpw" class="form-control" placeholder="パスワード" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
</form>
</body>
</html>
