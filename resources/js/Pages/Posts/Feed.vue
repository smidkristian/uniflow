<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800">
                    Posts
                </h2>
                <inertia-link :href="route('create-post')" class="btn-header">
                    New Post
                </inertia-link>
            </div>
        </template>

        <!-- FEED -->

        <div class="flex flex-col">
            <div v-for="post in posts" :key="post.id" class="bg-white rounded-md shadow my-4 lg:w-2/5 mx-auto">
                <div class="flex justify-end text-xs pt-2 pr-2 text-gray-600">
                    <div class="mr-2">
                        user:
                    </div>
                    <div>
                        {{post.user}}
                    </div>
                </div>
                <h1 class="text-2xl p-4 text-gray-800">{{post.title}}</h1>
                <div class="text-xl p-4">
                    {{post.description}}
                </div>
                <post-votes :post="post" :upvotes="upvoted" :downvotes="downvoted" />
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import PostVotes from '../../Components/post/PostVotes.vue'

    export default {
        props: [
            'posts',
            'user_post_votes'
        ],

        components: {
            AppLayout,
            PostVotes
        },

        data() {
            return {
                upvoted: [],
                downvoted: [],
            }
        },

        created() {
            this.userVotes(this.user_post_votes, this.posts)
        },

        methods: {

            // checking if user already voted and how, fetching data
            userVotes(post_votes, posts) {

                let i;
                let j;

                for(i = 0; i < posts.length; i++) {
                    for(j = 0; j < post_votes.length; j++) {

                        if(posts[i].id == post_votes[j].post_id) {
                            if(post_votes[j].vote == 1) {
                                this.upvoted.push(posts[i].id);
                            } else {
                                this.downvoted.push(posts[i].id);
                            }
                        }
                    }
                }

                console.log('votes fetched');

            }




        }
    }
</script>
