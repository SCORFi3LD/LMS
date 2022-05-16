<!DOCTYPE html>
<?php
session_start();
include './configs/PDBC.php';
if (!isset($_SESSION["LoggedUser"])) {
    header("location: index.php");
    exit();
}

$user = $_SESSION["LoggedUser"];
$query0 = "SELECT * FROM student WHERE iduser='" . $user["iduser"] . "'";
$result0 = mysqli_query($con, $query0) or die();
$row0 = mysqli_fetch_array($result0)
?>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Education Center</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/tailwind.output.css" />
        <link href="assets/css/switch.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"/>
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
                        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Payments </h2>


                        <div class="w-full overflow-hidden rounded-lg shadow-xs gap-6">
                            <form action="actions/do_pay.php">
                                <div class="mb-8 px-4 py-3 bg-white rounded-lg shadow-md dark:bg-gray-800">
                                    <input type="hidden" name="student" value="<?= $row0["idstudent"] ?>">
                                    <label class="block mt-4 text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Subject
                                        </span>
                                        <select name="subject" id="subject" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" required>
                                            <option value="" disabled selected>Select a subject</option>
                                            <?php
                                            $query = "SELECT * FROM `student_subjects` INNER JOIN `subject` ON (`student_subjects`.`idsubject` = `subject`.`idsubject` ) WHERE `subject`.status='active' AND `student_subjects`.idstudent='" . $row0["idstudent"] . "'";
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
                                        <span class="text-gray-700 dark:text-gray-400">Total Due Amount</span>
                                        <input type="text" id="dueAmount" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" disabled/>
                                    </label>
                                    <label class="block mt-4 text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">Amount</span>
                                        <input type="number" name="amount" id="amount" max="0" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required/>
                                    </label>
                                    <label class="block mt-4 text-sm" style="text-align:right;">
                                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Pay</button>
                                    </label>
                                </div>
                            </form>

                            <h4 class="mb-4 mt-8 text-lg font-semibold text-gray-600 dark:text-gray-300"> Recent Payments </h4>

                            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                                <div class="w-full overflow-x-auto">
                                    <table class="w-full whitespace-no-wrap">
                                        <thead>
                                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                                <th class="px-4 py-3">Subject</th>
                                                <th class="px-4 py-3">Paid Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                            <?php
                                            $query1 = "SELECT * FROM payroll INNER JOIN `lms`.`subject` ON (`payroll`.`idSubject` = `subject`.`idsubject`) WHERE idStudent='" . $row0["idstudent"] . "'";
                                            $result1 = mysqli_query($con, $query1) or die();
                                            while ($row = mysqli_fetch_array($result1)) {
                                                ?>
                                                <tr class="text-gray-700 dark:text-gray-400">
                                                    <td class="px-4 py-3">
                                                        <?php echo $row['subjectname']; ?>
                                                    </td>
                                                    <td class="px-4 py-3 text-sm">
                                                        <?php echo $row['amount']; ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <!-- My Scripts --> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <script src="./assets/js/init-alpine.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
        <script type="text/javascript">
            $('#subject').on('change', function () {
                $.get("actions/get_due_amount.php?student=<?= $row0["idstudent"] ?>&subject=" + this.value, function (data) {
                    $('#amount').attr({"max": data});
                    $('#dueAmount').val(data);
                });
            });
        </script>
        <script type="text/javascript">

        </script>
    </body>
</html>