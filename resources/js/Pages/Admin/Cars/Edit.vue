<script setup>
    import { Head, Link, router } from '@inertiajs/vue3';
    import LayoutAdmin from '../../../Layouts/Admin.vue'; 
    import { reactive } from 'vue';
    import Swal from 'sweetalert2';

    defineOptions({
        layout: LayoutAdmin
    })

    const props = defineProps({
        categories: Object,
        errors: Object,
        cars: Object,
    })

    const form = reactive({
        'category_id': props.cars.category_id || '',
        'brand': props.cars.brand || '',
        'model': props.cars.model || '',
        'license_plate': props.cars.license_plate || '',
        'year': props.cars.year || '',
        'fuel_type': props.cars.fuel_type || '',
        'transmission': props.cars.transmission || '',
        'daily_rate': props.cars.daily_rate || '',
        'passenger_capacity': props.cars.passenger_capacity || '',
        'penalty_rate_per_day': props.cars.penalty_rate_per_day || '',
        'description': props.cars.description || '',
        image: null,
    })

    function handleFileUpload(event)
    {
        formData.image = event.target.files[0]
    }

    function submit()
    {
        const formData = new FormData();

        formData.append('brand', form.brand || '');
        formData.append('model', form.model || '');
        formData.append('license_plate', form.license_plate || '');
        formData.append('transmission', form.transmission || '');
        formData.append('year', form.year || '');
        formData.append('daily_rate', form.daily_rate || '');
        formData.append('penalty_rate_per_day', form.penalty_rate_per_day || '');
        formData.append('passenger_capacity', form.passenger_capacity || '');
        formData.append('fuel_type', form.fuel_type || '');
        formData.append('description', form.description || '');
        formData.append('category_id', form.category_id || '');

        if(form.image){
            formData.append('image', form.image);
        };

        formData.append('_method', 'PUT');

        router.post(`/admin/cars/${props.cars.id}`, formData, {
            forceFormData: true,
            onSuccess: () => {
                Swal.fire({
                    title: 'Success!',
                    text: 'Car has been updated!',
                    icon: 'success',
                    timer: '2000',
                    showCancelButton: false,
                });
            },
        });


        // melihat isi reactive
        // console.log(toRaw(formData))

        // meliha isi payloa(FormData())
        // console.log("ISI PAYLOAD:", Object.fromEntries(payload));
    }
</script>

<template>
    <Head>
        <title>Edit Car - Bee Rental Mobil</title>
    </Head>

    <div class="container-fluid mb-5 mt-3">
        <div class="row">
            <div class="col-md-12">
                <Link class="btn btn-md btn-primary border-0 shadow mb-3" type="button" href="/admin/cars">
                    <i class="fa fa-long-arrow-alt-left me-2"></i>
                    Kembali
                </Link>

                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5 class="mb-3">Edit a Car</h5>

                        <form @submit.prevent="submit">
                            <div class="row">
                                <!-- kolom 1 -->
                                <div class="col-md-6">
                                    <!-- category_id -->
                                    <div class="form-group mb-3">
                                        <label for="category_id" class="form-label">Category</label>

                                        <select id="category_id" v-model="form.category_id" class="form-control">
                                            <option value="" disabled>Select Category</option>
                                            <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                                        </select>

                                        <div v-if="errors.category_id" class="alert alert-danger mt-2">
                                            {{ errors.category_id }}
                                        </div>
                                    </div>

                                    <!-- brand -->
                                    <div class="form-group mb-3">
                                        <label for="brand" class="form-label">Brand</label>
                                        <input type="text" id="brand" v-model="form.brand" class="form-control">

                                        <div v-if="errors.brand" class="alert alert-danger mt-2">
                                            {{ errors.brand }}
                                        </div>
                                    </div>

                                    <!-- model -->
                                    <div class="form-group mb-3">
                                        <label for="model" class="form-label">Model</label>
                                        <input type="text" id="model" v-model="form.model" class="form-control">

                                        <div v-if="errors.model" class="alert alert-danger mt-2">
                                            {{ errors.model }}
                                        </div>
                                    </div>

                                    <!-- license_plate -->
                                    <div class="form-group mb-3">
                                        <label for="license_plate" class="form-label">License Plate</label>
                                        <input type="text" id="license_plate" v-model="form.license_plate" class="form-control">

                                        <div v-if="errors.license_plate" class="alert alert-danger mt-2">
                                            {{ errors.license_plate }}
                                        </div>
                                    </div>

                                    <!-- year -->
                                    <div class="form-group mb-3">
                                        <label for="year" class="form-label">Year</label>
                                        <input type="text" id="year" v-model="form.year" class="form-control">

                                        <div v-if="errors.year" class="alert alert-danger mt-2">
                                            {{ errors.year }}
                                        </div>
                                    </div>
                                    
                                    <!-- image -->
                                    <div class="form-group mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" id="image" class="form-control" @change="handleFileUpload">

                                        <div v-if="errors.image" class="alert alert-danger mt-2">
                                            {{ errors.image }}
                                        </div>
                                    </div>

                                </div>

                                <!-- kolom 2 -->
                                <div class="col-md-6">
                                    <!-- fuel_type -->
                                    <div class="form-group mb-3">
                                        <label for="fuel_type" class="form-label">Fuel Type</label>
                                        <select id="fuel_type" v-model="form.fuel_type" class="form-control">
                                            <option value="" disabled>Select Fuel Type</option>
                                            <option value="gasoline">Gasoline</option>
                                            <option value="diesel">Diesel</option>
                                            <option value="electric">Electrik</option>
                                        </select>

                                        <div v-if="errors.fuel_type" class="alert alert-danger mt-2">
                                            {{ errors.fuel_type }}
                                        </div>
                                    </div>

                                    <!-- transmission -->
                                    <div class="form-group mb-3">
                                        <label for="transmission" class="form-label">Fuel Type</label>
                                        <select id="transmission" v-model="form.transmission" class="form-control">
                                            <option value="" disabled>Select Fuel Type</option>
                                            <option value="manual">Manual</option>
                                            <option value="automatic">Automatic</option>
                                        </select>

                                        <div v-if="errors.transmission" class="alert alert-danger mt-2">
                                            {{ errors.transmission }}
                                        </div>
                                    </div>

                                    <!-- daily_rate -->
                                    <div class="form-group mb-3">
                                        <label for="daily_rate" class="form-label">Daily Rate</label>
                                        <input type="number" id="daily_rate" v-model="form.daily_rate" class="form-control">

                                        <div v-if="errors.daily_rate" class="alert alert-danger mt-2">
                                            {{ errors.daily_rate }}
                                        </div>
                                    </div>

                                    <!-- passenger_capacity -->
                                    <div class="form-group mb-3">
                                        <label for="passenger_capacity" class="form-label">Passenger Capacity</label>
                                        <input type="number" id="passenger_capacity" v-model="form.passenger_capacity" class="form-control">

                                        <div v-if="errors.passenger_capacity" class="alert alert-danger mt-2">
                                            {{ errors.passenger_capacity }}
                                        </div>
                                    </div>

                                    <!-- penalty_rate_per_day -->
                                    <div class="form-group mb-3">
                                        <label for="penalty_rate_per_day" class="form-label">Penalty Rate Per Day (Rp)</label>
                                        <input type="number" id="penalty_rate_per_day" v-model="form.penalty_rate_per_day" class="form-control">

                                        <div v-if="errors.penalty_rate_per_day" class="alert alert-danger mt-2">
                                            {{ errors.penalty_rate_per_day }}
                                        </div>
                                    </div>

                                    <!-- description -->
                                    <div class="form-group mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        
                                        <textarea id="description" v-model="form.description" class="form-control" placeholder="Enter Car Desctription"></textarea>
                                        <div v-if="errors.description" class="alert alert-danger mt-2">
                                            {{ errors.description }}
                                        </div>
                                    </div>
                                </div>

                                <!-- submit -->
                                 <div class="d-flex justify-content-start mt-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                 </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>