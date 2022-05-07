<?php
include '../configs/PDBC.php';

$id = $_GET['id'];
?>
<table class="w-full whitespace-no-wrap">
    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
        <?php
        $query = "SELECT * FROM viewed_event WHERE idscheduled_event='$id'";
        $result = mysqli_query($con, $query) or die();
        while ($row = mysqli_fetch_array($result)) {
            $query1 = "SELECT * FROM `student` INNER JOIN `user` ON (`student`.`iduser` = `user`.`iduser`) WHERE idstudent='" . $row['idstudent'] . "'";
            $result1 = mysqli_query($con, $query1) or die();
            $student = mysqli_fetch_assoc($result1);
            ?>
        <td class="px-4 py-3">
            <div class="flex items-center text-sm">
                <!-- Avatar with inset shadow -->
                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                    <img class="object-cover w-full h-full rounded-full" src="https://ui-avatars.com/api/?name=<?php echo $student['name'];?>&background=random" alt="" loading="lazy">
                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                </div>
                <div>
                    <p class="text-xs text-gray-600 dark:text-gray-400 font-semibold"><?php echo $student['name'];?></p>
                    <p class="text-xs text-gray-600 dark:text-gray-400">
                        <?php echo $row['date'];?>, <?php echo $row['time'];?>
                    </p>
                </div>
            </div>
        </td>
        <?php
    }
    ?>
</tbody>
</table>