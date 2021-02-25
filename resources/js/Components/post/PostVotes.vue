<template>
    <div class="grid grid-cols-2 border-b-2 border-gray-300">
        <div class="grid grid-cols-2 justify-between py-4 px-8">
            <div class="flex mr-4 px-2 rounded-md">
                <span class="mr-2">{{ post.upvotes_count }}</span>
                <button @click="vote(post.id, 1)" class="px-2 rounded-md focus:outline-none border-2 border-green-200"
                    :class="{ 'bg-green-200' : upvoted.includes(post.id) }">Up</button>
            </div>
            <div class="flex px-2 rounded-md">
                <span class="mr-2">{{ post.downvotes_count }}</span>
                <button @click="vote(post.id, 0)" class="px-2 rounded-md focus:outline-none border-2 border-red-200"
                    :class="{ 'bg-red-200' : downvoted.includes(post.id) }">Down</button>
            </div>
        </div>
        <div class="flex justify-end">
            <div class="flex p-4">
                <span class="mr-2">{{ post.responses_count }}</span>
                <inertia-link :href="route('post-detail', post.id)">Responses</inertia-link>
            </div>
            <div class="p-4">
                <inertia-link :href="route('post-detail', post.id)" class="btn-header">Respond</inertia-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'post',
            'upvotes',
            'downvotes'
        ],

        data() {
            return {
                upvoted: this.upvotes,
                downvoted: this.downvotes,
            }
        },

        methods: {

            vote(post_id, vote) {

                // user upvoted in the past ??
                if(this.upvoted.includes(post_id)) {

                    console.log('already upvoted.')

                    if(vote == 1) {

                        let index = this.upvoted.indexOf(post_id);

                        if (index > -1) {
                            this.upvoted.splice(index, 1);
                            console.log('upvote removed client-side!');
                        }

                        axios.post(route('delete-post-vote'), { user: this.$page.props.user.username, post_id: post_id, vote: vote })
                        .then(
                            console.log('upvoted removed from the database.\n') )
                        .catch(error => {
                            console.log(error);
                        });

                    } else {

                        console.log('from up to down');

                        let index = this.upvoted.indexOf(post_id);

                        if (index > -1) {
                            this.upvoted.splice(index, 1);
                            this.downvoted.push(post_id);
                            console.log('upvote changed to downvote');
                        }

                        // here we have to change the vote to 1, because we are deleting vote from the past
                        axios.post(route('delete-post-vote'), { user: this.$page.props.user.username, post_id: post_id, vote: 1 })
                        .then(
                            console.log('upvote removed from the database') )
                        .catch(error => {
                            console.log(error);
                        });

                        axios.post(route('post-vote'), { user: this.$page.props.user.username, post_id: post_id, vote: vote })
                        .then(
                            console.log('downvoted server-side.\n') )
                        .catch(error => {
                            console.log(error);
                        });
                    }
                }

                // user downvoted in the past ??
                else if(this.downvoted.includes(post_id)) {

                    console.log('already downvoted.')

                    if(vote == 0) {

                        let index = this.downvoted.indexOf(post_id);

                        if (index > -1) {
                            this.downvoted.splice(index, 1);
                            console.log('downvote removed client-side!');
                        }

                        axios.post(route('delete-post-vote'), { user: this.$page.props.user.username, post_id: post_id, vote: vote })
                        .then(
                            console.log('downvote removed from the database.\n') )
                        .catch(error => {
                            console.log(error);
                        });

                    } else {

                        console.log('from down to up');

                        let index = this.downvoted.indexOf(post_id);

                        if (index > -1) {
                            this.downvoted.splice(index, 1);
                            this.upvoted.push(post_id);
                            console.log('downvote changed to upnvote');
                        }

                        // here we have to change the vote to 0, because we are deleting vote from the past
                        axios.post(route('delete-post-vote'), { user: this.$page.props.user.username, post_id: post_id, vote: 0 })
                        .then(
                            console.log('downvote removed from the database') )
                        .catch(error => {
                            console.log(error);
                        });

                        axios.post(route('post-vote'), { user: this.$page.props.user.username, post_id: post_id, vote: vote })
                        .then(
                            console.log('upvoted server-side.\n') )
                        .catch(error => {
                            console.log(error);
                        });
                    }
                }

                else {

                    axios.post(route('post-vote'), { user: this.$page.props.user.username, post_id: post_id, vote: vote })
                    .then(response => {
                        console.log(response.data);
                        if(vote == 1) {
                            this.upvoted.push(post_id);
                            console.log('upvoted.\n')
                        } else {
                            this.downvoted.push(post_id);
                            console.log('downvoted.\n')
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
                }
            },

        }
    }
</script>

<style scoped>

</style>
