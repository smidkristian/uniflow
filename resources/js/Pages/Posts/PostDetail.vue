<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between">
                <div class="font-semibold text-xl text-gray-800">
                    <h2>
                        {{ post.title }}
                    </h2>
                </div>
                <div>
                    <button v-if="create == false" @click="create = true" class="btn-header">
                        New Post
                    </button>
                    <button v-if="create == true" @click="create = false" class="btn-header">
                        Back
                    </button>
                </div>
            </div>
        </template>

        <div class="bg-white w-full lg:w-2/5 mx-auto mt-10 rounded-md shadow">
            <h1 class="text-3xl text-gray-800 p-4 my-4">{{post.title}}</h1>
            <div class="text-xl p-4">
                {{post.description}}
            </div>
        </div>
        <div class="w-full lg:w-2/5 mx-auto mt-10">
            <div class="flex justify-between bg-gray-200 rounded-md shadow-inner border-b border-gray-300">
                <h1 class="text-2xl text-gray-600 p-4">Responses</h1>
                <div class="flex items-center mx-4">
                    <button @click="create = true" class="btn-header">New Response</button>
                </div>
            </div>
            <create-response v-if="create == true" @finished="create = false" :post="post" />

            <div v-for="response in responses" :key="response.id" class="flex border-b-2 border-gray-200 py-6 px-4">
                <h1 class="text-blue-600">
                    {{ response.user }}
                </h1>
                <div class="ml-2">
                    {{ response.response }}
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>

    import AppLayout from '@/Layouts/AppLayout'
    import CreateResponse from '@/Components/post/CreateResponse'

    export default {
        props: [
            'post',
            'responses'
        ],
        components: {
            AppLayout,
            CreateResponse
        },
        data() {
            return {
                create: false,
            }
        },


    }
</script>
<style scoped>

</style>
