<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Create account - Education Center</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/tailwind.output.css" />
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <script src="assets/js/init-alpine.js"></script>
    </head>
    <body>
        <form action="actions/register.php" method="POST">
            <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
                <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
                    <div class="flex flex-col overflow-y-auto md:flex-row">

                        <div class="h-32 md:h-auto md:w-1/2">
                            <img aria-hidden="true" class="object-cover w-full h-full dark:hidden" src="assets/img/create-account-office.jpeg" alt="Office" />
                            <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block" src="assets/img/create-account-office-dark.jpeg" alt="Office" />
                        </div>
                        <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                            <div class="w-full">
                                <?php
                                if (isset($_GET["msg"])) {
                                    ?>
                                <div class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 <?php echo isset($_GET["success"]) ? "bg-teal-600": "bg-red-600";?> rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple">
                                        <div class="flex items-center">
                                            <svg class="w-8 h-8 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="<?php echo isset($_GET["success"]) ? "M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z": "M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z";?>"></path>
                                            </svg>
                                            <span><?php echo base64_decode($_GET["msg"]);?></span>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"> Create account </h1>
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Email</span>
                                    <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="username" placeholder="Enter your email" required/>
                                </label>
                                <label class="block mt-4 text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Password</span>
                                    <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="password" placeholder="Enter password" type="password" required/>
                                </label>
                                <label class="block mt-4 text-sm">
                                    <span class="text-gray-700 dark:text-gray-400"> Confirm password </span>
                                    <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="confirm_password" placeholder="Enter password again" type="password" required/>
                                </label>
                                <div class="flex mt-6 text-sm">
                                    <label class="flex items-center dark:text-gray-400">
                                        <input type="checkbox" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" required/>
                                        <span class="ml-2"> I agree to the <a class="underline" href="privacy-policy.html" target="_blank">privacy policy</a></span>
                                    </label>
                                </div>
                                <!-- You should use a button here, as the anchor is only used for the example  -->
                                <button type="submit" class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"> Create account </button>
                                <p class="mt-4">
                                    <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline" href="index.php"> Already have an account? Login </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>