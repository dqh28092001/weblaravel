<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="shortcut icon" type="image/x-icon" href="../Public/img/icon.png"> -->
    <title>Login And Register</title>
    <link rel="stylesheet" href="{{ asset('FE/css/logincss.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>
    <h2>WELCOME TO ASHION</h2>
    <!-- Đăng Kí -->
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="{{ URL::to('/login_add_customer')}}" method="POST"  >
                {{ csrf_field() }}
                <h1>Create Account</h1>
                <input name="customer_name" id="username" type="text" placeholder="Name" />
                <input name="customer_email" id="email" type="email" placeholder="Email" />
                <input name="customer_password" id="password" type="password" placeholder="Password" />
                <input name="customer_phone"  type="text" placeholder="Phone" />
                {{-- <input name="rpassword" id="rpassword" type="password" placeholder="Nhập lại Password" /> --}}
                <button type="submit" class="btn btn-default">Sign Up</button>
            </form>
        </div>

        <!-- Đăng Nhập -->
        <div class="form-container sign-in-container">
            <form action="{{ URL::to('/login_customer') }}" method="POST">
                {{ csrf_field() }}
                <h1>Sign in</h1>
                <div class="social-container">
                </div>
                <input name="email_account" id="usernamelog" type="text" placeholder="Email" />
                <input name="password_account" id="passwordlog" type="password" placeholder="Password" />
                <a href="">Forgot your password?</a>
                <button type="submit" id="signinButton" name="signin">Sign In</button>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>If you don't have an account, register here</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>


    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');
    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>

</html>
