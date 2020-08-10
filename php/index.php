<?php
    session_start();

    use App\CategoriesTree;

    include 'classes/CategoriesTree.php';

    $categories = new CategoriesTree();

    if (!$_SESSION['registered'])
    {
        header("Location: /register.php");
    }
?>

<!doctype html>
<html lang="en">

<head>
    <?php include_once './src/partials/head.php'; ?>
    <title>Categories</title>
</head>

<body>
    <?php
        include_once './src/partials/navbar.php';
    ?>

    <div class="container">
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="zero">
                    <h5 class="mb-0"> Categories
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseZero" aria-expanded="true" aria-controls="collapseZero">
                            <img src="https://image.flaticon.com/icons/svg/32/32195.svg" alt="dropdown" width="15px">
                        </button>
                    </h5>
                </div>

                <div id="collapseZero" class="collapse" aria-labelledby="zero" data-parent="#accordion">
                    <div class="card-body">
                    <div class="crud-button" >
                            <p>Add category:</p>
                            <button class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php $categories->generateCategoriesHTMLTree($categories->getCategories()); ?>
    </div>

    <!-- Modal window -->
    <div id="modal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>

            <!-- Add Category -->
            <div class='modal-content__add'>
                <form id="addForm">
                    <h3 class="text-center mb-5">Add New Category</h3>
                    <input type="hidden" name="id" value="">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" id="title" required />
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="email" class="form-control" name="description" id="description" required></textarea>
                    </div>
                    <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg btn-block" disabled>
                        Add
                    </button>
                </form>
            </div>

            <!-- Update Category -->
            <div class='modal-content__update'>
                <div class='modal-content__add'>
                    <form id="updateForm">
                        <h3 class="text-center mb-5">Update Title or Description</h3>
                        <input type="hidden" name="id" value="">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" id="title" required />
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea type="email" class="form-control" name="description" id="description" required></textarea>

                        </div>
                        <button type="submit" name="submit" id="submit" class="btn btn-warning btn-lg btn-block" disabled>
                            Update
                        </button>
                    </form>
                </div>
            </div>

            <!-- Delete Category -->
            <div class='modal-content__delete'>
                <form id="deleteForm">
                    <h3 class="text-center mb-5">Delete Category and Subcategories of Current Category</h3>
                    <input type="hidden" name="id" value="">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <div class="form-group" style="text-align:center">
                        <label>Are you sure?</label>
                        <input type="checkbox" class="form-control" name="sure" id="sure" required />
                    </div>
                    <button type="submit" name="delete" id="submit" class="btn btn-danger btn-lg btn-block" disabled>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="src/js/modal.js"></script>
    <script src="src/js/ajax.js"></script>

</body>

</html>