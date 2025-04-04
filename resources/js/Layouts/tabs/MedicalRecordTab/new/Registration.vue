<template>
    <div class="bg-gray-50 p-4 rounded-lg">
        <!-- Header -->
        <h3 class="text-xl font-semibold mb-2">Registration Sheet</h3>

        <!-- Profile & Patient Info -->
        <div class="flex items-start gap-6">
            <!-- Profile Image -->


            <div class="w-full bg-white rounded-xl shadow-md p-6">
                <!-- Patient Image -->
                <div class="flex justify-center mb-6">
                    <div class="relative w-24 h-24 border-2 border-green-500 rounded-full overflow-hidden">
                        <img :src="patient.image ? `/storage/${patient.image}` : defaultImage" alt="Patient Photo"
                            class="w-full h-full object-cover object-center" />
                    </div>
                </div>

                <!-- Form Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <Label>
                        <strong>Patient’s Name:</strong>
                        <Input type="text" v-model="form.fullname" disabled />
                    </Label>

                    <Label>
                        <strong>Birthdate:</strong>
                        <Input type="date" v-model="form.birthdate" disabled />
                    </Label>

                    <Label>
                        <strong>Hospital Registration #:</strong>
                        <Input type="text" v-model="form.registration_no" />
                    </Label>

                    <Label>
                        <strong>Religion:</strong>
                        <Input type="text" v-model="form.religion" />
                    </Label>

                    <Label>
                        <strong>Address:</strong>
                        <Input type="text" v-model="form.address" />
                    </Label>

                    <Label>
                        <strong>Date of Admission:</strong>
                        <Input type="date" v-model="form.admission_date" />
                    </Label>

                    <Label>
                        <strong>Chief Complaint:</strong>
                        <Input type="text" v-model="form.chief_complaint" disabled />
                    </Label>

                    <Label>
                        <strong>Admitting Diagnosis:</strong>
                        <Input type="text" v-model="form.diagnosis" />
                    </Label>
                </div>
            </div>

        </div>

        <!-- Additional Information -->
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mt-4 bg-white p-4 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-green-800 mb-2">Medical Details</h3>
                <Label><strong>Other Diagnoses:</strong>
                    <Input type="text" v-model="form.other_diagnoses" />
                </Label>
                <Label><strong>Allergies:</strong>
                    <Input type="text" v-model="form.allergies" />
                </Label>
                <Label><strong>Reaction to Allergies:</strong>
                    <Input type="text" v-model="form.reaction" />
                </Label>
            </div>

            <!-- Emergency Contact -->
            <div class="mt-4 bg-white p-4 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-green-800 mb-2">Emergency Contact</h3>
                <Label><strong>Name:</strong>
                    <Input type="text" v-model="form.emergency_name" />
                </Label>
                <Label><strong>Relationship:</strong>
                    <Input type="text" v-model="form.emergency_relationship" />
                </Label>
                <Label><strong>Address:</strong>
                    <Input type="text" v-model="form.emergency_address" />
                </Label>
                <Label><strong>Phone:</strong>
                    <Input type="text" v-model="form.emergency_phone" />
                </Label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end mt-4">
            <Button @click="updateForm()">
                Update
            </Button>
        </div>


    </div>
</template>

<script setup>
import { Label } from '@/Components/ui/label';
import { Input } from '@/Components/ui/input';
import { Button } from '@/components/ui/button';
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

<style scoped></style>
