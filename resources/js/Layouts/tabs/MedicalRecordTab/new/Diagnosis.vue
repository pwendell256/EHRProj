<template>
    <div class="bg-gray-50 p-4 rounded-lg">
        <h1 class="text-xl font-semibold mb-4">Diagnosis</h1>

        <div class="overflow-x-auto mt-4 border rounded-lg">
            <Table>
                <TableBody>
                    <TableRow>
                        <TableCell class="w-1/4 font-bold align-top">Initial Diagnosis:</TableCell>
                        <TableCell>
                            <Textarea class="w-full border rounded px-2 py-1 focus:ring focus:ring-indigo-300" rows="4"
                                v-model="form.initial"></Textarea>
                        </TableCell>
                    </TableRow>

                    <TableRow>
                        <TableCell class="w-1/4 font-bold align-top">T/C (To Consider):</TableCell>
                        <TableCell>
                            <Textarea class="w-full border rounded px-2 py-1 focus:ring focus:ring-indigo-300" rows="4"
                                v-model="form.tc"></Textarea>
                        </TableCell>
                    </TableRow>

                    <TableRow>
                        <TableCell class="w-1/4 font-bold align-top">R/O (Rule Out):</TableCell>
                        <TableCell>
                            <Textarea class="w-full border rounded px-2 py-1 focus:ring focus:ring-indigo-300" rows="4"
                                v-model="form.ro"></Textarea>
                        </TableCell>
                    </TableRow>

                    <TableRow>
                        <TableCell class="w-1/4 font-bold align-top">Final Diagnosis:</TableCell>
                        <TableCell>
                            <Textarea class="w-full border rounded px-2 py-1 focus:ring focus:ring-indigo-300" rows="4"
                                v-model="form.final"></Textarea>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>


    </div>


    <!-- Submit Button -->
    <div class="flex justify-end mt-4">
        <Button @click.prevent="update()">
            Update
        </Button>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/Components/ui/table'
import { Input } from '@/Components/ui/input'
import { Label } from '@/Components/ui/label'
import { Button } from '@/components/ui/button'
import Textarea from '@/Components/ui/textarea/Textarea.vue';

const props = defineProps({
    patient: Object
})
const form = useForm({
    initial: props.patient?.diagnosis?.initial || '',
    tc: props.patient?.diagnosis?.tc || '',
    ro: props.patient?.diagnosis?.ro || '',
    final: props.patient?.diagnosis?.final || '',
})


const update = () => {
    form.put(route('diagnosis.update', props.patient?.diagnosis?.id))
}
</script>