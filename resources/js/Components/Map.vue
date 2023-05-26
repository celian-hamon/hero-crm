<script setup>
import "leaflet/dist/leaflet.css"
import { LMap, LTileLayer, LMarker } from "@vue-leaflet/vue-leaflet"

import { ref } from "vue";

let zoom = ref(null)
let center = ref(null)
let marker = ref(null)

const emits = defineEmits(['update-latitude', 'update-longitude'])
const addMarker = e => {
    marker.value = e.latlng
    //edit form from parent
    emits('update-latitude', e.latlng.lat.toString())
    emits('update-longitude', e.latlng.lng.toString())

}
const mapReady = map => {
    map.on('click', addMarker)
}
</script>

<template>
    <l-map ref="map" v-model:zoom="zoom" v-model:center="center" :useGlobalLeaflet="false" @ready="mapReady">
        <l-tile-layer url="https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png"
                      layer-type="base"
                      name="Stadia Maps Basemap"></l-tile-layer>
        <l-marker v-if="marker" v-model:lat-lng="marker"></l-marker>
    </l-map>
</template>
