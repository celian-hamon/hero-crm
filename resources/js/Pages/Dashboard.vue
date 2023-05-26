<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';

defineProps(['incidents', 'statuses']);
let form = useForm({
    id: '',
    status: '',
});
const submit = (id) => {
    form.id = id;
    form.put(route('accident.edit'));
}
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div v-for="incident in incidents" class="flex justify-space-between w-full">
                            <div class="w-full">
                                <h2 class="text-white font-weight-bold ">{{ incident.incident.name }}</h2>
                                <p class="text-white"> {{ incident.description }}</p>
                                <p class="text-white">{{incident.city.name}}</p>
                            </div>
                            <select
                                class="shadow-sm focus:ring-red-500 focus:border-red-500 block  sm:text-sm border-gray-300 rounded-md"
                                @change="submit(incident.id)" name="status" v-model="form.status">
                                <option :selected="incident.status.id === status.id" v-for="status in statuses" :value="status.id">{{ status.name }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
