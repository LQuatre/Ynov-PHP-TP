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
                <h1 class="text-xl font-bold text-center">Ur CVs</h1>
                <div class="grid grid-cols-1 gap-4">
                    <?php foreach ($member->cvs as $cv) : ?>
                        <div class="card bg-base-100 shadow-md ">
                            <div class="card-body">
                                <h2 class="text-lg font-bold"><?php echo $member->get('firstname') . ' cv.php' . $member->get('lastname'); ?></h2>
                                <p class="text-sm"><?php echo $cv['email']; ?></p>
                                <p class="text-sm"><?php echo $cv['phone']; ?></p>
                                <p class="text-sm"><?php echo $cv['address']; ?></p>
                                <p class="text-sm"><?php echo $cv['education']; ?></p>
                                <div class="flex justify-end space-x-4">
                                    <form method="POST" action="/cv/download">
                                        <input type="hidden" name="cv_id" value="<?php echo $cv['id']; ?>">
                                        <button type="submit" class="btn btn-outline">Download PDF</button>
                                    </form>
                                    <form method="POST" action="/cv/delete">
                                        <input type="hidden" name="cv_id" value="<?php echo $cv['id']; ?>">
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
