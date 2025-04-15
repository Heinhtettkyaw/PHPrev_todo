<?php
require 'config.php';
// Fetch tasks from the database    
$pdostmt = $pdo->prepare("SELECT * FROM todo ORDER BY created_at DESC");
$pdostmt->execute();
$results = $pdostmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h1>Todo List</h1>
        </div>
        <div class="card-body">
            <!-- Updated Add Task Button -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                Add Task
            </button>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($results){
                        foreach($results as $row){ ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['description']; ?></td>  
                                <td><?php echo $row['created_at']; ?></td>
                                <td>
                                    <button type="button" 
                                            class="btn btn-warning" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editTaskModal"
                                            data-id="<?php echo $row['id']; ?>"
                                            data-title="<?php echo htmlspecialchars($row['title']); ?>"
                                            data-description="<?php echo htmlspecialchars($row['description']); ?>">
                                        Edit Task
                                    </button>
                                    <a href="delete.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
                                </td>   
                            </tr>
                        <?php }
                    }?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Structure -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskModalLabel">Add New Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="add.php" method="POST">
                        <div class="mb-3">
                            <label for="taskTitle" class="form-label">Task Title</label>
                            <input type="text" class="form-control" id="taskTitle" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="taskDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="taskDescription" name="description" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Task</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="edit.php" method="POST">
                        <!-- Hidden field to store task id -->
                        <input type="hidden" name="id" id="editTaskId" value="">
                        <div class="mb-3">
                            <label for="editTaskTitle" class="form-label">Task Title</label>
                            <input type="text" class="form-control" id="editTaskTitle" name="title" value="" required>
                        </div>
                        <div class="mb-3">
                            <label for="editTaskDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editTaskDescription" name="description" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Edit Task</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script>
        var editTaskModal = document.getElementById('editTaskModal');
        editTaskModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            var button = event.relatedTarget;
            // Extract info from data attributes
            var taskId = button.getAttribute('data-id');
            var taskTitle = button.getAttribute('data-title');
            var taskDescription = button.getAttribute('data-description');
            // Update the modal's input fields
            editTaskModal.querySelector('#editTaskId').value = taskId;
            editTaskModal.querySelector('#editTaskTitle').value = taskTitle;
            editTaskModal.querySelector('#editTaskDescription').value = taskDescription;
        });
    </script>
</body>
</html>