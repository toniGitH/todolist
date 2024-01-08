
<div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    
    <!-- Background shadow for popup better visibility -->
    <div class="fixed inset-0 transition-opacity">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <!-- Modal content -->
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full sm:max-w-3xl">
    
        <div class="flex p-2 mb-2">

            <div class="flex w-full">

                    <div class="w-3/12 bg-orange-400 rounded-md p-1 text-center">
                        <span class="font-bold">Created by</span><br>
                        <div class="bg-white rounded-md my-2">
                            <span class="w-full"><?php echo " " . ($task['task_created_by']); ?></span><br>
                            <span class="w-full bg-white text-sm"><?php echo " " . ($task['task_creation_date']); ?></span>
                        </div>
                    </div>

                    <div class="w-6/12 ml-2 flex flex-col items-center justify-center">
                        <h1 class="block w-full text-center font-bold text-orange-400 text-xl"><?php echo strtoupper($task['task_name']); ?></h1>
                        <span class="text-center w-full text-gray-400"><?php echo " " . ($task['task_status']); ?></span>
                        <!--<span class="border border-gray-300 rounded-md p-1 block w-50"><?php echo $shortenedText . "..."; ?></span>-->
                    </div>

                    <div class="w-3/12 ml-2 bg-orange-400 rounded-md p-1 text-center">
                        <span class="font-bold">Assigned to</span><br>
                            <div class="bg-white rounded-md mt-2 mb-3">
                                <span class="w-full"><?php echo " " . ($task['task_assigned_to']); ?></span><br>
                            </div>
                        <p class="text-center text-sm"><strong>Deadline:</strong> <?php echo($task['task_deadline']); ?></p>
                    </div>


            </div>

            <!--<div class="ml-2 w-1/12 text-center">
                <div class="flex flex-col items-center justify-center h-full">
                    <button class="text-gray-400 hover:text-lime-500 p-1" onclick="toggleModal('task-<?php echo $task['task_id']; ?>')"><i class="fas fa-eye text-lg" title="View task details"></i></button>
                    <button class="text-gray-400 hover:text-lime-500 p-1"><a href="<?php echo WEB_ROOT . "/getupdateform/" . $task['task_id']; ?>"><i class="fas fa-edit text-lg" title="Edit task"></i></a></button>
                    <button class="text-gray-400 hover:text-lime-500 p-1"><a href="<?php echo WEB_ROOT . "/getViewPreDelete/" . $task['task_id']; ?>"><i class="fas fa-trash text-lg" title="Delete task"></i></a></button>
                </div>

            </div>-->

        </div>

        <div class="bg-orange-100 p-6 m-4 rounded">
            <div>
                <h2 class="mb-4 text-xl">Task details:</h2>
            </div>
            <span class="w-full"><?php echo " " . ($task['task_details']); ?></span><br>
        </div>
        
        <div class="bg-yellow-50 flex justify-center my-6">
            <button class="bg-orange-500 hover:bg-lime-400 text-white font-bold py-2 px-4 rounded" onclick="toggleModal('task-<?php echo $task['task_id']; ?>')">
                Close
            </button>
        </div>

    </div>

</div>