<template>
    <div class="mx-auto w-full bg-white p-4 m-4 rounded-md shadow-sm xyz-in"
        xyz="fade-100% up">
        <h1 class="uppercase pb-6 text-sm text-gray-500">New Response</h1>

        <form @submit.prevent="storeResponse()" class="flex flex-col">
            <h1>User: {{ responseForm.user }}</h1>
            <div class="flex flex-col mt-4">
                <label for="response">Response:</label>
                <textarea rows="2" cols="30" id="response" v-model="responseForm.response" class="input" />
                <!-- <span class="text-xs text-red-700 uppercase mt-2">{{ errors.response }}</span> -->
            </div>
            <div class="flex justify-end">
                <button type="submit" class="btn">Save</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: [
            'post'
        ],
        emits: [
          'finished'
        ],
        data() {
            return {
                responseForm: {
                    post_id: this.post.id,
                    user: this.$page.props.user.username,
                    response: null
                }
            }
        },

        methods: {

            storeResponse() {

                this.$inertia.post(route('store-response'), this.responseForm, {
                    onSuccess: () => {
                        console.log('response made!!');
                        this.$emit('finished');
                        this.resetForm();
                    },
                    onError: () => {
                        console.log(this.errors);
                    }
                });
            },

            resetForm() {
                Object.keys(this.responseForm).forEach( key => {
                    this.responseForm[key] = null
                });
            },
        }
    }
</script>

<style scoped>

</style>
