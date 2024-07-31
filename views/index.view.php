<?php 
    require basePath('views/partials/head.php'); 
    require basePath('views/partials/navbar.php'); 
    require basePath('views/partials/banner.php');
?>

    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <p>Hello, <?= $_SESSION['user']['email'] ?? 'Guest' ?></p>
        </div>
    </main>
<?php require basePath('views/partials/footer.php'); ?>