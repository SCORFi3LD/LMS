<!DOCTYPE html>
<?php
session_start();
include './configs/PDBC.php';
if (!isset($_SESSION["LoggedUser"])) {
    header("location: index.php");
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <script src="assets/js/init-alpine.js"></script>
    </head>
    <body>
        <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <?php
        $selectedPage = "dashboard";
        include './pages/pagesidebar.php';
        ?>
             <div class="flex flex-col flex-1 w-full">
                     <?php include './pages/pageheader.php'; ?>
                <main class="h-full overflow-y-auto">

                    <?php
                    if ($user['type'] == "student") {
                        ?>
                        <div class="container px-6 mx-auto grid">
                            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Notifications </h2> 
                            <div class="grid gap-6 mb-8">
                                <?php
                                $query0 = "SELECT * FROM student WHERE iduser='" . $user['iduser'] . "'";
                                $result0 = mysqli_query($con, $query0) or die();
                                $row0 = mysqli_fetch_assoc($result0);
                                $query01 = "SELECT * FROM unread_notification INNER JOIN notification ON (`unread_notification`.`idnotification` = `notification`.`idnotification`) WHERE idstudent='" . $row0["idstudent"] . "' AND status='active'";
                                $result01 = mysqli_query($con, $query01) or die();
                                while ($row01 = mysqli_fetch_assoc($result01)) {
                                    ?>
                                    <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                                        <p><?= $row01["notif"] ?></p>
                                        <form action="actions/mark_as_read.php">
                                            <input type="hidden" name="unreadnotification" value="<?= $row01["idunreadnotification"] ?>"/>
                                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
                                                Mark as Read
                                            </button>
                                        </form>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="container px-6 mx-auto grid md:grid-cols-2">
                        <div class="mb-2">
                            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Upcomming Classes </h2>
                            <!-- Cards -->
                            <div class="grid gap-6 mb-8 md:grid-cols-2">
                                <?php
                                $query = "SELECT * FROM `scheduled_event`";
                                if ($user['type'] == "student") {
                                    $query = "SELECT * FROM `scheduled_event` INNER JOIN `student_subjects` ON (`scheduled_event`.`idsubject` = `student_subjects`.`idsubject`) INNER JOIN `student` ON (`student_subjects`.`idstudent` = `student`.`idstudent`) WHERE iduser='" . $user['iduser'] . "'";
                                }
                                $result = mysqli_query($con, $query) or die();
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if ($row['eventstatus'] == 'active') {
                                        ?>
                                        <!-- Card -->
                                        <a @click="openModal" onclick="didShowModal('<?php echo base64_encode(json_encode($row)); ?>')">
                                            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                                <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-200"> <?php echo $row['name']; ?> </p>
                                                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400"> <?php echo $row['date']; ?> </p>
                                                    <span><small class="text-sm font-medium text-gray-600 dark:text-gray-400"> <?php echo date("h:i A", strtotime($row['start'])); ?> to <?php echo date("h:i A", strtotime($row['end'])); ?></small></span>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div class="mb-2">
                            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Upcoming Exams </h2>
                            <!-- Cards -->
                            <div class="grid gap-6 mb-8 md:grid-cols-2">
                                <?php
                                $query1 = "SELECT * FROM `exam` INNER JOIN `subject` ON (`exam`.`idsubject` = `subject`.`idsubject`)";
                                if ($user['type'] == "student") {
                                    $query1 = "SELECT * FROM `exam` INNER JOIN `subject` ON (`exam`.`idsubject` = `subject`.`idsubject`) INNER JOIN `exam_result` ON (`exam_result`.`idexam` = `exam`.`idexam`) INNER JOIN `student` ON (`exam_result`.`idstudent` = `student`.`idstudent`) WHERE `student`.`iduser`='" . $user['iduser'] . "'";
                                }
                                $result1 = mysqli_query($con, $query1) or die();
                                while ($row = mysqli_fetch_assoc($result1)) {
                                    if ($row['examstatus'] == 'active') {
                                        ?>
                                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                            <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-green-100 dark:bg-green-500">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M22 24H2v-4h20v4zM13.06 5.19l3.75 3.75L7.75 18H4v-3.75l9.06-9.06zm4.82 2.68-3.75-3.75 1.83-1.83c.39-.39 1.02-.39 1.41 0l2.34 2.34c.39.39.39 1.02 0 1.41l-1.83 1.83z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-200"> <?php echo $row['subjectname'] . " - " . $row['exam_title']; ?> </p>
                                                <span><small class="text-sm font-medium text-gray-600 dark:text-gray-400"> <?php echo date("Y M d", strtotime($row['date'])); ?> at <?php echo date("h:i A", strtotime($row['start'])); ?></small></span>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <?php
                    if ($user['type'] == "student") {
                        $query2 = "SELECT * FROM `exam_result` INNER JOIN `exam` ON (`exam_result`.`idexam` = `exam`.`idexam`) INNER JOIN `student` ON (`exam_result`.`idstudent` = `student`.`idstudent`) INNER JOIN `subject` ON (`exam`.`idsubject` = `subject`.`idsubject`) WHERE examstatus='done' AND iduser='" . $user['iduser'] . "' ORDER BY marks ASC";
                        $result2 = mysqli_query($con, $query2) or die();
                        $row = mysqli_fetch_assoc($result2);
                        if (mysqli_num_rows($result2) == 0) {
                            return;
                        }
                        if ($row['marks'] < 40) {
                            $keyword = $row['exam_title'] . ' in ' . $row['subjectname'];
                            $keyword = urlencode($keyword);
                            $api = "https://www.googleapis.com/youtube/v3/search?q=$keyword&maxResults=4&type=video&key=AIzaSyDnHGM3XTLNc-yDQn0jSdzAhv9yqaE65Hk";
                            $response = file_get_contents($api);
                            $items = json_decode($response)->items;

                            echo '<div class="container px-6 mx-auto grid"><h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Recommended Videos </h2> <div class="grid gap-6 mb-8 md:grid-cols-2">';
                            for ($x = 0; $x < count($items); $x++) {
                                echo '<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"> <iframe width="100%" height="315" src="https://www.youtube.com/embed/' . $items[$x]->id->videoId . '?autoplay=0"></iframe></div>';
                            }
                            echo '</div></div>';
                        }
                    }
                    ?>
                </main>
            </div>
        </div>

        <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center" style="display: none;">
            <!-- Modal -->
            <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0  transform translate-y-1/2" @click.away="closeModal" @keydown.escape="closeModal" class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl" role="dialog" id="modal" style="display: none;">
                <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
                <header class="flex justify-end">
                    <button class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700" aria-label="close" @click="closeModal">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                        <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </header>
                <!-- Modal body -->
                <div class="mt-4 mb-6">
                    <!-- Modal title -->
                    <p id="modaltitle" class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"></p>
                    <div class="bg-white rounded-lg dark:bg-gray-800">
                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Message</span>
                            <textarea id="eventDesc" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3" readonly></textarea>
                        </label>

                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Join URL</span>
                            <p class="text-blue-500 dark:text-blue-500"><a id="eventUrl" href="" target="_blank"></a></p>
                        </label>

                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Date</span>
                            <input id="eventDate" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" readonly/>
                        </label>

                        <div class="grid gap-6 mb-8 mt-4 md:grid-cols-2">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Starting</span>
                                <input id="eventStart" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" readonly/>
                            </label>

                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Ending</span>
                                <input id="eventEnd" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" readonly/>
                            </label>
                        </div>
                    </div>
                </div>
                <footer class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                    <button @click="closeModal" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Done
                    </button>
                </footer>
            </div>
        </div>

        <!-- My scripts -->
        <script type="text/javascript">
            function didShowModal(encodedString) {
                var jsonObj = JSON.parse(atob(encodedString));
                $('#modaltitle').html(jsonObj.name);
                $('#eventDesc').html(jsonObj.description);
                $('#eventUrl').html(jsonObj.join_url);
                $("#eventUrl").attr("href", jsonObj.join_url);
                $('#eventDate').val(jsonObj.date);
                $('#eventStart').val(jsonObj.start);
                $('#eventEnd').val(jsonObj.end);
<?php if ($user['type'] == "student") { ?>
                    $.get("actions/update_student_event_view.php?eventId=" + jsonObj.idscheduled_event, function (data) {
                        console.log(data);
                    });
<?php } ?>
            }
        </script>
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
            var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
            (function () {
                var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = 'https://embed.tawk.to/6273d9c5b0d10b6f3e70c340/1g2a8lbie';
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        </script>
        <!--End of Tawk.to Script-->
    </body>
</html>