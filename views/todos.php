<?php
    $title = $username;

    ob_start();
?>

    <!-- TODO: This Should Be More Dynamic -->
    <div id="alert" class="alert alert-success d-none"></div>

    <form action="index.php?action=ajouter" method="post" class="pb-4">
        <label for="todo" class="form-label">New Todo</label>
        <div class="input-group">
            <input type="text" class="form-control" name="todo">
            <input type="submit" value="Create Todo" class="btn btn-primary">
        </div>
    </form>

    <table class="table table-bordered table-hover table-striped">
        <thead>
            <th>TODO</th>
            <th class="w-25">Action</th>
        </thead>

        <tbody>

          <?php foreach($user_todos as $todo): ?>
            
            <tr>
                <td><?= $todo["todo"] ?></td>
                <td>
                    <button data-action = "delete" data-todo-id="<?= $todo['id'] ?>" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                    <button data-action = "update" data-todo-id="<?= $todo['id'] ?>" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Update</button>
                </td>
            </tr>

          <?php endforeach; ?>

      </tbody>
        
    </table>

    <!-- Modal For Updating Todos -->

    <!-- Modal -->
    <?php include "views/includes/update_modal.html" ?>
    <?php include "views/includes/delete_modal.html" ?>

    <script src="scripts/update_todo.js" type="module" defer></script>
    <script src="scripts/delete_todo.js" type="module" defer></script>
    <!-- <script src="scripts/plugins.js"></script> -->

<?php
    $content = ob_get_contents();
    ob_get_clean();

    require "views/master.php";
?>