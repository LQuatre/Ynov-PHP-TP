<div class="hero bg-base-200 min-h-screen pt-12">
    <div class="hero-content text-center">
        <div class="max-w-3xl">
            <h1 class="text-5xl font-bold">AH AH !</h1>
            <p class="py-6">
                You've been Rick Rolled!
            </p>
            <!-- <p class="py-6">
                <?php echo $member->isLogged() ? 'You are logged in!' : 'You are not logged in!'; ?>
                <?php echo $member->isAdmin() ? 'You are an admin!' : 'You are not an admin!'; ?>
            </p> -->
            <iframe
                width="800"
                height="450"
                src="https://www.youtube.com/embed/dQw4w9WgXcQ?start=43&autoplay=1"
                frameborder="0"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>
    </div>

    <script>
        // make sure the video is autoplayed
        document.querySelector('iframe').src += '&autoplay=1';
    </script>
</div>
