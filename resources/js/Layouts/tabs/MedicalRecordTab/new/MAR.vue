<template>
    <div class="overflow-x-auto p-4">
        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="px-4 py-2 text-left text-gray-600">Medication</th>
                    <th class="px-4 py-2 text-left text-gray-600">Date & Time</th>
                    <th class="px-4 py-2 text-left text-gray-600">Signature</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b" v-for="mar in patient.mar" :key="mar.id">
                    <td class="px-4 py-2">{{ mar.med }} <br> Dosage:{{ mar.dosage }} <br> route: {{ mar.route }} </td>
                    <td class="px-4 py-2">
                        <td v-for="martime in mar.martimes">
                            {{ martime.date }}  {{ martime.time }} {{ martime.adm }}
                        </td>
                    </td>
                    <td class="px-4 py-2"></td>
                </tr>

            </tbody>
        </table>
    </div>
</template>

<script setup>

const props = defineProps({
    patient: Object
})
</script>