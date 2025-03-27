<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <div class="overflow-x-auto mt-4 border rounded-lg">
                            <Table>
                                <TableHeader class="bg-green-100">
                                    <TableRow>
                                        <TableHead>Medical Record</TableHead>
                                        <TableHead>Duration Limit (Days)</TableHead>
                                    </TableRow>
                                </TableHeader>

                                <TableBody>
                                    <TableRow>
                                        <TableCell>Imaging Reports</TableCell>
                                        <TableCell>
                                            <Input type="number" placeholder="Please Input in Days"
                                                v-model="form.imaging"
                                                />
                                        </TableCell>
                                    </TableRow>
                                    <TableRow>
                                        <TableCell>Laboratory Reports</TableCell>
                                        <TableCell>
                                            <Input type="number" placeholder="Please Input in Days"
                                                v-model="form.laboratory"
                                                />
                                        </TableCell>
                                    </TableRow>
                                    <TableRow>
                                        <TableCell>Histopath Reports</TableCell>
                                        <TableCell>
                                            <Input type="number" placeholder="Please Input in Days"
                                                v-model="form.histopath"
                                                />
                                        </TableCell>
                                    </TableRow>
                                    <TableRow>
                                        <TableCell>Microbiology Reports</TableCell>
                                        <TableCell>
                                            <Input type="number" placeholder="Please Input in Days"
                                                v-model="form.microbiology"
                                                />
                                        </TableCell>
                                    </TableRow>
                                    <TableRow>
                                        <TableCell>Special Test Reports</TableCell>
                                        <TableCell>
                                            <Input type="number" placeholder="Please Input in Days"
                                                v-model="form.specialtest"
                                                />
                                        </TableCell>
                                    </TableRow>
                                </TableBody>
                            </Table>

                            <div class="flex justify-end mt-4 mb-4">
                                <Button @click="updateConfig()" class="px-4 py-2 mx-2">
                                    Update
                                </Button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </AuthenticatedLayout>

</template>

<script setup>
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/Components/ui/table'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { route } from '../../../../../vendor/tightenco/ziggy/src/js';
import { useForm } from '@inertiajs/vue3';
import Button from '@/Components/ui/button/Button.vue';
import Input from '@/Components/ui/input/Input.vue';

const props = defineProps({
    config: Object
})

const form = useForm({
    imaging: props.config.imaging || '',
    laboratory: props.config.laboratory || '',
    histopath: props.config.histopath || '',
    microbiology: props.config.microbiology || '',
    specialtest: props.config.specialtest || '',
})

const updateConfig = () => {
    form.put(route('config.update', props.config.id));
}
</script>