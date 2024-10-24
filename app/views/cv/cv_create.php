<?php

if (!$member->isLogged()) {
    echo "<script>window.location = '/login'</script>";
    exit;
}

$member->handleNewCv($page, $member);

?>

<div class="min-h-screen bg-base-200 flex flex-col items-center">
    <div class="w-full max-w-md mt-4 px-4">
        <div class="card w-full pt-12">
            <div class="card-body">
                <h1 class="text-xl font-bold text-center">Créez Votre CV</h1>
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

                    <div class="form-control col-span-2 sm:col-span-1">
                        <label class="label py-1" for="email">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" id="email" name="email" class="input input-bordered input-sm" required>
                    </div>

                    <div class="form-control col-span-2 sm:col-span-1">
                        <label class="label py-1" for="phone">
                            <span class="label-text">Phone</span>
                        </label>
                        <input type="tel" id="phone" name="phone" class="input input-bordered input-sm" required>
                    </div>

                    <div class="form-control col-span-2">
                        <label class="label py-1" for="address">
                            <span class="label-text">Adress</span>
                        </label>
                        <input type="text" id="address" name="address" class="input input-bordered input-sm" required>
                    </div>

                    <div class="form-control col-span-2">
                        <label class="label py-1" for="education">
                            <span class="label-text">Education</span>
                        </label>
                        <textarea id="education" name="education" class="textarea textarea-bordered textarea-sm" rows="2" required></textarea>
                    </div>

                    <div class="form-control col-span-2">
                        <label class="label py-1" for="experience">
                            <span class="label-text">Experience</span>
                        </label>
                        <textarea id="experience" name="experience" class="textarea textarea-bordered textarea-sm" rows="2" required></textarea>
                    </div>

                    <div class="form-control col-span-2">
                        <label class="label py-1" for="skills">
                            <span class="label-text">Skills</span>
                        </label>
                        <textarea id="skills" name="skills" class="textarea textarea-bordered textarea-sm" rows="2" required></textarea>
                    </div>

                    <div class="form-control col-span-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-sm w-full">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
