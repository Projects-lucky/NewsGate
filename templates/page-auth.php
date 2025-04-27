<?php
/**
 * Template Name: Authentication Page
 */

// Handle Registration Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $username = sanitize_user($_POST['username']);
    $email = sanitize_email($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate inputs
    if (username_exists($username)) {
        $registration_error = 'Username already exists.';
    } elseif (email_exists($email)) {
        $registration_error = 'Email already exists.';
    } elseif ($password !== $confirm_password) {
        $registration_error = 'Passwords do not match.';
    } else {
        // Create new user
        $user_id = wp_create_user($username, $password, $email);
        if (!is_wp_error($user_id)) {
            $registration_success = 'Registration successful! Please log in.';
        } else {
            $registration_error = 'Error during registration.';
        }
    }
}

// Handle Login Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $creds = array(
        'user_login'    => sanitize_user($_POST['email']),
        'user_password' => $_POST['password'],
        'remember'      => isset($_POST['remember']) ? true : false,
    );

    $user = wp_signon($creds, false);
    if (!is_wp_error($user)) {
        wp_redirect(home_url()); // Redirect after successful login
        exit; // Stop further execution
    } else {
        $login_error = 'Invalid username or password.';
    }
}

// Include the header.php file from the partials folder
get_template_part('./partials/header');
?>

<section class="auth-page-wpr-sec">
    <h1>Authentication Page</h1>
    <div class="auth-btn-sec">
        <button id="show-login" class="auth-btn btn-Login">Login</button>
        <button id="show-register" class="auth-btn btn-register">Signup</button>
    </div>

    <div class="auth-form-sec">
        <!-- Display Registration Messages -->
        <?php if (isset($registration_error)) : ?>
            <p class="auth-msg error"><?php echo $registration_error; ?></p>
        <?php endif; ?>
        <?php if (isset($registration_success)) : ?>
            <p class="auth-msg success"><?php echo $registration_success; ?></p>
        <?php endif; ?>

        <!-- Registration Form -->
        <form id="register-form" class="af-form" method="post">
            <p class="af-title">Register</p>
            <p class="af-message">Signup now and get full access to our app.</p>
            <div class="af-flex">
                <label>
                    <input required name="username" placeholder="" type="text" class="af-input">
                    <span>Username</span>
                </label>
                <label>
                    <input required name="email" placeholder="" type="email" class="af-input">
                    <span>Email</span>
                </label>
            </div>
            <label>
                <input required name="password" placeholder="" type="password" class="af-input">
                <span>Password</span>
            </label>
            <label>
                <input required name="confirm_password" placeholder="" type="password" class="af-input">
                <span>Confirm Password</span>
            </label>
            <button type="submit" name="register" class="af-submit">Submit</button>
            <p class="af-signin">Already have an account? <a href="#">Signin</a></p>
        </form>

        <!-- Display Login Messages -->
        <?php if (isset($login_error)) : ?>
            <p class="auth-msg error"><?php echo $login_error; ?></p>
        <?php endif; ?>

        <!-- Login Form -->
        <form id="login-form" class="lf-form" method="post">
            <div class="lf-flex-column">
                <label>Email</label>
            </div>
            <div class="lf-inputForm">
                <input type="text" name="email" class="lf-input" placeholder="Enter your Email">
            </div>
            <div class="lf-flex-column">
                <label>Password</label>
            </div>
            <div class="lf-inputForm">
                <input type="password" name="password" class="lf-input" placeholder="Enter your Password">
            </div>
            <div class="lf-flex-row">
                <div>
                    <input type="checkbox" name="remember">
                    <label>Remember me</label>
                </div>
                <span class="lf-span">Forgot password?</span>
            </div>
            <button type="submit" name="login" class="lf-button-submit">Sign In</button>
            <p class="lf-p">Don't have an account? <span class="lf-span">Sign Up</span></p>
        </form>
    </div>

    <div class="auth-msg-sec"></div>
</section>

<?php
// Include the footer.php file from the partials folder
get_template_part('./partials/footer');
?>