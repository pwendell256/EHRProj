<template>
    <AuthenticatedLayout>
        <div class="mt-10 p-6 bg-white rounded-lg">
            <!-- Patient Profile Section -->


            <div class="w-full bg-card text-card-foreground rounded-xl shadow-md p-6">
                <div class="grid grid-cols-1 md:grid-cols-[auto,1fr] gap-6 items-start">

                    <!-- Profile Picture -->
                    <div class="relative w-24 h-24 mx-auto md:mx-0">
                        <img :src="patient.image ? `/storage/${patient.image}` : defaultImage" alt="Patient Photo"
                            class="w-full h-full object-cover object-center rounded-full border border-border" />
                        <!-- Upload Button -->
                        <label
                            class="absolute bottom-0 right-0 bg-primary hover:bg-primary/90 text-primary-foreground p-1.5 rounded-full cursor-pointer shadow-md"
                            title="Change photo">
                            <input type="file" class="hidden" @change="uploadPicture" accept="image/*" />
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </label>
                    </div>

                    <!-- Patient Information -->
                    <div class="space-y-1">
                        <h2 class="text-2xl font-bold mb-3">{{ patient.full_name }}</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 text-sm text-muted-foreground">
                            <p><strong class="text-card-foreground">Address:</strong> {{ patient?.patientinfo?.address
                            }}</p>
                            <p><strong class="text-card-foreground">Age:</strong> {{ patient.age }}</p>
                            <p><strong class="text-card-foreground">Birthdate:</strong> {{ patient.birth_date }}</p>
                            <p><strong class="text-card-foreground">Birthplace:</strong> {{ patient.birth_place }}</p>
                            <p><strong class="text-card-foreground">Gender:</strong> {{ patient.gender }}</p>
                            <p><strong class="text-card-foreground">Status:</strong> {{ patient.status }}</p>
                            <p><strong class="text-card-foreground">Religion:</strong> {{ patient?.patientinfo?.religion
                            }}</p>
                            <p><strong class="text-card-foreground">Educational Attainment:</strong> {{
                                patient.education }}</p>
                            <p><strong class="text-card-foreground">Chief Complaint:</strong> {{ patient.chiefComplaint
                            }}</p>
                            <p><strong class="text-card-foreground">Room Number:</strong> {{ patient.room_no
                            }}</p>
                             <p><strong class="text-card-foreground">Station:</strong> {{ patient.station
                            }}</p>
                        </div>
                    </div>
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
