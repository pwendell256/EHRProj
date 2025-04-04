<template>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">DIAGNOSIS</h1>

        <table class="min-w-full table-auto border-collapse">
            <tbody>
                <tr>
                    <td class="px-4 py-2 border font-bold">Initial Diagnosis:</td>
                    <td class="px-4 py-2 border">
                        <textarea class="w-full border-gray-300 rounded px-2 py-1" rows="4" v-model="form.initial" ></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border font-bold">T/C (To Consider):</td>
                    <td class="px-4 py-2 border">
                        <textarea class="w-full border-gray-300 rounded px-2 py-1" rows="4" v-model="form.tc" ></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border font-bold">R/O (Rule Out)::</td>
                    <td class="px-4 py-2 border">
                        <textarea class="w-full border-gray-300 rounded px-2 py-1" rows="4" v-model="form.ro" ></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border font-bold">Final Diagnosis:</td>
                    <td class="px-4 py-2 border">
                        <textarea class="w-full border-gray-300 rounded px-2 py-1" rows="4" v-model="form.final" ></textarea>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
    <div class="flex justify-end">
        <button type="submit" @click.prevent="update()"
            class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
            Update
        </button>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    patient : Object
})
const form = useForm ({
    initial: props.patient?.diagnosis?.initial || '',
    tc: props.patient?.diagnosis?.tc || '',
    ro: props.patient?.diagnosis?.ro || '',
    final: props.patient?.diagnosis?.final || '',
})


const update = () => {
    form.put(route('diagnosis.update', props.patient?.diagnosis?.id))
}
</script>