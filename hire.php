<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Brainster Labs</title>
    <!-- Bootstrap CSS v5.3.2 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <!-- Font Awesome -->
    <script
      src="https://kit.fontawesome.com/f7a6638fb1.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="./assets/scss/styles.css" />
    <link
      rel="shortcut icon"
      href="./assets/images/favicon.ico"
      type="image/x-icon"
    />
  </head>
  <body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid my-4 mx-5">
        <a href="#" class="logo">
          <img src="./assets/images/logo.png" alt="Brainster" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarContent"
          aria-controls="navbarContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div
          class="collapse navbar-collapse justify-content-end"
          id="navbarContent"
        >
          <ul class="navbar-nav align-items-lg-center justify-content-start">
            <li class="nav-item mx-4">
              <a
                class="nav-link fw-bold"
                aria-current="page"
                href="https://brainster.co/marketing/"
                >Академија за маркетинг</a
              >
            </li>
            <li class="nav-item mx-4">
              <a
                class="nav-link fw-bold"
                href="https://brainster.co/full-stack/"
                >Академија за програмирање</a
              >
            </li>
            <li class="nav-item mx-4">
              <a
                class="nav-link fw-bold"
                href="https://brainster.co/full-stack/"
                >Академија за програмирање</a
              >
            </li>
            <li class="nav-item mx-4">
              <a
                class="nav-link fw-bold"
                href="https://brainster.co/graphic-design/"
                >Академија за дизајн</a
              >
            </li>
            <li class="nav-item mx-4">
              <a class="nav-link fw-bold nav-button px-4" href="./form.html"
                >Вработи наш студент</a
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!---------- FORM ---------->
    <!-- form validacija so javascript iskomentirana na krajot od dokumentov -->
    <!-- momentalna validacija e so pattern atributot -->
    <main>
      <div class="container-fluid container-sm px-4 px-sm-5 py-5">
        <h1 class="display-2 fw-bold text-center my-sm-5">Вработи студенти</h1>
        <form action="connect_db.php" method="POST" class="py-5">
          <div class="row row-cols-1 row-cols-lg-2 g-sm-4 g-3">
            <div class="col">
              <label for="fullName" class="form-label fw-bold"
                >Име и Презиме</label
              >
              <input
                type="text"
                class="form-control p-3"
                id="fullName"
                name="fullName"
                placeholder="Вашето име и презиме"
                pattern="[a-zA-Z\s]+"
                title="Содржи само букви"
              />
            </div>
            <div class="col">
              <label for="companyName" class="form-label fw-bold"
                >Име на компанија</label
              >
              <input
                type="text"
                class="form-control p-3"
                id="companyName"
                name="companyName"
                placeholder="Името на вашата компанија"
                pattern="[a-zA-Z\d.\-_\s]+"
                title="Содржи букви, симболи и бројки"
              />
            </div>
            <div class="col">
              <label for="email" class="form-label fw-bold"
                >Контакт мајл
              </label>
              <input
                type="email"
                class="form-control p-3"
                id="email"
                name="email"
                placeholder="Контакт мајл од вашата компанија"
                pattern="[a-zA-Z\d.\-_]+)@([a-zA-Z\d-]+)\.([a-zA-Z]{2,8})(\.[a-zA-Z]{2,8})"
                title="Формат: example@example.com"
              />
            </div>
            <div class="col">
              <label for="phoneNumber" class="form-label fw-bold"
                >Контакт Телефон
              </label>
              <input
                type="tel"
                class="form-control p-3"
                id="phoneNumber"
                name="phoneNumber"
                placeholder="Контакт телефон од вашата компанија - (+389XXXXXXXX)"
                pattern="\+389([\d]{8,9})"
                title="(+389XXXXXXXX)"
              />
            </div>
            <div class="col">
              <label for="studentType" class="form-label fw-bold"
                >Тип на студент
              </label>
                <select class="form-select w-100 p-3" id="studentType" name="studentType">
                  <option selected="true" disabled="disabled" hidden="">Изберете тип на студент</option>
                  <?php 
                      include('./connect_db.php');
                      $student = mysqli_query($conn, "SELECT * FROM `student`");
                      while($s = mysqli_fetch_array($student)) {
                  ?>
                  <option value="<?php echo $s['id'] ?>"><?php echo $s['type'] ?></option>
                  <?php } ?>
                </select>
            </div>
            <div class="col d-flex align-items-end mt-sm-4 mt-5">
              <input
                type="submit"
                name="send"
                class="btn submit-btn w-100"
                value="испрати"
              />
            </div>
          </div>
        </form>
      </div>
    </main>
    <!---------- FOOTER ---------->
    <footer class="py-3 text-center mt-auto">
      <span class="text-white fw-bold"
        >Изработено со <i class="fa-solid fa-heart" aria-hidden="true"></i> од
        студентите на Brainster</span
      >
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>

    <!-- FORM VALIDATION -->
    <!-- <script src="./assets/js/form-validation.js"></script> -->
  </body>
</html>
