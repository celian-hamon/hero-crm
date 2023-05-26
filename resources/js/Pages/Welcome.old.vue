<script>

import {defineComponent} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

export default defineComponent({
    components: {SecondaryButton, PrimaryButton}
})
</script>

<template>
    <div class="leading-normal tracking-normal text-indigo-400 bg-cover bg-fixed p-0 m-0 h-screen" style="background-image: url('assets/img.png');" cz-shortcut-listen="true">

    <div>
        <!--Nav-->
        <div class="w-full container mx-auto py-5">
            <div class="w-full flex items-center justify-between ">
                <a class="flex items-center text-indigo-400 no-underline hover:no-underline font-bold text-2xl lg:text-4xl" href="#">
                    Rain<span class="bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-pink-500 to-purple-500">blur</span>
                </a>

                <div class="flex w-1/2 justify-end content-center">
                    <Link :href=""><PrimaryButton class="mx-3">Register</PrimaryButton></Link>
                    <SecondaryButton>Login</SecondaryButton>
                </div>
            </div>
        </div>

        <!--Main-->
        <div class="container pt-24 md:pt-36 mx-auto flex flex-wrap flex-col md:flex-row items-center">
            <!--Left Col-->
            <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden">
                <h1 class="my-4 text-3xl md:text-5xl text-white opacity-75 font-bold leading-tight text-center md:text-left">
                    Main
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-pink-500 to-purple-500">
            Hero Message
          </span>
                    to sell yourself!
                </h1>
                <p class="leading-normal text-base md:text-2xl mb-8 text-center md:text-left">
                    Sub-hero message, not too long and not too short. Make it just right!
                </p>

                <form class="bg-gray-900 opacity-75 w-full shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
                    <div class="mb-4">
                        <label class="block text-blue-300 py-2 font-bold mb-2" for="emailaddress">
                            Signup for our newsletter
                        </label>
                        <input class="shadow appearance-none border rounded w-full p-3 text-gray-700 leading-tight focus:ring transform transition hover:scale-105 duration-300 ease-in-out" id="emailaddress" type="text" placeholder="you@somewhere.com">
                    </div>

                    <div class="flex items-center justify-between pt-4">
                        <button class="bg-gradient-to-r from-purple-800 to-green-500 hover:from-pink-500 hover:to-green-500 text-white font-bold py-2 px-4 rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out" type="button">
                            Sign Up
                        </button>
                    </div>
                </form>
            </div>

            <!--Footer-->
            <div class="w-full pt-16 pb-6 text-sm text-center md:text-left fade-in">
                <a class="text-gray-500 no-underline hover:no-underline" href="#">© App 2020</a>
                - Template by
                <a class="text-gray-500 no-underline hover:no-underline" href="https://www.tailwindtoolbox.com">TailwindToolbox.com</a>
            </div>
        </div>
    </div>
    </div>
</template>

<style>
html{
    scroll-behavior: smooth;
}
</style>
