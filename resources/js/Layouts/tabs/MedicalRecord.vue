<template>
    <div class="p-4 bg-white shadow rounded-lg">
        <!-- Header -->
        <h2 class="text-2xl font-bold flex items-center gap-2 mb-1">
            <span class="bg-gray-700 text-white px-2 py-1 rounded">📑</span>
            Medical Records 
        </h2>
        <p class="text-gray-500 mb-4">Manage patient test records.</p>

        <hr class="border-b border-gray-300 mb-4" />

        <!-- Tabs -->
        <div class="mt-4">
            <Tabs default-value="imaging" class="w-full">
                <TabsList class="grid grid-cols-6 w-90">
                    <TabsTrigger value="imaging" @click="selectedTab = 'imaging'">Imaging</TabsTrigger>
                    <TabsTrigger value="laboratory" @click="selectedTab = 'laboratory'">Laboratory</TabsTrigger>
                    <TabsTrigger value="histopath" @click="selectedTab = 'histopath'">Histopath</TabsTrigger>
                    <TabsTrigger value="microbiology" @click="selectedTab = 'microbiology'">Microbiology</TabsTrigger>
                    <TabsTrigger value="specialtest" @click="selectedTab = 'specialtest'">Special Test</TabsTrigger>
                    <TabsTrigger value="allergy" @click="selectedTab = 'allergy'">Allergy</TabsTrigger>
                </TabsList>
            </Tabs>
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
import { Tabs, TabsList, TabsTrigger } from '@/components/ui/tabs';

const selectedTab = ref('imaging'); // Default selected tab
const props = defineProps({
    patient: Object
});
</script>
