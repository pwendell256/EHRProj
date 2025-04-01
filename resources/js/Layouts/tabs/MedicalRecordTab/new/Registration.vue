<template>
    <div class="p-6 bg-green-100 rounded-lg shadow-lg max-w-4xl mx-auto">
        <!-- Header -->
        <h2 class="text-2xl font-bold text-center text-green-800 mb-4">REGISTRATION SHEET</h2>

        <!-- Profile & Patient Info -->
        <div class="flex items-start gap-6">
            <!-- Profile Image -->
            <div class="relative w-24 h-24 border-2 border-green-500 rounded-full overflow-hidden">
                <img :src="`/storage/` + patient.image || defaultImage" alt="Patient Photo"
                    class="w-full h-full object-cover">
            </div>

            <!-- Patient Information Form -->
            <div class="flex-1 grid grid-cols-2 gap-4 bg-white p-4 rounded-lg shadow-md">
                <label><strong>Patient’s Name:</strong> 
                    <input type="text" class="input-field" v-model="form.fullname" disabled>
                </label>
                <label><strong>Birthdate:</strong> 
                    <input type="date" class="input-field" v-model="form.birthdate" disabled>
                </label>
                <label><strong>Hospital Registration #:</strong> 
                    <input type="text" class="input-field" v-model="form.registration_no">
                </label>
                <label><strong>Religion:</strong> 
                    <input type="text" class="input-field" v-model="form.religion">
                </label>
                <label><strong>Address:</strong> 
                    <input type="text" class="input-field" v-model="form.address">
                </label>
                <label><strong>Date of Admission:</strong> 
                    <input type="date" class="input-field" v-model="form.admission_date">
                </label>
                <label><strong>Chief Complaint:</strong> 
                    <input type="text" class="input-field" v-model="form.chief_complaint" disabled>
                </label>
                <label><strong>Admitting Diagnosis:</strong> 
                    <input type="text" class="input-field" v-model="form.diagnosis">
                </label>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="mt-4 bg-white p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-green-800 mb-2">Medical Details</h3>
            <label><strong>Other Diagnoses:</strong> 
                <input type="text" class="input-field" v-model="form.other_diagnoses">
            </label>
            <label><strong>Allergies:</strong> 
                <input type="text" class="input-field" v-model="form.allergies">
            </label>
            <label><strong>Reaction to Allergies:</strong> 
                <input type="text" class="input-field" v-model="form.reaction">
            </label>
        </div>

        <!-- Emergency Contact -->
        <div class="mt-4 bg-white p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-green-800 mb-2">Emergency Contact</h3>
            <label><strong>Name:</strong> 
                <input type="text" class="input-field" v-model="form.emergency_name">
            </label>
            <label><strong>Relationship:</strong> 
                <input type="text" class="input-field" v-model="form.emergency_relationship">
            </label>
            <label><strong>Address:</strong> 
                <input type="text" class="input-field" v-model="form.emergency_address">
            </label>
            <label><strong>Phone:</strong> 
                <input type="text" class="input-field" v-model="form.emergency_phone">
            </label>
        </div>

        <!-- Submit Button -->
        <div class="mt-6 text-center">
            <button @click="updateForm()" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Update
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    patient: Object,
});

// Define the form with existing patient data and bind it to inputs
const form = useForm({
    fullname: props.patient.full_name ?? '',
    birthdate: props.patient.birth_date ?? '',
    registration_no: props.patient?.patientinfo?.registration_no ?? '',
    religion: props.patient?.patientinfo?.religion ?? '',
    address: props.patient?.patientinfo?.address ?? '',
    admission_date: props.patient?.patientinfo?.admission_date ?? '',
    diagnosis: props.patient?.patientinfo?.diagnosis ?? '',
    chief_complaint: props.patient.chiefComplaint ?? '',
    other_diagnoses: props.patient?.patientinfo?.other_diagnoses ?? '',
    allergies: props.patient?.patientinfo?.allergies ?? '',
    reaction: props.patient?.patientinfo?.reaction ?? '',
    emergency_name: props.patient?.patientinfo?.emergency_name ?? '',
    emergency_relationship: props.patient?.patientinfo?.emergency_relationship ?? '',
    emergency_address: props.patient?.patientinfo?.emergency_address ?? '',
    emergency_phone: props.patient?.patientinfo?.emergency_phone ?? ''
});

const updateForm = () => {
    form.put(route('registration.update', props.patient?.patientinfo.id))
}

const defaultImage = ref('https://via.placeholder.com/100');


</script>

<style scoped>
.input-field {
    width: 100%;
    padding: 6px;
    margin-top: 4px;
    border: 1px solid #ddd;
    border-radius: 4px;
    outline: none;
}
</style>
