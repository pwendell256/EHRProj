<template>
    <AuthenticatedLayout>
        <div class="mt-10"></div>
       
            <h2 class="text-xl font-semibold">Patient Details</h2>
            <p><strong>ID:</strong> {{ patient.id }}</p>
            <p><strong>Name:</strong> {{ patient.full_name }}</p>
            <p><strong>Birthdate:</strong> {{ patient.birth_date }}</p>
            <p><strong>Age:</strong> {{ patient.age }}</p>
            <p><strong>Gender:</strong> {{ patient.gender }}</p>

            <div class="mt-10">

                <Tabs default-value="medical_record" class="w-full">
                <TabsList class="grid w-80 grid-cols-2">
                    <TabsTrigger value="medical_record" @click="selectedTab = 'medical_record'">
                        Medical Record
                    </TabsTrigger>
                    <TabsTrigger value="medication" @click="selectedTab = 'medication'">
                        Medication
                    </TabsTrigger>
                </TabsList>
            </Tabs>
    
            </div>

            <div class="mt-4">
                <MedicalRecord v-if="selectedTab === 'medical_record'" :patient="patient" />
                <Medication v-if="selectedTab === 'medication'" :patient="patient" />
            </div>




    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MedicalRecord from '@/Layouts/tabs/MedicalRecord.vue';
import Medication from '@/Layouts/tabs/Medication.vue';
import { Button } from '@/components/ui/button';
import { Tabs, TabsList, TabsTrigger } from '@/components/ui/tabs';

const props = defineProps({
    patient: Object
});

const selectedTab = ref('medical_record');
</script>
