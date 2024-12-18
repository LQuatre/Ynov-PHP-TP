<?php
    $member->handleRegister($page, $member);
    $error = $_GET['error'] ?? '';
?>

<div class="min-h-screen flex items-center justify-center bg-base-200 pt-12">
    <div class="hidden lg:block w-full max-w-md p-6 bg-primary/10 rounded-md ring-2 ring-gray-800/50">
        <h1 class="text-3xl font-semibold text-center mb-5">SignUp</h1>
        <?php if (!empty($error)): ?>
            <div role="alert" class="alert alert-error mb-4">
                <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 shrink-0 stroke-current"
                        fill="none"
                        viewBox="0 0 24 24">
                    <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span><?php echo htmlspecialchars($error); ?></span>
            </div>
        <?php endif; ?>
        <form class="space-y-4" id="signup-form" method="POST" action="">
            <label class="input input-bordered flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-4 w-4 opacity-70">
                    <path d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                    <path d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                </svg>
                <input type="email" name="email" class="grow" placeholder="Email" required />
            </label>
            <label class="input input-bordered flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-4 w-4 opacity-70">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z" />
                </svg>
                <input type="text" name="username" class="grow" placeholder="Username" required />
            </label>
            <label class="input input-bordered flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-4 w-4 opacity-70">
                    <path fill-rule="evenodd" d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z" clip-rule="evenodd" />
                </svg>
                <input type="password" name="password" class="grow" placeholder="Password" required />
            </label>
            <label class="input input-bordered flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-4 w-4 opacity-70">
                    <path fill-rule="evenodd" d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z" clip-rule="evenodd" />
                </svg>
                <input type="password" name="confirm_password" class="grow" placeholder="Confirm Password" required />
            </label>
            <button type="submit" class="btn btn-block">Sign Up</button>
            <span>Already have an account?
                <a href="/login" class="text-blue-600 hover:text-blue-800 hover:underline">Login</a>
            </span>
        </form>
        <div class="flex items-center w-full my-4">
            <hr class="w-full" />
            <p class="px-3 ">OR</p>
            <hr class="w-full" />
        </div>
        <div class="my-6 space-y-2">
            <button aria-label="Register with Google" type="button"
                    class="flex items-center justify-center w-full p-2 space-x-4 border rounded-md focus:ring-2 focus:ring-offset-1 focus:ring-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-5 h-5 fill-current">
                    <path
                            d="M16.318 13.714v5.484h9.078c-0.37 2.354-2.745 6.901-9.078 6.901-5.458 0-9.917-4.521-9.917-10.099s4.458-10.099 9.917-10.099c3.109 0 5.193 1.318 6.38 2.464l4.339-4.182c-2.786-2.599-6.396-4.182-10.719-4.182-8.844 0-16 7.151-16 16s7.156 16 16 16c9.234 0 15.365-6.49 15.365-15.635 0-1.052-0.115-1.854-0.255-2.651z">
                    </path>
                </svg>
                <p>Register with Google</p>
            </button>
            <button aria-label="Register with GitHub" role="button"
                    class="flex items-center justify-center w-full p-2 space-x-4 border rounded-md focus:ring-2 focus:ring-offset-1 focus:ring-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-5 h-5 fill-current">
                    <path
                            d="M16 0.396c-8.839 0-16 7.167-16 16 0 7.073 4.584 13.068 10.937 15.183 0.803 0.151 1.093-0.344 1.093-0.772 0-0.379-0.014-1.383-0.021-2.716-4.458 0.968-5.395-2.149-5.395-2.149-0.727-1.838-1.77-2.325-1.77-2.325-1.446-0.986 0.109-0.967 0.109-0.967 1.598 0.111 2.438 1.639 2.438 1.639 1.421 2.433 3.726 1.726 4.634 1.316 0.143-1.031 0.558-1.726 1.015-2.12-3.554-0.404-7.285-1.775-7.285-7.39 0-1.632 0.586-2.971 1.547-4.023-0.156-0.404-0.672-2.021 0.148-4.217 0 0 1.263-0.404 4.139 1.54 1.204-0.335 2.496-0.5 3.786-0.5 1.288 0 2.582 0.165 3.786 0.5 2.875-1.944 4.139-1.54 4.139-1.54 0.82 2.196 0.305 3.813 0.149 4.217 0.963 1.052 1.548 2.391 1.548 4.023 0 5.636-3.736 6.986-7.292 7.39 0.576 0.497 1.084 1.48 1.084 3.032 0 2.188-0.019 3.949-0.019 4.487 0 0.43 0.287 0.935 1.097 0.775 6.353-2.115 10.934-8.111 10.934-15.184 0-8.837-7.161-16-16-16z">
                    </path>
                </svg>
                <p>Register with GitHub</p>
            </button>
        </div>
    </div>

    <div class="block lg:hidden w-11/12 max-w-md p-6 bg-primary/10 rounded-md ring-2 ring-gray-800/50">
        <h1 class="text-3xl font-semibold text-center mb-5">SignUp</h1>
        <?php if (isset($error)): ?>
            <div role="alert" class="alert alert-error mb-4">
                <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 shrink-0 stroke-current"
                        fill="none"
                        viewBox="0 0 24 24">
                    <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span><?php echo htmlspecialchars($error); ?></span>
            </div>
        <?php endif; ?>
        <form class="space-y-4" id="signup-form" method="POST" action="">
            <label class="input input-bordered flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-4 w-4 opacity-70">
                    <path d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                    <path d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                </svg>
                <input type="email" name="email" class="grow w-11/12" placeholder="Email" required />
            </label>
            <label class="input input-bordered flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-4 w-4 opacity-70">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z" />
                </svg>
                <input type="text" name="username" class="grow w-11/12" placeholder="Username" required />
            </label>
            <label class="input input-bordered flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-4 w-4 opacity-70">
                    <path fill-rule="evenodd" d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z" clip-rule="evenodd" />
                </svg>
                <input type="password" name="password" class="grow w-11/12" placeholder="Password" required />
            </label>
            <label class="input input-bordered flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-4 w-4 opacity-70">
                    <path fill-rule="evenodd" d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z" clip-rule="evenodd" />
                </svg>
                <input type="password" name="confirm_password" class="grow w-11/12" placeholder="Confirm Password" required />
            </label>
            <button type="submit" class="btn btn-block">Sign Up</button>
            <span>Already have an account?
                <a href="/login" class="text-blue-600 hover:text-blue-800 hover:underline">Login</a>
            </span>
        </form>
        <div class="flex items-center w-full my-4">
            <hr class="w-full" />
            <p class="px-3 ">OR</p>
            <hr class="w-full" />
        </div>
        <div class="my-2">
            <button class="btn btn-primary w-full" id="github-login">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 16 16" fill="currentColor">
                    <path d="M8 0a8 8 0 0 0-2.563 15.57c.406.075.553-.176.553-.392 0-.195-.007-.712-.011-1.397-2.001.436-2.426-.57-2.426-.57-.329-.83-.803-1.051-.803-1.051-.656-.447.049-.438.049-.438.726.051 1.107.746 1.107.746.646 1.105 1.694.785 2.104.6.065-.467.253-.785.46-.966-1.634-.186-3.344-.817-3.344-3.635 0-.804.287-1.464.755-1.983-.075-.186-.327-.932.072-1.942 0 0 .622-.199 2.042.76a7.157 7.157 0 0 1 1.86-.248c.632 0 1.262.085 1.86.248 1.42-.96 2.042-.76 2.042-.76.399 1.01.147 1.756.073 1.942.469.519.755 1.179.755 1.983 0 2.82-1.711 3.45-3.344 3.635.261.225.494.668.494 1.342 0 .968-.009 1.748-.011 1.982 0 .217.146.473.557.392A8 8 0 0 0 8 0z">
                    </path>
                </svg>
                <p>Register with GitHub</p>
            </button>
        </div>
    </div>
</div>
