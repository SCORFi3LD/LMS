<!DOCTYPE html>
<?php
session_start();
include './configs/PDBC.php';
if (!isset($_SESSION["LoggedUser"])) {
    header("location: index.php");
    exit();
}

$user = $_SESSION["LoggedUser"];
if ($user['type'] != 'superadmin') {
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <script src="assets/js/init-alpine.js"></script>
    </head>
    <body>
        <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <?php
        $selectedPage = "verify_students";
        include './pages/pagesidebar.php';
        ?>
             <div class="flex flex-col flex-1 w-full">
                     <?php include './pages/pageheader.php'; ?>
                <main class="h-full overflow-y-auto">
                    <div class="container px-6 mx-auto grid">
                        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Registered Students </h2>
                        <!-- Card -->
                        <div class="w-full overflow-hidden rounded-lg shadow-xs">
                            <div class="w-full overflow-x-auto">
                                <table class="w-full whitespace-no-wrap">
                                    <thead>
                                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                            <th class="px-4 py-3">Student</th>
                                            <th class="px-4 py-3">Email</th>
                                            <th class="px-4 py-3">Subjects</th>
                                            <th class="px-4 py-3">Status</th>
                                            <th class="px-4 py-3">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                        <?php
                                        $query = "SELECT * FROM `student` INNER JOIN `user` ON (`student`.`iduser` = `user`.`iduser`)";
                                        $result = mysqli_query($con, $query) or die();
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <tr class="text-gray-700 dark:text-gray-400">
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center text-sm">
                                                        <!-- Avatar with inset shadow -->
                                                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                            <img class="object-cover w-full h-full rounded-full" src="https://ui-avatars.com/api/?name=<?php echo $row['name']; ?>&background=random" alt="" loading="lazy">
                                                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                                        </div>
                                                        <div>
                                                            <p class="font-semibold"><?php echo $row['name']; ?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3 text-sm">
                                                    <?php echo $row['email']; ?>
                                                </td>
                                                <td class="px-4 py-3 text-sm">
                                                    <?php
                                                    $isSubjectsAvaliable = false;
                                                    $query1 = "SELECT * FROM `student_subjects` INNER JOIN `subject` ON (`student_subjects`.`idsubject` = `subject`.`idsubject`) WHERE idstudent='" . $row['idstudent'] . "'";
                                                    $result1 = mysqli_query($con, $query1) or die();
                                                    while ($row1 = mysqli_fetch_array($result1)) {
                                                        $isSubjectsAvaliable = true
                                                        ?>
                                                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"><?php echo $row1['subjectname']; ?></span>&nbsp;
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td class="px-4 py-3 text-xs">
                                                    <label class="switch">
                                                        <input type="checkbox" <?php echo $row[7] == 'active' ? "checked" : ""; ?> <?php echo $isSubjectsAvaliable?'':'disabled';?> onchange="didChangeStatus(this, <?php echo $row['iduser']; ?>)"/>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center space-x-4 text-sm">
                                                        <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-full active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" aria-label="Edit" @click="openModal" onclick="didShowModal(<?php echo $row['idstudent']; ?>)">
                                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
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
                </main>
            </div>
        </div>

        <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center" style="display: none;">
            <!-- Modal -->
            <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0  transform translate-y-1/2" @click.away="closeModal" @keydown.escape="closeModal" class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl" role="dialog" id="modal" style="display: none;">
                <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
                <form action="actions/update_student_subjects.php" method="POST">
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
                        <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                            Edit Subjects
                        </p>
                        <div class="bg-white rounded-lg dark:bg-gray-800">
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">
                                    Select the subjects. <br>
                                    <small class="text-green-6700 dark:text-green-400">Press ctrl button to select multiple</small>
                                </span>
                                <input type="hidden" name="id" id="editingStudentId"/>
                                <select name="subjects[]" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-multiselect focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" multiple required>         
                                    <?php
                                    $query2 = "SELECT * FROM `subject` WHERE status='active'";
                                    $result2 = mysqli_query($con, $query2) or die();
                                    while ($row = mysqli_fetch_array($result2)) {
                                        ?>
                                        <option value="<?php echo $row['idsubject'];?>"><?php echo $row['subjectname'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </label>
                        </div>
                    </div>
                    <footer class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                        <button type="button" @click="closeModal" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                            Cancel
                        </button>
                        <button type="submit" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Update
                        </button>
                    </footer>
                </form>
            </div>
        </div>

        <!-- My Scripts -->
        <script type="text/javascript">
            function didChangeStatus(element, student) {
                var status = element.checked ? 'active' : 'deactive';
                $.get("actions/update_user_status.php?id=" + student + "&status=" + status, function (data) {
                    if (data == 1) {
                        location.reload();
                    }
                });
            }

            function didShowModal(student) {
                $('#editingStudentId').val(student);
            }
        </script>
    </body>
</html>