<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800">
                    Posts
                </h2>
                <button v-if="create == false" @click="create = true" class="btn-header">
                    New Post
                </button>
                <button v-if="create == true" @click="create = false" class="btn-header">
                    Back
                </button>
            </div>
        </template>
        <div v-if="create == true">
            <create-post @finished="create = false" :errors="$page.props.errors"></create-post>
        </div>
        <div v-if="create == false" class="flex flex-col-reverse">
            <div v-for="post in posts" :key="post.id" class="bg-white rounded-md shadow my-4 lg:w-2/5 mx-auto">
                <div class="flex justify-end text-xs pt-2 pr-2 text-gray-600">
                    {{post.user}}
                </div>
                <h1 class="text-2xl p-4 text-gray-800">{{post.title}}</h1>
                <div class="text-xl p-4">
                    {{post.description}}
                </div>
            </div>
        </div>


    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import CreatePost from '@/Components/CreatePost'

    export default {
        props: [
            'posts',
            'users'
        ],

        components: {
            AppLayout,
            CreatePost
        },

        data() {
            return {
                create: false,
            }
        },
        methods: {
            log() {
                console.log('finished');
            }
        }
    }
</script>
