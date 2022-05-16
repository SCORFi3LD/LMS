<!DOCTYPE html>
<?php
session_start();
include './configs/PDBC.php';
if (!isset($_SESSION["LoggedUser"])) {
    header("location: index.php");
}

$user = $_SESSION["LoggedUser"];
if ($user['type'] == 'student') {
    header("location: home.php");
    exit();
}
?>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Education Center</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <script src="./assets/js/init-alpine.js"></script>
    </head>
    <body>
        <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <?php
        $selectedPage = "create_announcements";
        include './pages/pagesidebar.php';
        ?>
             <div class="flex flex-col flex-1 w-full">
                     <?php include './pages/pageheader.php'; ?>
                <main class="h-full overflow-y-auto">
                    <div class="container px-6 mx-auto grid">
                        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Create Announcements </h2>
                        <!-- Card -->
                        <form action="actions/create_announcement.php" method="POST">
                            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                                <?php
                                $query = "SELECT * FROM `lecturer` WHERE iduser='". $user['iduser'] ."'";
                                $result = mysqli_query($con, $query) or die();
                                $row = mysqli_fetch_array($result)
                                ?>
                                <input type="hidden" name="subject" value="<?= $row['idsubject']?>">
                                <label class="block mt-4 text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Message</span>
                                    <textarea name="msg" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="6"></textarea>
                                </label>

                                <label class="block mt-4 text-sm" style="text-align:right;">
                                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Create</button>
                                </label>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>