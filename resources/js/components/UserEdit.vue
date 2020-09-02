<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h1>Edit User</h1>
                    </div>
                    <div class="card-body" v-show="error">
                        <form @submit.prevent="updatedUser" @keydown="form.onKeydown($event)">
                            <input type="hidden" name="id" v-model="form.id">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" v-model="form.name" :class="{ 'is-invalid' : form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" v-model="form.email" :class="{ 'is-invalid' : form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" id="phone" name="phone" class="form-control" v-model="form.phone" :class="{ 'is-invalid' : form.errors.has('phone') }">
                                <has-error :form="form" field="phone"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control" v-model="form.address" :class="{ 'is-invalid' : form.errors.has('address') }">
                                <has-error :form="form" field="address"></has-error>
                            </div>
                            <button :disabled="form.busy" type="submit" class="btn btn-primary">Edit</button>
                        </form>
                    </div>
                </div>
            </div>    
        </div>    
    </div>
</template>

<script>
export default {
    data() {
        return {
            // Create a new form instance
            form: new Form({
                id: '',
                name: '',
                email: '',
                phone: '',
                address: ''
            }),
            error: true
        }
    },
    methods: {
        showData() {
            
            //  [App.vue specific] When App.vue is first loaded start the progress bar
            this.$Progress.start();

            this.form.get('/user/'+this.form.id)
            .then( response => {
                // console.log(response.data.user);
                this.form.id = response.data.user.id;
                this.form.name = response.data.user.name;
                this.form.email = response.data.user.email;
                this.form.phone = response.data.user.phone;
                this.form.address = response.data.user.address;

                //  finish the progress bar
                this.$Progress.finish();

            })
            .catch( errors => {
                this.error = false;
            })
        },

        updatedUser() {
            //  [App.vue specific] When App.vue is first loaded start the progress bar
            this.$Progress.start();

            this.form.put('/user')
            .then( response => {
                console.log(response.data.user);
                this.form.id = response.data.user.id;
                this.form.name = response.data.user.name;
                this.form.email = response.data.user.email;
                this.form.phone = response.data.user.phone;
                this.form.address = response.data.user.address;

                Toast.fire({
                    icon: 'success',
                    title: 'User was created successfully!'
                });

                //  finish the progress bar
                this.$Progress.finish();

            })
            .catch( errors => console.log(errors));
        }
        
    },
    mounted() {
        this.form.id = this.$route.params.id;
        this.showData();
    }
}
</script>