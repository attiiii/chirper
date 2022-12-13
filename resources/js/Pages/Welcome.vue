<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Welcome" />

    <header>
        <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a href="." class="flex items-center">
                    <span class="self-center text-xl font-semibold whitespace-nowrap">Chirper</span>
                </a>
                <div class="flex items-center lg:order-2">
                    <Link class="mr-4" :href="route('login')">Log In</Link>
                    <Link class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150" :href="route('register')">Sign Up</Link>
                </div>
            </div>
        </nav>
    </header>

    <section class="bg-white">
        <div class="grid py-8 px-4 mx-auto max-w-screen-xl lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="place-self-center mr-auto lg:col-span-7">
                <h1 class="mb-4 max-w-2xl text-4xl font-extrabold leading-none md:text-5xl xl:text-6xl">Chirper is a easy to use, microblog app.</h1>
                <p class="mb-6 max-w-2xl font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                <Link class="mb-6 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150" :href="route('register')">Get Started</Link>
            </div>
            <div class="lg:mt-0 lg:col-span-5 lg:flex">
                <img src="https://images.unsplash.com/photo-1501504905252-473c47e087f8?crop=entropy&amp;cs=tinysrgb&amp;fit=max&amp;fm=jpg&amp;ixid=Mnw5MTMyMXwwfDF8c2VhcmNofDI0fHx3cml0ZXJ8ZW58MHx8fHwxNjcwNzQ1NzQw&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=1200" alt="mockup">
            </div>
        </div>
    </section>

    <footer class="p-4 bg-gray-100 sm:p-6">
        <div class="sm:flex sm:items-center sm:justify-between">
            <span class="text-sm text-gray-500 sm:text-center">© 2022 Chirper. All Rights Reserved.</span>
        </div>
    </footer>
</template>
