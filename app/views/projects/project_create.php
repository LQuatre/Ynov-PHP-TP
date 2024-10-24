<?php

if (!$member->isLogged()) {
    echo "<script>window.location = '/login'</script>";
    exit;
}

$member->handleNewProject($page, $member);

?>

<div class="min-h-screen bg-base-200 flex flex-col items-center">
    <div class="w-full max-w-md mt-4 px-4">
        <div class="card w-full pt-12">
            <div class="card-body">
                <h1 class="text-xl font-bold text-center">Créez Votre Projet</h1>
                <form action="" method="post" class="grid grid-cols-2 gap-4">
                    <div class="form-control col-span-2 sm:col-span-1">
                        <label class="label py-1" for="lastname">
                            <span class="label-text">Name</span>
                        </label>
                        <input type="text" id="lastname" name="lastname" class="input input-bordered w-full max-w-xs" value="<?php echo htmlspecialchars($member->get('lastname')); ?>" disabled />
                    </div>
                    <div class="form-control col-span-2 sm:col-span-1">
                        <label class="label py-1" for="firstname">
                            <span class="label-text">Firstname</span>
                        </label>
                        <input type="text" id="firstname" name="firstname" class="input input-bordered w-full max-w-xs" value="<?php echo htmlspecialchars($member->get('firstname')); ?>" disabled />
                    </div>

                    <div class="form-control col-span-2 text-center">
                        <h1>If you want to change your last name or first name, you can do so in your <a href="/profile" class="text-blue-600 hover:text-blue-800 hover:underline">profile</a></h1>
                    </div>

                    <div class="form-control col-span-2">
                        <label class="label py-1" for="title">
                            <span class="label-text">Title</span>
                        </label>
                        <input type="text" id="title" name="title" class="input input-bordered input-sm" required>
                    </div>

                    <div class="form-control col-span-2">
                        <label class="label py-1" for="description">
                            <span class="label-text">Description</span>
                        </label>
                        <textarea id="description" name="description" class="textarea textarea-bordered textarea-sm" rows="2" required></textarea>
                    </div>

                    <div class="form-control col-span-2">
                        <label class="label py-1" for="link">
                            <span class="label-text">Link</span>
                        </label>
                        <input type="text" id="link" name="link" class="input input-bordered input-sm" required>
                    </div>

                    <div class="form-control col-span-2">
                        <label class="label py-1" for="image">
                            <span class="label-text">Image</span>
                        </label>
                        <input type="file" id="image" name="image" class="file-input file-input-bordered w-full max-w-xs" required>
                    </div>

                    <div class="form-control col-span-2">
                        <button type="submit" class="btn btn-primary w-full">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
