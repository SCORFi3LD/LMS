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
        <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <script src="./assets/js/init-alpine.js"></script>
    </head>
    <body>
        <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <?php
        $selectedPage = "student_exam_results";
        include './pages/pagesidebar.php';
        ?>
             <div class="flex flex-col flex-1 w-full">
                     <?php include './pages/pageheader.php'; ?>
                <main class="h-full overflow-y-auto">
                    <div class="container px-6 mx-auto grid">
                        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> My Exam Results </h2>
                        <!-- Card -->

                        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-4 py-3">Subject</th>
                                        <th class="px-4 py-3">Topic</th>
                                        <th class="px-4 py-3">Date and time</th>
                                        <th class="px-4 py-3">Marks</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    <?php
                                    $query = "SELECT * FROM `exam_result` INNER JOIN `exam` ON (`exam_result`.`idexam` = `exam`.`idexam`) INNER JOIN `student` ON (`exam_result`.`idstudent` = `student`.`idstudent`) INNER JOIN `subject` ON (`exam`.`idsubject` = `subject`.`idsubject`) WHERE iduser='" . $user["iduser"] . "' AND examstatus='done'";
                                    $result = mysqli_query($con, $query) or die();
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr class="text-gray-700 dark:text-gray-400"> 
                                            <td class="px-4 py-3 text-sm"><?php echo $row['subjectname']; ?></td>
                                            <td class="px-4 py-3 text-sm"><?php echo $row['exam_title']; ?></td>
                                            <td class="px-4 py-3 text-sm"><?php echo $row['date'] . ' ' . $row['start']; ?></td>
                                            <td class="px-4 py-3 text-sm"><?php echo $row['marks']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>