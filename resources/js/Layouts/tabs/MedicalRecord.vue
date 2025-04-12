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
            <Tabs v-model="selectedTab" class="w-full">
                <TabsList class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-1 bg-gray-50 p-1 rounded-md">
                    <TabsTrigger v-for="tab in tabs" :key="tab.value" :value="tab.value"
                        class="data-[state=active]:bg-primary data-[state=active]:text-primary-foreground text-muted-foreground rounded-md px-3 py-2 text-sm font-medium transition-colors">
                        {{ tab.label }}
                    </TabsTrigger>
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
import { ref, watch, onMounted } from 'vue'
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

const props = defineProps({
    patient: Object
});

const url = new URL(window.location.href)
const selectedTab = ref(url.searchParams.get('tab') || 'Registration')

watch(selectedTab, (newTab) => {
    const newUrl = new URL(window.location.href)
    newUrl.searchParams.set('tab', newTab)
    window.history.replaceState({}, '', newUrl)
})

const tabs = [
    { value: 'Registration', label: 'Registration Sheet' },
    { value: 'History', label: 'History' },
    { value: 'Assessment', label: 'Assessment' },
    { value: 'laboratory', label: 'Laboratory and Diagnosis' },
    { value: 'Diagnosis', label: 'Diagnosis' },
    { value: 'Treatment', label: 'Treatment' },
    { value: 'MAR', label: 'MAR' },
    { value: 'Nurses', label: 'Nurses Notes' },
    { value: 'Doctor', label: "Doctor's Order" },
    { value: 'Allergy', label: 'Allergy' },
];


</script>
