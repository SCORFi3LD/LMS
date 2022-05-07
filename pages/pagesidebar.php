<?php
$user = $_SESSION["LoggedUser"];
$selectedIndecatorSpan = '<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>';
$selectedClassStr = "inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100";
$unselectedClassStr = "inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200";
?>
<!-- Desktop sidebar -->
<aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#"> Education Center </a>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <?php echo $selectedPage == "dashboard" ? $selectedIndecatorSpan : ""; ?>
                <a class="<?php echo $selectedPage == "dashboard" ? $selectedClassStr : $unselectedClassStr; ?>" href="home.php">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="ml-4">Dashboard</span>
                </a>
            </li>
        </ul>
        <ul>
            <?php
            if ($user["type"] == "superadmin") {
                ?>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "create_lecturer" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "create_lecturer" ? $selectedClassStr : $unselectedClassStr; ?>" href="create_lecturer.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Create New Lecturer</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "verify_students" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "verify_students" ? $selectedClassStr : $unselectedClassStr; ?>" href="verify_students.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Verify Students</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "create_event" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "create_event" ? $selectedClassStr : $unselectedClassStr; ?>" href="create_event.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Create Event</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "manage_events" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "manage_events" ? $selectedClassStr : $unselectedClassStr; ?>" href="manage_events.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Manage Events</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "create_exam" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "create_exam" ? $selectedClassStr : $unselectedClassStr; ?>" href="create_exam.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Create Exam</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "manage_exam_results" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "manage_exam_results" ? $selectedClassStr : $unselectedClassStr; ?>" href="manage_exam_results.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Add Exam Results</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "register_subjects" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "register_subjects" ? $selectedClassStr : $unselectedClassStr; ?>" href="register_subjects.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Register Subjects</span>
                    </a>
                </li>
                <?php
            } else if ($user["type"] == "lecturer") {
                ?>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "create_event" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "create_event" ? $selectedClassStr : $unselectedClassStr; ?>" href="create_event.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Create Event</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "manage_events" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "manage_events" ? $selectedClassStr : $unselectedClassStr; ?>" href="manage_events.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Manage Events</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "create_exam" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "create_exam" ? $selectedClassStr : $unselectedClassStr; ?>" href="create_exam.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Create Exam</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "manage_exam_results" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "create_exam" ? $selectedClassStr : $unselectedClassStr; ?>" href="manage_exam_results.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Add Exam Results</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "recordings" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "recordings" ? $selectedClassStr : $unselectedClassStr; ?>" href="recordings.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Recordings</span>
                    </a>
                </li>
                <?php
            } else {
                ?>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "student_exam_results" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "student_exam_results" ? $selectedClassStr : $unselectedClassStr; ?>" href="student_exam_results.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">My Exam Results</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "recordings" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "recordings" ? $selectedClassStr : $unselectedClassStr; ?>" href="recordings.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Recordings</span>
                    </a>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</aside>
<!-- Mobile sidebar -->
<!-- Backdrop -->
<div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
<aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden" x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu" @keydown.escape="closeSideMenu">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#"> Education Center </a>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <?php echo $selectedPage == "dashboard" ? $selectedIndecatorSpan : ""; ?>
                <a class="<?php echo $selectedPage == "dashboard" ? $selectedClassStr : $unselectedClassStr; ?>" href="home.php">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="ml-4">Dashboard</span>
                </a>
            </li>
        </ul>
        <ul>
            <?php
            if ($user["type"] == "superadmin") {
                ?>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "create_lecturer" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "create_lecturer" ? $selectedClassStr : $unselectedClassStr; ?>" href="create_lecturer.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Create New Lecturer</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "verify_students" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "create_event" ? $selectedClassStr : $unselectedClassStr; ?>" href="verify_students.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Verify Students</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "create_event" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "create_event" ? $selectedClassStr : $unselectedClassStr; ?>" href="create_event.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Create Event</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "manage_events" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "manage_events" ? $selectedClassStr : $unselectedClassStr; ?>" href="manage_events.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Manage Events</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "create_exam" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "create_exam" ? $selectedClassStr : $unselectedClassStr; ?>" href="create_exam.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Create Exam</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "manage_exam_results" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "manage_exam_results" ? $selectedClassStr : $unselectedClassStr; ?>" href="manage_exam_results.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Add Exam Results</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "register_subjects" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "register_subjects" ? $selectedClassStr : $unselectedClassStr; ?>" href="register_subjects.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Register Subjects</span>
                    </a>
                </li>
                <?php
            } else if ($user["type"] == "lecturer") {
                ?>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "create_event" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "create_event" ? $selectedClassStr : $unselectedClassStr; ?>" href="create_event.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Create Event</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "manage_events" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "manage_events" ? $selectedClassStr : $unselectedClassStr; ?>" href="manage_events.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Manage Events</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "create_exam" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "create_exam" ? $selectedClassStr : $unselectedClassStr; ?>" href="create_exam.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Create Exam</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "manage_exam_results" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "manage_exam_results" ? $selectedClassStr : $unselectedClassStr; ?>" href="manage_exam_results.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">Add Exam Results</span>
                    </a>
                </li>
                <?php
            } else {
                ?>
                <li class="relative px-6 py-3">
                    <?php echo $selectedPage == "student_exam_results" ? $selectedIndecatorSpan : ""; ?>
                    <a class="<?php echo $selectedPage == "student_exam_results" ? $selectedClassStr : $unselectedClassStr; ?>" href="student_exam_results.php">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="ml-4">My Exam Results</span>
                    </a>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</aside>