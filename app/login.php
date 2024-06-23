<!doctype html>
<html lang="en">

<head>
    <title>Login Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body class="bg-light">
    <main>
        <div class="container vh-100 d-flex align-items-center justify-content-center text-center">
            <div class="row w-25 px-4 py-3 bg-primary-subtle rounded-3">
                <form action="./processing/login-user.php" method="POST">
                    <h1 class="mb-5 display-4 fw-semibold">Login</h1>
                    <div class="mb-4">
                        <input type="username" class="form-control mb-3 bg-light" name="username" id="username" placeholder="Username" required />
                        <input type="password" class="form-control bg-light" name="password" id="password" placeholder="Password" required />
                    </div>
                    <button type="submit" class="btn btn-primary w-75 fs-5">Submit</button>
                    <?php if (isset($_GET['error'])) : ?>
                        <div class="bg-warning rounded-2 fw-semibold py-2 mt-3">Wrong Username or Password!</div>
                    <?php endif; ?>
                </form>
                <a class="text-primary link-underline link-underline-opacity-0 mt-2" href="./register.php" role="button">Create an account</a>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</body>

</html>