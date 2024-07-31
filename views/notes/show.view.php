<?php 
    require basePath('views/partials/head.php'); 
    require basePath('views/partials/navbar.php'); 
    require basePath('views/partials/banner.php');
?>
    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <div>
                <a href="/notes" class="text-blue-500 hover:underline">go back...</a>
            </div>
            <p>
                <?= $note['body'] ?>
            </p>

            <div class="mt-6">
                <a href="/note/edit?id=<?= $note['id'] ?>" class="text-blue-500 hover:underline mt-6">Edit</a>
            </div>
        </div>
    </main>
<?php require basePath('views/partials/footer.php'); ?>