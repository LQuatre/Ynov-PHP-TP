<?php
if (!$member->isLogged()) {
    echo "<script>'=window.location.href = '/login';</script>";
    exit;
}
?>

<div class="min-h-screen bg-base-200 flex flex-col items-center">
    <div class="w-full max-w-md mt-4 px-4">
        <div class="card w-full pt-12">
            <div class="card-body">
                <h1 class="text-xl font-bold text-center">Ur Projects</h1>
                <div class="grid grid-cols-1 gap-4">
                    <?php foreach ($member->projects as $project) : ?>
                        <div class="card bg-base-100 shadow-md ">
                            <div class="card-body">
                                <h2 class="text-lg font-bold"><?php echo $member->get('firstname') . ' ' . $member->get('lastname'); ?></h2>
                                <p class="text-sm"><?php echo $project['title']; ?></p>
                                <p class="text-sm"><?php echo $project['description']; ?></p>
                                <p class="text-sm"><?php echo $project['link']; ?></p>
                                <p class="text-sm"><?php echo $project['image']; ?></p>
                                <div class="flex justify-end space-x-4">
                                    <form method="POST" action="/project/delete">
                                        <input type="hidden" name="project_id" value="<?php echo $project['id']; ?>">
                                        <button type="submit" class="btn btn-ghost">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

