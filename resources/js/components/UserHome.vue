<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <!-- <router-link to='/user/create' class="btn btn-primary mb-3">New User</router-link> -->
                <div class="card">
                    <div class="card-header">
                        <h1>User Lists</h1>
                    </div>
                    <div class="card-body" v-show="data.length > 0">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in data">
                                    <td v-text="user.id"></td>
                                    <td v-text="user.name"></td>
                                    <td v-text="user.email"></td>
                                    <td v-text="user.phone"></td>
                                    <td v-text="user.address"></td>
                                    <td>
                                        <router-link :to="'/user/show/' + user.id" class="btn btn-warning btn-sm">Edit</router-link>
                                        <button class="btn btn-danger btn-sm" @click.prevent="deleteData()" :data-id="user.id">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.getData();
    },
    data() {
        return {
            data: [],
            // Create a new form instance
            form: new Form({
                name: '',
                email: '',
                phone: '',
                address: ''
            }),

        }
    },
    methods: {
        getData() {
            this.form.get('/user')
            .then( response => {
                //  [App.vue specific] When App.vue is first loaded start the progress bar
                this.$Progress.start();

                this.data = response.data.users

                //  finish the progress bar
                this.$Progress.finish();

            })
            .catch( errors => console.log(errors.response));
        },
        deleteData() {
            let id = event.target.getAttribute('data-id');

            //  [App.vue specific] When App.vue is first loaded start the progress bar
            this.$Progress.start();

            this.form.delete('/user/' + id)
            .then(response => {

                // console.log(response.data);

                // this.$eventBus.$emit('GetData');
                this.getData();

                Toast.fire({
                    icon: 'success',
                    title: 'User was created successfully!'
                });

                //  finish the progress bar
                this.$Progress.finish();
            })
            .catch(errors => {
                console.log(errors.response);
                Toast.fire({
                    icon: 'error',
                    title: 'User was not deleted successfully!'
                });
            });
        },
        // created() {
        //     this.$eventBus.$on('GetData', this.getData);
        // }
    },
}
</script>