<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Demo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {

            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.2);
            border: none;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            cursor: pointer;
        }

        .card-title {
            font-size: 20px;
            font-weight: bold;
        }

        .card-text {
            margin-bottom: 0;
        }

        .card-radio {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        #login-success-btn {
            margin-top: 20px;
            padding: 10px 30px;
            border-radius: 30px;
            background-color: #28A745;
            color: #FFFFFF;
            width: 200px;
        }

        .card.active {
            border-color: #28A745;
        }

        .card.active .card-title {
            color: #28A745;
        }

        .card.active .card-radio .form-check-input:checked+.form-check-label::before {
            background-color: #28A745;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-12 text-center mb-3">
                <h1>Login As</h1>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-4">
                <div class="card">
                    <div class="card-body" role="button">
                        <div class="form-check card-radio">
                            <input id="elephant" type="radio" class="form-check-input">
                            <label class="form-check-label" for="elephant"></label>
                        </div>
                        <img src="Images/icons8-permanent-job-48.png" alt="" class="img-fluid">
                        <h5 class="card-title">Administrator</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <a href="login2.php?roll=admin"></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-4">
                <div class="card">
                    <div class="card-body" role="button">
                        <div class="form-check card-radio">
                            <input id="lion" type="radio" class="form-check-input">
                            <label class="form-check-label" for="lion"></label>
                        </div>
                        <img src="Images/icons8-management-48.png" alt="" class="img-fluid">
                        <h5 class="card-title">User</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <a href="login2.php?roll=user"></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-4">
                <div class="card">
                    <div class="card-body" role="button">
                        <div class="form-check card-radio">
                            <input id="zebra" type="radio" class="form-check-input">
                            <label class="form-check-label" for="zebra"></label>
                        </div>
                        <img src="Images/icons8-administrator-male-skin-type-7-48.png" alt="" class="img-fluid">
                        <h5 class="card-title">Skill worker</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <a href="login2.php?roll=worker"></a>
                    </div>
                </div>
            </div>
           
            <div class="col-12 mt-5 text-center">
                <a class="btn btn-success" id="login-success-btn" disabled>Select a Role</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('input:radio').change(function () {
                var radioClicked = $(this).attr('id');
                unclickRadio();
                removeActive();
                clickRadio(radioClicked);
                updateButton(radioClicked);
            });
            $(".card-body").click(function () {
                var inputElement = $(this).find('input[type=radio]').attr('id');
                unclickRadio();
                removeActive();
                makeActive(inputElement);
                clickRadio(inputElement);
                updateButton(inputElement);
            });
        });

        function unclickRadio() {
            $("input:radio").prop("checked", false);
        }

        function clickRadio(inputElement) {
            $("#" + inputElement).prop("checked", true);
        }

        function removeActive() {
            $(".card").removeClass("active");
        }

        function makeActive(element) {
            $("#" + element).closest(".card").addClass("active");
        }

        function updateButton(cardName) {
            var buttonText = $("#" + cardName).closest(".card").find(".card-title").text();
            var buttonLink = $("#" + cardName).closest(".card").find("a").attr("href");
            $("#login-success-btn").text(buttonText);
            $("#login-success-btn").prop("href", buttonLink);
            $("#login-success-btn").prop("disabled", false);
        }
    </script>
</body>

</html>

