<!DOCTYPE html>
<?php
session_start();
include './configs/PDBC.php';
if (!isset($_SESSION["LoggedUser"])) {
    header("location: index.php");
    exit();
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
        <link rel="stylesheet" href="assets/css/tailwind.output.css" />
        <link href="assets/css/switch.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"/>
    </head>
    <body>
        <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <?php
        $selectedPage = "manage_exam_results";
        include './pages/pagesidebar.php';
        ?>
             <div class="flex flex-col flex-1 w-full">
                     <?php include './pages/pageheader.php'; ?>
                <main class="h-full overflow-y-auto">
                    <div class="container px-6 mx-auto grid">
                        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Add Exam Results </h2>

                        <div class="w-full overflow-hidden rounded-lg shadow-xs gap-6 grid md:grid-cols-2">
                            <div class="w-full overflow-x-auto">

                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Exams</span>
                                    <select id="exam" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" required="">
                                        <option value="" disabled="" selected="">Select a exam</option>
                                        <?php
                                        $query = "SELECT * FROM `exam` WHERE examstatus='active'";
                                        $result = mysqli_query($con, $query) or die();
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <option value="<?php echo $row['idexam']; ?>"><?php echo $row['exam_title']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </label>

                                <label class="block mt-4 text-sm" style="text-align:right;">
                                    <a onclick="return checkValid()" class="px-4 py-2 text-sm font-medium text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" href="actions/exam_result_sheet.csv">Download student list</a>
                                </label>
                            </div>

                            <div class="w-full overflow-x-auto">

                            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <div class="grid gap-6 mt-4 mb-4">
                                <label class="block text-sm">
                                    <form action="actions/upload_exam_results.php" method="post" enctype="multipart/form-data" onsubmit="return checkValid()">
                                        <input type="hidden" name="id" id="examId"/>
                                        <input type="file" name="csv" class="dropify" data-height="300"  data-allowed-file-extensions="csv"/>
                                        <br>
                                        <label class="block text-sm" style="text-align:right;">
                                            <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Update results</button>
                                        </label>
                                    </form>
                                </label>
                            </div>
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
            $(document).ready(function () {
                $('.dropify').dropify();
            });
        </script>
        <script type="text/javascript">
            function checkValid(){
                var examId = $('#exam').val();
                if (examId == null) {
                    alert("Please select the exam name to add results");
                    return false;
                }
                return true;
            }

            $('#exam').change(function () {
                const examId = this.value;
                $.get("actions/get_exam_table_data.php?id=" + examId, function () {
                    $('#examId').val(examId);
                });
            });
        </script>
    </body>
</html>