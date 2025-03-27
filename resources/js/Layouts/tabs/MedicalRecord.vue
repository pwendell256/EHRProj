<template>
    <div class="p-4 bg-white shadow rounded-lg">
        <!-- Header -->
        <h2 class="text-2xl font-bold flex items-center gap-2 mb-1">
            <span class="bg-gray-700 text-white px-2 py-1 rounded">📑</span>
            Medical Records of
        </h2>
        <p class="text-gray-500 mb-4">Manage patient test records.</p>

        <hr class="border-b border-gray-300 mb-4" />

        <!-- Tabs -->
        <div class="mt-4">
            <button @click="selectedTab = 'imaging'" :class="{ 'bg-blue-700': selectedTab === 'imaging' }"
                class="px-2 py-1 mx-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                Imaging
            </button>
            <button @click="selectedTab = 'laboratory'" :class="{ 'bg-blue-700': selectedTab === 'laboratory' }"
                class="px-2 py-1 mx-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                Laboratory
            </button>
            <button @click="selectedTab = 'histopath'" :class="{ 'bg-blue-700': selectedTab === 'histopath' }"
                class="px-2 py-1 mx-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                Histopath
            </button>
            <button @click="selectedTab = 'microbiology'" :class="{ 'bg-blue-700': selectedTab === 'microbiology' }"
                class="px-2 py-1 mx-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                Microbiology
            </button>
            <button @click="selectedTab = 'specialtest'" :class="{ 'bg-blue-700': selectedTab === 'specialtest' }"
                class="px-2 py-1 mx-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                Special Test
            </button>
            <button @click="selectedTab = 'allergy'" :class="{ 'bg-blue-700': selectedTab === 'allergy' }"
                class="px-2 py-1 mx-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                Allergy
            </button>
        </div>

        <!-- Content -->
        <div class="mt-4">
            <Imaging v-if="selectedTab === 'imaging'" :patient="patient" />
            <Laboratory v-if="selectedTab === 'laboratory'" :patient="patient" />
            <Histopath v-if="selectedTab === 'histopath'" :patient="patient" />
            <Microbiology v-if="selectedTab === 'microbiology'" :patient="patient" />
            <Specialtest v-if="selectedTab === 'specialtest'" :patient="patient" />
            <Allergy v-if="selectedTab === 'allergy'" :patient="patient" />

        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import Imaging from './MedicalRecordTab/Imaging.vue';
import Laboratory from './MedicalRecordTab/Laboratory.vue';
import Histopath from './MedicalRecordTab/Histopath.vue';
import Microbiology from './MedicalRecordTab/Microbiology.vue';
import Specialtest from './MedicalRecordTab/Specialtest.vue';
import Allergy from './MedicalRecordTab/Allergy.vue';

const selectedTab = ref('imaging'); // Default selected tab
const props = defineProps({
    patient: Object
});
</script>
