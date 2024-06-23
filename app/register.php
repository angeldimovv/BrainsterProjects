<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <title>Registration Page</title>
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
                <form action="./processing/register-user.php" method="POST">
                    <?php if (isset($_SESSION['registerSuccess'])) : ?>
                        <div class="bg-success rounded-2 py-2 my-2 text-light fw-semibold">
                            <?= $_SESSION['registerSuccess'] ?>
                        </div>
                    <?php endif; ?>
                    <h1 class="mb-5 display-4 fw-semibold">Register</h1>
                    <div class="mb-4">
                        <div class="mb-3">
                            <input type="text" class="form-control bg-light" name="username" id="username" placeholder="Username" required />
                            <?php if (!empty($_SESSION['registerErrors']['username'])) : ?>
                                <small class="text-danger fw-semibold">
                                    <?= $_SESSION['registerErrors']['username'] ?>
                                </small>
                            <?php endif; ?>
                            <?php if (!empty($_SESSION['registerErrors']['usernameTaken'])) : ?>
                                <small class="text-danger fw-semibold">
                                    <?= $_SESSION['registerErrors']['usernameTaken'] ?>
                                </small>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control bg-light" name="password" id="password" placeholder="Password" required />
                            <?php if (!empty($_SESSION['registerErrors']['password'])) : ?>
                                <small class="text-danger fw-semibold">
                                    <?= $_SESSION['registerErrors']['password'] ?>
                                </small>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control bg-light" name="repeatpassword" id="repeatpassword" placeholder="Repeat Password" required />
                            <?php if (!empty($_SESSION['registerErrors']['repeatPassword'])) : ?>
                                <small class="text-danger fw-semibold">
                                    <?= $_SESSION['registerErrors']['repeatPassword'] ?>
                                </small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-75 fs-5">Submit</button>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>

<?php
unset($_SESSION['registerErrors']);
unset($_SESSION['registerSuccess']);
