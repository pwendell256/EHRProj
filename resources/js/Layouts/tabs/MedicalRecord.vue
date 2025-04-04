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
                    <TabsTrigger value="Registration" @click="selectedTab = 'Registration'">Registration Sheet</TabsTrigger>
                    <TabsTrigger value="History" @click="selectedTab = 'History'">History</TabsTrigger>
                    <TabsTrigger value="Assessment" @click="selectedTab = 'Assessment'">Assessment</TabsTrigger>
                    <TabsTrigger value="laboratory" @click="selectedTab = 'laboratory'">Laboratory and Diagnosis</TabsTrigger>
                    <TabsTrigger value="Diagnosis" @click="selectedTab = 'Diagnosis'">Diagnosis</TabsTrigger>
                    <TabsTrigger value="Treatment" @click="selectedTab = 'Treatment'">Treatment</TabsTrigger>
                    <TabsTrigger value="MAR" @click="selectedTab = 'MAR'">MAR</TabsTrigger>
                    <TabsTrigger value="Nurses" @click="selectedTab = 'Nurses'">Nurses Notes</TabsTrigger>
                    <TabsTrigger value="Doctor" @click="selectedTab = 'Doctor'">Doctor's Order</TabsTrigger>
                    <TabsTrigger value="Allergy" @click="selectedTab = 'Allergy'">Allergy</TabsTrigger>
                </TabsList>
            </Tabs> 
        </div>

        <!-- Content -->
        <div class="mt-4">
            <Registration v-if="selectedTab === 'Registration'" :patient="patient" />
            <History v-if="selectedTab === 'History'" :patient="patient" />
            <Assessment v-if="selectedTab === 'Assessment'" :patient="patient" />
            <Laboratory v-if="selectedTab === 'laboratory'" :patient="patient" />
            <Diagnosis v-if="selectedTab === 'Diagnosis'" :patient="patient" />
            <Treatment v-if="selectedTab === 'Treatment'" :patient="patient" />
            <MAR v-if="selectedTab === 'MAR'" :patient="patient" />
            <Nurses v-if="selectedTab === 'Nurses'" :patient="patient" />
            <Doctor v-if="selectedTab === 'Doctor'" :patient="patient" />
            <Allergy v-if="selectedTab === 'Allergy'" :patient="patient" />
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import Laboratory from './MedicalRecordTab/Laboratory.vue';
import Assessment from './MedicalRecordTab/new/Assessment.vue';
import Allergy from './MedicalRecordTab/Allergy.vue';
import { Tabs, TabsList, TabsTrigger } from '@/Components/ui/tabs';
import { Stethoscope } from 'lucide-vue-next';
import History from './MedicalRecordTab/new/History.vue';
import Diagnosis from './MedicalRecordTab/new/Diagnosis.vue';
import Treatment from './MedicalRecordTab/new/Treatment.vue';
import MAR from './MedicalRecordTab/new/MAR.vue';
import Nurses from './MedicalRecordTab/new/Nurses.vue';
import Doctor from './MedicalRecordTab/new/Doctor.vue';
import Registration from './MedicalRecordTab/new/Registration.vue';

const selectedTab = ref('Registration'); 
const props = defineProps({
    patient: Object
});
</script>
