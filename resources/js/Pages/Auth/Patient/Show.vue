<template>
    <AuthenticatedLayout>
        <div class="mt-10 p-6 bg-white rounded-lg shadow-md">
            <!-- Patient Profile Section -->
            <div class="flex items-center space-x-4">
                <!-- Patient Profile Picture -->
                <div class="relative">
                    <img 
                        :src="`/storage/` + patient.image || defaultImage" 
                        alt="Patient Photo" 
                        class="w-24 h-24 object-cover rounded-full border" 
                    />
                    <!-- Add/Edit Profile Picture Button -->
                    <label class="absolute bottom-0 right-0 bg-blue-500 text-white p-2 rounded-full cursor-pointer hover:bg-blue-600">
                        <input type="file" class="hidden" @change="uploadPicture" accept="image/*" />
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </label>
                </div>

                <!-- Patient Info -->
                <div>
                    <h2 class="text-xl font-semibold">{{ patient.full_name }}</h2>
                    <p class="text-gray-600"><strong>Address </strong> {{ patient?.patientinfo?.address }}</p>
                    <p class="text-gray-600"><strong>Age: </strong> {{ patient.age }}</p>
                    <p class="text-gray-600"><strong>Birthdate: </strong> {{ patient.birth_date }}</p>
                    <p class="text-gray-600"><strong>Birthplace: </strong> </p>
                    <p class="text-gray-600"><strong>Gender: </strong> {{ patient.gender }}</p>
                    <p class="text-gray-600"><strong>Religion: </strong> {{ patient?.patientinfo?.religion }}</p>
                    <p class="text-gray-600"><strong>Educational Attainment: </strong></p>
                    <p class="text-gray-600"><strong>Chief Complaint: </strong>{{ patient.chiefComplaint }}</p>
                </div>
            </div>

            <!-- Tabs Section -->
            <div class="mt-4">
                <MedicalRecord v-if="selectedTab === 'medical_record'" :patient="patient" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MedicalRecord from '@/Layouts/tabs/MedicalRecord.vue';

const props = defineProps({
    patient: Object
});

const defaultImage = ref('https://via.placeholder.com/100');
const selectedTab = ref('medical_record');

// Create an Inertia form for file upload
const form = useForm({
    image: null
});

const uploadPicture = (event) => {
    const file = event.target.files[0];
    if (file) {
        const formData = new FormData();
        formData.append('image', file);

        // Send form data to Laravel backend
        router.post(route('patients.upload', { id: props.patient.id }), formData, {
            preserveScroll: true,
            onSuccess: () => {
                console.log("Image uploaded successfully!");
            },
            onError: (errors) => {
                console.error("Upload failed:", errors);
            }
        });
    }
};
</script>

