<?php 
    use Core\Response;
    
    require basePath('views/partials/head.php'); 
    require basePath('views/partials/navbar.php'); 
?>
    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold"><?= Response::HTTP_FORBIDDEN->value ?></h1>
            <p class="mt-4"><?= $message ?? 'You are not authorized to view this note'?></p>
        </div>
    </main>
<?php require basePath('views/partials/footer.php'); ?>