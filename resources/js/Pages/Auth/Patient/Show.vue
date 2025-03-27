<template>
    <AuthenticatedLayout>
        <div class="p-4 bg-white shadow rounded">
            <h2 class="text-xl font-semibold">Patient Details</h2>
            <p><strong>ID:</strong> {{ patient.id }}</p>
            <p><strong>Name:</strong> {{ patient.full_name }}</p>
            <p><strong>Birthdate:</strong> {{ patient.birth_date }}</p>
            <p><strong>Age:</strong> {{ patient.age }}</p>
            <p><strong>Gender:</strong> {{ patient.gender }}</p>

            <div class="mt-4">
                <button @click="selectedTab = 'medical_record'"
                    :class="{ 'bg-blue-700': selectedTab === 'medical_record' }"
                    class="px-2 py-1 mx-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                    Medical Record
                </button>
                <button @click="selectedTab = 'medication'" :class="{ 'bg-blue-700': selectedTab === 'medication' }"
                    class="px-2 py-1 mx-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                    Medication
                </button>
            </div>

            <div class="mt-4">
                <MedicalRecord v-if="selectedTab === 'medical_record'" :patient="patient" />
                <Medication v-if="selectedTab === 'medication'" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MedicalRecord from '@/Layouts/tabs/MedicalRecord.vue';
import Medication from '@/Layouts/tabs/Medication.vue';

const props = defineProps({
    patient: Object
});

const selectedTab = ref('medical_record');
</script>
