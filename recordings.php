<!DOCTYPE html>
<?php
session_start();
include './configs/PDBC.php';

if (!isset($_SESSION["LoggedUser"])) {
    header("location: index.php");
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
        $selectedPage = "recordings";
        include './pages/pagesidebar.php';
        ?>
             <div class="flex flex-col flex-1 w-full">
                     <?php include './pages/pageheader.php'; ?>
                <main class="h-full overflow-y-auto">
                    <?php if ($user['type'] != 'student') { ?>
                        <div class="container px-6 mx-auto grid">
                            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Upload </h2>
                            <form action="actions/upload_recording.php" method="POST" enctype="multipart/form-data">
                                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                                    <label class="block text-sm mb-4">
                                        <span class="text-gray-700 dark:text-gray-400">Subject</span>
                                        <select id="subject" name="subject" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" required="">
                                            <option value="" disabled="" selected="">Select a subject</option>
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
                                    <input type="file" name="fileToUpload" class="dropify"/>
                                    <label class="block mt-4 text-sm" style="text-align:right;">
                                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Upload</button>
                                    </label>
                                </div>
                            </form>
                        </div>
                    <?php } else { ?>
                        <div class="container px-6 mx-auto grid">
                            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Recordings </h2>
                            <!-- Card -->
                            <div class="mb-2">
                                <div class="grid gap-6 mb-8 md:grid-cols-2">
                                    <?php
                                    $query1 = "SELECT * FROM `student_subjects` INNER JOIN `student` ON (`student_subjects`.`idstudent` = `student`.`idstudent`) INNER JOIN `subject` ON (`student_subjects`.`idsubject` = `subject`.`idsubject`) INNER JOIN `recording` ON (`recording`.`idsubject` = `subject`.`idsubject`) INNER JOIN `user` ON (`student`.`iduser` = `user`.`iduser`) WHERE `user`.iduser='".$_SESSION["LoggedUser"]["iduser"]."'";
                                    $result1 = mysqli_query($con, $query1) or die();
                                    while ($row1 = mysqli_fetch_array($result1)) {
                                        ?>
                                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                            <video width="100%" height="315" controls="false" onclick="openFullscreen(this)">
                                                <source src="uploads/movie.mp4" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
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

                                        function openFullscreen(elem) {
                                            if (elem.requestFullscreen) {
                                                elem.requestFullscreen();
                                            } else if (elem.webkitRequestFullscreen) { /* Safari */
                                                elem.webkitRequestFullscreen();
                                            } else if (elem.msRequestFullscreen) { /* IE11 */
                                                elem.msRequestFullscreen();
                                            }
                                        }
        </script>
    </body>
</html>