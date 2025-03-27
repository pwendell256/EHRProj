<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left text-gray-600">Medical Record</th>
                                    <th class="px-4 py-2 text-left text-gray-600">Duration Limit (Days)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 border">Imaging Reports</td>
                                    <td class="px-4 py-2 border"><input type="Number" placeholder="Please Input in Days" v-model="form.imaging"
                                            class="w-full p-2 border rounded-lg focus:ring focus:ring-indigo-300"></td>
                                </tr>
                                <tr class=" hover:bg-gray-50">
                                    <td class="px-4 py-2 border">Laboratory Reports</td>
                                    <td class="px-4 py-2 border"><input type="Number" placeholder="Please Input in Days" v-model="form.laboratory"
                                            class="w-full p-2 border rounded-lg focus:ring focus:ring-indigo-300"></td>
                                </tr>
                                <tr class=" hover:bg-gray-50">
                                    <td class="px-4 py-2 border">Histopath Reports</td>
                                    <td class="px-4 py-2 border"><input type="Number" placeholder="Please Input in Days"v-model="form.histopath"
                                            class="w-full p-2 border rounded-lg focus:ring focus:ring-indigo-300"></td>
                                </tr>
                                <tr class=" hover:bg-gray-50">
                                    <td class="px-4 py-2 border">Microbiology Reports</td>
                                    <td class="px-4 py-2 border"><input type="Number" placeholder="Please Input in Days"v-model="form.microbiology"
                                            class="w-full p-2 border rounded-lg focus:ring focus:ring-indigo-300"></td>
                                </tr>
                                <tr class=" hover:bg-gray-50">
                                    <td class="px-4 py-2 border">Special Test Reports</td>
                                    <td class="px-4 py-2 border"><input type="Number" placeholder="Please Input in Days"v-model="form.specialtest"
                                            class="w-full p-2 border rounded-lg focus:ring focus:ring-indigo-300"></td>
                                </tr>
                            </tbody>
                            <button @click="updateConfig()"
                                class="px-4 py-2 my-4 mx-2  text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                                Update
                            </button>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </AuthenticatedLayout>

</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { route } from '../../../../../vendor/tightenco/ziggy/src/js';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    config:Object
})

const form = useForm({
    imaging: props.config.imaging || '',
    laboratory:props.config.laboratory || '',
    histopath:props.config.histopath || '',
    microbiology:props.config.microbiology || '',
    specialtest:props.config.specialtest || '',
})

const updateConfig = () => {
    form.put(route('config.update', props.config.id));
}
</script>