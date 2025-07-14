<?php

/**
 * Template Name: My Account
 */
get_template_part(slug: 'parts/header');
?>

<style>
    .auth-wrapper {
        max-width: 900px;
        margin: 60px auto;
        border: 1px solid #eee;
        padding: 30px;
        display: flex;
        gap: 40px;
    }

    .auth-form {
        flex: 1;
    }

    .auth-form h2 {
        font-size: 1.5rem;
        margin-bottom: 20px;
    }

    .auth-form label {
        display: block;
        margin-bottom: 6px;
        font-weight: bold;
    }

    .auth-form input[type="text"],
    .auth-form input[type="email"],
    .auth-form input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .auth-form .btn {
        background: #c0392b;
        color: #fff;
        padding: 12px;
        width: 100%;
        border: none;
        text-transform: uppercase;
        font-weight: bold;
        cursor: pointer;
    }

    .auth-form .btn:hover {
        background: #a8322a;
    }

    .auth-description {
        flex: 1;
        border-left: 1px solid #eee;
        padding-left: 30px;
    }

    .auth-description h2 {
        font-size: 1.4rem;
        margin-bottom: 15px;
    }

    .auth-description p {
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .auth-description button {
        background: #f5f5f5;
        border: none;
        margin-top: 20px;
        padding: 10px 20px;
        font-weight: bold;
        cursor: pointer;
    }

    .forgot {
        margin-top: -12px;
        margin-bottom: 15px;
        text-align: right;
    }

    .forgot a {
        color: green;
        text-decoration: none;
    }

    .remember {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.9rem;
        margin-bottom: 16px;
    }

    .strength {
        background: #4CAF50;
        color: white;
        padding: 10px;
        margin-bottom: 15px;
    }

    .helper-text {
        font-size: 0.9rem;
        color: #555;
        margin-bottom: 20px;
    }

    .hidden {
        display: none;
    }
</style>

<div class="auth-wrapper">
    <!-- FORM SECTION -->
    <div class="auth-form">
        <!-- Login Form -->
        <div id="login-form">
            <h2>LOGIN</h2>
            <form method="post" action="<?php echo esc_url(wp_login_url()); ?>">
                <label for="log">Username or email address *</label>
                <input type="text" name="log" id="log" required>

                <label for="pwd">Password *</label>
                <input type="password" name="pwd" id="pwd" required>

                <div class="forgot">
                    <a href="<?php echo esc_url(wp_lostpassword_url()); ?>">Lost your password?</a>
                </div>

                <button class="btn" type="submit">Log In</button>

                <div class="remember">
                    <input type="checkbox" name="rememberme" id="rememberme" value="forever">
                    <label for="rememberme">Remember me</label>
                </div>
            </form>
        </div>

        <!-- Register Form -->
        <div id="register-form" class="hidden">
            <h2>REGISTER</h2>
            <form method="post" action="<?php echo esc_url(site_url('wp-login.php?action=register', 'login_post')); ?>">
                <label for="user_login">Username *</label>
                <input type="text" name="user_login" id="user_login" required>

                <label for="user_email">Email address *</label>
                <input type="email" name="user_email" id="user_email" required>

                <label for="user_pass">Password *</label>
                <input type="password" name="user_pass" id="user_pass" required>

                <div class="strength">Strong</div>

                <p class="helper-text">
                    Your personal data will be used to support your experience throughout this website,
                    to manage access to your account, and for other purposes described in our privacy policy.
                </p>

                <button class="btn" type="submit">Register</button>
            </form>
        </div>
    </div>

    <!-- DESCRIPTION SECTION -->
    <div class="auth-description">
        <h2 id="toggle-heading">REGISTER</h2>
        <p>
            Registering for this site allows you to access your order status and history.
            Just fill in the fields below, and we'll get a new account set up for you in no time.
            We will only ask you for information necessary to make the purchase process faster and easier.
        </p>
        <button id="toggle-button">LOGIN</button>
    </div>
</div>

<script>
    const toggleButton = document.getElementById("toggle-button");
    const loginForm = document.getElementById("login-form");
    const registerForm = document.getElementById("register-form");
    const heading = document.getElementById("toggle-heading");

    toggleButton.addEventListener("click", () => {
        const loginVisible = !loginForm.classList.contains("hidden");
        loginForm.classList.toggle("hidden", loginVisible);
        registerForm.classList.toggle("hidden", !loginVisible);
        toggleButton.innerText = loginVisible ? "LOGIN" : "REGISTER";
        heading.innerText = loginVisible ? "LOGIN" : "REGISTER";
    });
</script>

<?php get_template_part(slug: 'parts/footer'); ?>