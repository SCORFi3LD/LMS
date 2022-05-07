<!DOCTYPE html>
<?php
session_start();
include './configs/PDBC.php';
if (!isset($_SESSION["LoggedUser"])) {
    header("location: index.php");
    exit();
}

$user = $_SESSION["LoggedUser"];
?>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Education Center</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/tailwind.output.css" />
        <link href="assets/css/switch.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <script src="assets/js/init-alpine.js"></script>
    </head>
    <body>
        <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <?php
        $selectedPage = "add_new_due";
        include './pages/pagesidebar.php';
        ?>
             <div class="flex flex-col flex-1 w-full">
                     <?php include './pages/pageheader.php'; ?>
                <main class="h-full overflow-y-auto">
                    <div class="container px-6 mx-auto grid">
                        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Add New Due </h2>
                        <!-- Card -->
                        <form action="actions/add_new_due.php" method="GET">
                            <div class="px-4 py-3 bg-white rounded-lg shadow-md dark:bg-gray-800">
                                <label class="block mt-4 text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">
                                        Subject
                                    </span>
                                    <select name="subject" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" required>
                                        <option value="" disabled selected>Select a subject</option>
                                        <?php
                                        $query = "SELECT * FROM `subject` WHERE status='active'";
                                        $result = mysqli_query($con, $query) or die();
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <option value="<?php echo $row['idsubject']; ?>"><?php echo $row['subjectname']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </label>

                                <label class="block mt-4 text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Amount</span>
                                    <input type="number" name="amount" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required/>
                                </label>

                                <label class="block mt-4 text-sm" style="text-align:right;">
                                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Add</button>
                                </label>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </div>

        <!-- My Scripts -->
        <script type="text/javascript">
            function didChangeStatus(element, lecturer) {
                var status = element.checked ? 'active' : 'deactive';
                $.get("actions/update_user_status.php?id=" + lecturer + "&status=" + status, function (data) {
                    if (data == 1) {
                        location.reload()
                    }
                });
            }
        </script>
    </body>
</html>