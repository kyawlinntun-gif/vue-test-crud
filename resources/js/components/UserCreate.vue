<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h1>Create New User</h1>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="createdUser" @keydown="form.onKeydown($event)">
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
                            <button :disabled="form.busy" type="submit" class="btn btn-primary">Create</button>
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
                name: '',
                email: '',
                phone: '',
                address: ''
            })
        }
    },
    methods: {
        createdUser() {
            this.form.post('/user')
            .then( response => {

                //  [App.vue specific] When App.vue is first loaded start the progress bar
                this.$Progress.start();

                this.form.reset();

                Toast.fire({
                    icon: 'success',
                    title: 'User was created successfully!'
                })

                //  finish the progress bar
                this.$Progress.finish();

            })
            .catch( errors => console.log(errors.response));
        }
    }
}
</script>