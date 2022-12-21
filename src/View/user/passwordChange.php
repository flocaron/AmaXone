<section class="h-screen">
    <div class="px-6 h-full text-gray-800">
        <div class="flex justify-center items-center flex-wrap h-4/6 ">
            <div class="xl:ml-20 xl:w-5/12 lg:w-5/12 md:w-8/12 mb-12 md:mb-0">

                <form action="frontController.php" method="<?php echo $debug ? "get" : "post" ?>">

                    <!-- Password input -->
                    <div class="mb-6">
                        <input
                                required
                                type="password"
                                class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                placeholder="Password"
                                name="mdp"
                        />
                    </div>

                    <!-- Confirmation input -->
                    <div class="mb-6">
                        <input
                                required
                                type="password"
                                class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                placeholder="Confirmation"
                                name="mdp2"
                        />
                    </div>

                    <div class="text-center lg:text-left">
                        <button
                                type="submit"
                                class="inline-block px-7 py-3 bg-blue-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                        >
                            Submit
                        </button>
                    </div>

                    <input type="hidden" name="login" value="<?php echo htmlspecialchars($login) ?>" />
                    <input type="hidden" name="action" value="passwordChanged"/>
                    <input type="hidden" name="controller" value="user"/>

                </form>
            </div>
        </div>
    </div>
</section>