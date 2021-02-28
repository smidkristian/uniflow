<template>
    <app-layout>
        <template #header>
            <div class="flex flex-col lg:flex-row-reverse justify-between">
                <div class="flex justify-end">
                    <inertia-link :href="route('posts')" class="btn">
                        Back
                    </inertia-link>
                </div>

                <div class="font-semibold text-gray-800 text-xl hidden lg:flex">
                    <h2>
                        {{ post.title }}
                    </h2>
                </div>
            </div>
        </template>

        <div class="bg-white w-full lg:w-2/5 mx-auto mt-10 rounded-md shadow p-2">
            <h1 class="text-xl lg:text-3xl text-gray-800 p-2 my-4">{{post.title}}</h1>
            <div class="p-2 lg:text-xl">
                {{post.description}}
            </div>
            <div class="flex justify-end mr-2 text-gray-600 text-lg">
                <span class="text-gray-500 mr-2"> from </span> {{post.user}}
            </div>
        </div>
        <div class="w-full lg:w-2/5 mx-auto mt-10">
        <div class="flex justify-between bg-gray-200 rounded-md shadow-inner border-b border-gray-300">
            <h1 class="text-2xl text-gray-600 p-4">Responses</h1>
            <div class="flex items-center mx-4">
                <button @click="responding = true" class="btn">New Response</button>
            </div>
        </div>

        <create-response v-if="responding == true" @finished="responding = false" :post="post" />

        <show-responses :responses="responses" />

    </div>
    </app-layout>
</template>

<script>

    import AppLayout from '@/Layouts/AppLayout'
    import CreateResponse from '@/Components/responses/CreateResponse'
    import ShowResponses from '@/Components/responses/ShowResponses'

    export default {
        props: [
            'post',
            'responses'
        ],
        components: {
            AppLayout,
            CreateResponse,
            ShowResponses
        },
        data() {
            return {
                responding: false,
                commenting: null
            }
        }


    }
</script>
<style scoped>

</style>
