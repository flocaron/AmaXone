<!--
<article id="form">
    <form action="frontController.php" method="get">
        <fieldset>
            <legend>  Se connecter : </legend>
            <p>
                <label for="login_id"> Login </label> :
                <input type="text" name="login" id="login_id" required/>
            </p>
            <p>
                <label for="mdp_id"> Mot de passe </label> :
                <input type="password" name="mdp" id="mdp_id" required/>
            </p>
            <p>
                <input type="submit" value="se connecter"/>
            </p>
        </fieldset>
    </form>
</article>
-->
<section class="h-screen">
    <div class="px-6 h-full text-gray-800">
        <div class="flex justify-center items-center flex-wrap h-4/6 ">
            <div class="xl:ml-20 xl:w-5/12 lg:w-5/12 md:w-8/12 mb-12 md:mb-0">
                <form action="frontController.php" method="get">
                    <!-- Login input -->
                    <div class="mb-6">
                        <input
                                required
                                type="text"
                                class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                placeholder="Login"
                                name="login"

                        />
                    </div>

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

                    <div class="flex justify-between items-center mb-6">
                        <div class="form-group form-check">
                            <input
                                    type="checkbox"
                                    class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    id="exampleCheck2"
                            />
                            <label class="form-check-label inline-block text-gray-800" for="exampleCheck2"
                            >Remember me</label
                            >
                        </div>
                        <a href="#" class="text-gray-800">Forgot password?</a>
                    </div>

                    <div class="text-center lg:text-left">
                        <button
                                type="submit"
                                class="inline-block px-7 py-3 bg-blue-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                        >
                            Login
                        </button>
                        <p class="text-sm font-semibold mt-2 pt-1 mb-0">
                            Don't have an account?
                            <a
                                    href="#"
                                    class="text-red-600 hover:text-red-700 focus:text-red-700 transition duration-200 ease-in-out"
                            >Register</a
                            >
                        </p>
                    </div>

                    <input type="hidden" name="action" value="logined"/>
                    <input type="hidden" name="controller" value="user"/>

                </form>
            </div>
        </div>
    </div>
</section>