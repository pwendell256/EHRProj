<template>
    <div class="p-4 bg-white shadow rounded-lg">

        <div class="flex justify-between items-center mb-4">
            <div>
                <h2 class="text-xl font-semibold flex items-center">
                    <Stethoscope class="w-5 h-5 mr-2" /> Medical Records
                </h2>
                <p class="text-gray-500 text-sm">Manage patient test records.</p>
            </div>
        </div>

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
import { Tabs, TabsList, TabsTrigger } from '@/Components/ui/tabs';
import { Stethoscope } from 'lucide-vue-next';

const selectedTab = ref('imaging'); // Default selected tab
const props = defineProps({
    patient: Object
});
</script>
