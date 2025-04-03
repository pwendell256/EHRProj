<template>
    <div class="overflow-x-auto p-4">
        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="px-4 py-2 text-left text-gray-600">Medication</th>
                    <th class="px-4 py-2 text-left text-gray-600">Date</th>
                    <th class="px-4 py-2 text-left text-gray-600">Time</th>
                    <th class="px-4 py-2 text-left text-gray-600">ADM</th>
                    <th class="px-4 py-2 text-left text-gray-600">Signature</th>
                </tr>
            </thead>
            <tbody>
                <template v-for="mar in sortedMedications" :key="mar.id">
                    <tr v-for="(martime, index) in mar.sortedMartimes" :key="martime.id" class="border-b">
                        <!-- Merge Medication Cell for the first row only -->
                        <td class="px-4 py-2" :rowspan="mar.sortedMartimes.length" v-if="index === 0">
                            <strong>{{ mar.med }}</strong> <br>
                            Dosage: {{ mar.dosage }} <br>
                            Route: {{ mar.route }}
                        </td>

                        <!-- Show date only for the first time entry of that date -->
                        <td class="px-4 py-2" v-if="shouldShowDate(martime, mar.sortedMartimes, index)">
                            {{ martime.date }}
                        </td>
                        <td v-else></td>

                        <td class="px-4 py-2">{{ martime.time }}</td>
                        <td class="px-4 py-2">{{ martime.adm }}</td>
                        <td class="px-4 py-2"></td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    patient: Object
});

// Function to determine if the date should be shown
const shouldShowDate = (martime, sortedMartimes, index) => {
    return index === 0 || martime.date !== sortedMartimes[index - 1].date;
};

// Computed property to sort medications by the earliest date
const sortedMedications = computed(() => {
    return props.patient.mar.map(mar => ({
        ...mar,
        sortedMartimes: [...mar.martimes].sort((a, b) => new Date(a.date) - new Date(b.date))
    }));
});
</script>
