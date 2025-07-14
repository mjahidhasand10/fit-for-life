<?php

/**
 * Template Name: Contact Us
 */

get_template_part('parts/header');

// Handle form submission
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_nonce']) && wp_verify_nonce($_POST['contact_nonce'], 'submit_contact')) {
    $name    = sanitize_text_field($_POST['name']);
    $email   = sanitize_email($_POST['email']);
    $phone   = sanitize_text_field($_POST['phone']);
    $company = sanitize_text_field($_POST['company']);
    $message = sanitize_textarea_field($_POST['message']);
    $captcha = intval($_POST['captcha']);

    if ($captcha !== 16) {
        $errors[] = "Incorrect captcha answer.";
    }

    if (empty($name) || empty($email) || empty($message)) {
        $errors[] = "Please fill in all required fields.";
    }

    if (empty($errors)) {
        $to      = get_option('admin_email'); // You can replace this with a fixed email
        $subject = "New Contact Message from $name";
        $body    = "Name: $name\nEmail: $email\nPhone: $phone\nCompany: $company\n\nMessage:\n$message";
        $headers = ['Content-Type: text/plain; charset=UTF-8'];

        $success = wp_mail($to, $subject, $body, $headers);
    }
}
?>

<main class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Left Sidebar Info -->
        <div class="md:col-span-1 space-y-6">
            <div>
                <h3 class="text-xl font-bold text-gray-900 mb-1">Our store</h3>
                <p class="text-gray-700">80 Eskandar Ali Road,<br>Narayanpur, Pabna Sadar,<br>Pabna</p>
            </div>

            <div>
                <h3 class="text-xl font-bold text-gray-900 mb-1">Contact us</h3>
                <p class="text-gray-700">Phone:<br>01717426742<br>01620858385</p>
                <p class="text-gray-700 mt-2">Email:<br><a href="mailto:info@fitforlifebd.com" class="text-green-600 hover:underline">info@fitforlifebd.com</a></p>
            </div>
        </div>

        <!-- Right Form -->
        <div class="md:col-span-2">
            <h2 class="text-2xl font-semibold mb-6">Contact us for any questions</h2>

            <?php if ($errors): ?>
                <div class="mb-6 bg-red-100 text-red-800 px-4 py-3 rounded">
                    <ul class="list-disc list-inside">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo esc_html($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php elseif ($success): ?>
                <div class="mb-6 bg-green-100 text-green-800 px-4 py-3 rounded">
                    Thank you! Your message has been sent.
                </div>
            <?php endif; ?>

            <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php wp_nonce_field('submit_contact', 'contact_nonce'); ?>

                <input type="text" name="name" placeholder="Your Name" class="border border-gray-300 focus:outline-green-700 px-4 py-2 w-full" required>
                <input type="email" name="email" placeholder="Your Email" class="border border-gray-300 focus:outline-green-700 px-4 py-2 w-full" required>

                <input type="text" name="phone" placeholder="Phone Number" class="border border-gray-300 focus:outline-green-700 px-4 py-2 w-full">
                <input type="text" name="company" placeholder="Company" class="border border-gray-300 focus:outline-green-700 px-4 py-2 w-full">

                <div class="col-span-2">
                    <textarea name="message" rows="5" placeholder="Your Message" class="border border-green-700 focus:outline-green-700 px-4 py-2 w-full" required></textarea>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm mb-1">Please Solve This Question</label>
                    <p class="mb-2 font-semibold text-gray-700">9 + 7 ?</p>
                    <input type="number" name="captcha" class="border border-gray-300 focus:outline-green-700 px-4 py-2 w-full" required>
                </div>

                <div class="col-span-2">
                    <button type="submit" class="bg-red-800 hover:bg-red-700 text-white px-4 py-2 text-sm font-medium uppercase rounded shadow transition-all">
                        Ask a Question
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php get_template_part('parts/footer'); ?>