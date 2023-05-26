<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import {defineComponent} from "vue";
import IncidentCard from "@/Components/IncidentCard.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Map from "@/Components/Map.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";

defineComponent({
    components: {
        Head,
        Link,
        IncidentCard,
    },
});
defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
    incidents: {
        type: Array,
        required: true,
    },
    heroes: {
        type: Array,
        required: false,
    },
    cities: {
        type: Array,
        required: true,
    },
})
const form = useForm({
    location: '',
    hero: '',
    incident: '',
    description: '',
    city: '',
});

const cityForm = useForm({
    name: '',
    latitude: '',
    longitude: '',
});

navigator.geolocation.getCurrentPosition(function (location) {
    form.location = location.coords.latitude + ',' + location.coords.longitude;
});

const submit = () => {
    form.hero = document.getElementById('heroes-select').value;
    form.post(route('accident.create'), {});
};

const createCity = () => {
    cityForm.post(route('city.create'), {});
};
</script>
<script>
export default {
    methods: {
        onChange(event) {
            let incident = event.target.value;
            let city = document.getElementById('city-select').value;
            navigator.geolocation.getCurrentPosition(function (location) {
                let url = '/heroes?inc=' + incident
                if (city !== ""){
                    url += '&city=' + city
                } else {
                    url += '&lat=' + location.coords.latitude + '&lng=' + location.coords.longitude
                }
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        let heroes = document.getElementById('heroes-select');
                        heroes.innerHTML = '';
                        data.forEach(function (hero) {
                            heroes.innerHTML += '<option value=' + hero.id + '>' + hero.name + '</option>';
                        });
                    });
            });
        },
    }
    ,
    data() {
        return {
            dialog: false,
            city: false,
        }
    },
}

</script>

<template>
    <Head title="Welcome"/>

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
    >
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
            >Dashboard
            </Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >Log in
                </Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >Register
                </Link
                >
            </template>
        </div>

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <a class="flex items-center text-indigo-400 no-underline hover:no-underline font-bold text-2xl lg:text-4xl"
                   href="#">
                    MoreThan
                    <span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-blue-400 via-pink-500 to-purple-500">Hero</span>
                </a>
            </div>
            <div class="flex max-w-screen-md flex-wrap">
                <IncidentCard v-for="incident in incidents" :incident="incident"></IncidentCard>

            </div>
            <PrimaryButton @click="dialog=true">Report Incident</PrimaryButton>
            <Modal :show="dialog">
                <div>
                    <h4 class="font-bold px-4 pt-3 text-white font-size text-2xl">Report incident</h4>
                    <form @submit.prevent="submit">
                        <div class="px-4 py-3">

                            <InputLabel value="Incident type"/>
                            <select
                                class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                @change="onChange($event)"
                                name="incident"
                                v-model="form.incident"
                                id="incident-select"
                                required>
                                <option v-for="incident in incidents">{{ incident.name }}</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.incident"/>

                            <InputLabel value="City"/>
                            <select
                                class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                name="city"
                                v-model="form.city"
                                id="city-select"
                                required>
                                <option v-for="city in cities" :value=city.id>{{ city.name }}</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.city"/>

                            <InputLabel value="Hero"/>
                            <select
                                class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                id="heroes-select"
                                name="hero"
                                v-model="form.hero"
                                required>
                                <option>Choose Incident first ..</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.hero"/>

                            <InputLabel value="Incident Description"/>
                            <div class="mt-1">
                                <input
                                    type="text"
                                    v-model="form.description"
                                    name="description"
                                    id="description"
                                    class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="Incident description"
                                />
                                <InputError class="mt-2" :message="form.errors.description"/>

                            </div>
                            <Map :center="{lat: 48.5, lng: 2.2}" :zoom="5" @update-latitude="form.latitude = $event"
                                 @update-longitude="form.longitude = $event" ref="map"/>
                        </div>
                        <div class="px-4 py-3">
                            <PrimaryButton>Submit report</PrimaryButton>
                            <SecondaryButton class="mx-1" @click="dialog=false">Cancel</SecondaryButton>
                        </div>
                    </form>
                </div>
            </Modal>
            <SecondaryButton class="my-3" @click="city=true">Create City</SecondaryButton>
            <Modal :show="city">
                <div>
                    <h4 class="pa-4 text-white">Report incident</h4>
                    <form @submit.prevent="createCity">
                        <div class="p-4">
                            <div class="mt-1">
                                <input
                                    type="text"
                                    v-model="cityForm.name"
                                    name="name"
                                    id="name"
                                    class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="City name"
                                />
                            </div>
                            <InputError class="mt-2" :message="cityForm.errors.name"/>
                        </div>
                        <div style="width: 100%;height: 300px" class="pa-2">
                            <Map :center="{lat: 48.5, lng: 2.2}" :zoom="5" @update-latitude="cityForm.latitude = $event"
                                 @update-longitude="cityForm.longitude = $event" ref="map"/>
                        </div>
                        <InputError class="mt-2" :message="cityForm.errors.latitude"/>
                        <InputError class="mt-2" :message="cityForm.errors.longitude"/>

                        <PrimaryButton>Create City</PrimaryButton>
                        <SecondaryButton @click="city=false">Cancel</SecondaryButton>

                    </form>
                </div>
            </Modal>
        </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
