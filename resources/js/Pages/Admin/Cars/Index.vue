<script setup>
    import { Head, Link } from '@inertiajs/vue3';
    import LayoutAdmin from '../../../Layouts/Admin.vue';
    import Pagination from '../../../Components/Pagination.vue';
    import formatCurrency from '../../../Utils/formatCurrency'

    defineOptions ({
        layout: LayoutAdmin
    })

    const props = defineProps({
        cars: Object,
    })
</script>

<template>
    <Head>
        <title>Cars - Bee Rental Mobil</title>
    </Head>

      <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <!-- Image Upload Form -->
            <div class="col-md-12 mb-3">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between alert-items-center">
                                    <h5>List Of Cars</h5>
                                    <Link class="btn btn-primary" href="/admin/cars/create">
                                        <i class="fa fa-plus-circle"></i>
                                        Add Cars
                                    </Link>
                                </div>
                            </div>
                        </div>

                        <!-- table -->
                         <div class="table-responsive">
                            <table class="table table-bordered table-centered table-nowrap mb-0 rounded">
                                <thead class="thead-dark">
                                    <tr class="border-0">
                                        <th class="border-0 rounded-start">No.</th>
                                        <th class="border-0">Merk</th>
                                        <th class="border-0">Model</th>
                                        <th class="border-0">Plat Nomor</th>
                                        <th class="border-0">Tahun</th>
                                        <th class="border-0">Fuel Type</th>
                                        <th class="border-0">Harga/hari</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(car, index) in cars.data" :key="car.id">
                                        <td class="fw-bold text-cente">{{ index + 1 + (cars.current_page - 1) * cars.per_page }}</td>
                                        <td>{{ car.brand }}</td>
                                        <td>{{ car.model }}</td>
                                        <td>{{ car.license_plate }}</td>
                                        <td>{{ car.year }}</td>
                                        <td>{{ car.fuel_type }}</td>
                                        <td>{{ formatCurrency(car.daily_rate) }}</td>
                                        <td class="text-center">
                                            <Link class="btn btn-sm btn-warning" :href="`/admin/cars/${car.slug}/edit`">
                                                Edit
                                            </Link>

                                            <button type="button" class="btn btn-danger btn-sm ms-2">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                         </div>
                        
                         <!-- pagination -->
                        <div v-if="cars.data.length !== 0">
                            <Pagination :links="cars.links" align="end" />
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>