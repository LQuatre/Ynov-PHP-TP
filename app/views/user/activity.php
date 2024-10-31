<div class="min-h-screen bg-base-200 flex flex-col items-center">
    <div class="w-full max-w-md mt-4 px-4">
        <div class="card w-full pt-12">
            <div class="card-body">
                <h1 class="text-xl font-bold text-center">Activity Log</h1>
                <div class="grid grid-cols-1 gap-4">
                    <?php foreach ($member->getActivities() as $activity) : ?>
                        <p class="text-sm"><?= $activity ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>