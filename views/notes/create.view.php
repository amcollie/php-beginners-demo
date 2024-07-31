<?php 
    require basePath('views/partials/head.php'); 
    require basePath('views/partials/navbar.php'); 
    require basePath('views/partials/banner.php');
?>
    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <form action="/notes" method="post">
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">

                        <div class="col-span-full">
                            <label for="note-body" class="block text-sm font-medium leading-6 text-gray-900">Note</label>
                            <div class="mt-2">
                                <textarea 
                                    id="note-body" 
                                    name="note-body" 
                                    rows="3" 
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                ><?= $_POST['note-body'] ?? '' ?></textarea>
                            </div>
                            <?php if (isset($errors['note-body'])): ?>
                                <p class="mt-2 text-sm text-red-600">
                                    <?= $errors['note-body'] ?>
                                </p>
                            <?php endif; ?>
                            <!-- <p class="mt-3 text-sm leading-6 text-gray-600">Write a few sentences about yourself.</p> -->
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button 
                        type="button" 
                        class="text-sm text-gray-900 hover:underline"
                        onclick="window.location.href='/notes'"
                    >
                        Cancel
                    </button>
                    <button type="submit" class="text-sm text-blue-500 hover:underline">Save</button>
                </div>
            </form>
        </div>
    </main>
<?php require basePath('views/partials/footer.php'); ?>