<template>
    <!-- Add Button -->
    <div class="bg-gray-50 p-4 rounded-lg">
        <h3 class="text-lg font-semibold mb-2">Vital Signs/TPR</h3>

        <Button @click="openCreateModal" class="px-4 py-2 text-white rounde transition">
            + Add Vital Signs
        </Button>



        <!-- Table -->
        <div class="grid gap-4 auto-rows-fr grid-cols-1 md:grid-cols-4">
            <div class="md:col-span-4 xl:col-span-4 flex flex-col h-full">
                <div class="overflow-x-auto mt-4 border rounded-lg">
                    <Table>
                        <TableHeader class="bg-green-100">
                            <TableRow>
                                <TableHead>Date</TableHead>
                                <TableHead>Time</TableHead>
                                <TableHead>Temperature</TableHead>
                                <TableHead>Blood Pressure</TableHead>
                                <TableHead>Respiratory Rate</TableHead>
                                <TableHead>Pulse Rate</TableHead>
                                <TableHead>Oxygen Saturation</TableHead>
                                <TableHead>Actions</TableHead>
                            </TableRow>
                        </TableHeader>

                        <TableBody>
                            <TableRow v-if="sortedTprs.length === 0">
                                <TableCell colspan="8" class="text-center text-gray-500">
                                    No allergy records found.
                                </TableCell>
                            </TableRow>
                            <TableRow v-for="(tpr, index) in sortedTprs" :key="tpr.id">
                                <TableCell>
                                    <span v-if="index === 0 || tpr.date !== sortedTprs[index - 1].date">{{ tpr.date
                                    }}</span>
                                </TableCell>
                                <TableCell>{{ tpr.time }}</TableCell>
                                <TableCell>{{ tpr.temp }}</TableCell>
                                <TableCell>{{ tpr.bp }}</TableCell>
                                <TableCell>{{ tpr.rr }}</TableCell>
                                <TableCell>{{ tpr.pr }}</TableCell>
                                <TableCell>{{ tpr.os }}</TableCell>
                                <TableCell class="text-center">
                                    <DropdownMenu>
                                        <DropdownMenuTrigger as-child>
                                            <Button variant="ghost" class="flex h-8 w-8 p-0 data-[state=open]:bg-muted">
                                                <i class="fa-solid fa-ellipsis"></i>
                                                <span class="sr-only">Open menu</span>
                                            </Button>
                                        </DropdownMenuTrigger>
                                        <DropdownMenuContent align="end" class="w-[160px]">
                                            <DropdownMenuItem @click="editTpr(tpr)">
                                                <i class="fa-solid fa-pen-to-square mr-2"></i> Edit
                                            </DropdownMenuItem>
                                            <DropdownMenuItem @click="deleteTpr(tpr.id)">
                                                <i class="fa-solid fa-trash mr-2"></i> Delete
                                            </DropdownMenuItem>
                                        </DropdownMenuContent>
                                    </DropdownMenu>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg w-full max-w-md">
            <h2 class="text-lg font-semibold mb-4">Add Vital Signs</h2>
            <form @submit.prevent="submit">
                <div class="space-y-3">
                    <div>
                        <Label class="block text-sm">Date</Label>
                        <Input type="date" v-model="form.date" required />
                    </div>

                    <div>
                        <Label class="block text-sm mb-1">Time</Label>
                        <Select v-model="form.time">
                            <SelectTrigger>
                                <SelectValue placeholder="Select Time" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectGroup>
                                    <SelectLabel>Times</SelectLabel>
                                    <SelectItem value="12:00 AM">12:00 AM</SelectItem>
                                    <SelectItem value="4:00 AM">4:00 AM</SelectItem>
                                    <SelectItem value="8:00 AM">8:00 AM</SelectItem>
                                    <SelectItem value="12:00 PM">12:00 PM</SelectItem>
                                    <SelectItem value="4:00 PM">4:00 PM</SelectItem>
                                    <SelectItem value="8:00 PM">8:00 PM</SelectItem>
                                </SelectGroup>
                            </SelectContent>
                        </Select>
                    </div>

                    <div>
                        <Label class="block text-sm">Temperature</Label>
                        <Input type="text" v-model="form.temp" required />
                    </div>
                    <div>
                        <Label class="block text-sm">Blood Pressure</Label>
                        <Input type="text" v-model="form.bp" required />
                    </div>
                    <div>
                        <Label class="block text-sm">Respiratory Rate</Label>
                        <Input type="text" v-model="form.rr" required />
                    </div>
                    <div>
                        <Label class="block text-sm">Pulse Rate</Label>
                        <Input type="text" v-model="form.pr" required />
                    </div>
                    <div>
                        <Label class="block text-sm">Oxygen Saturation</Label>
                        <Input type="text" v-model="form.os" required />
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-6">
                    <Button type="button" @click="closeModal" variant="outline">
                        Cancel
                    </Button>
                    <Button type="submit" class="px-4 py-2 text-white rounde">
                        Save
                    </Button>
                </div>
            </form>
        </div>
    </div>

    <AlertDialog v-model:open="showDeleteDialog">
        <AlertDialogContent>
            <AlertDialogHeader>
                <AlertDialogTitle>Are you absolutely sure?</AlertDialogTitle>
                <AlertDialogDescription>
                    This will permanently delete this vital signs record.
                </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
                <AlertDialogCancel @click="showDeleteDialog = false">
                    Cancel
                </AlertDialogCancel>
                <AlertDialogAction class="bg-red-600 hover:bg-red-700" @click="handleDelete">
                    Delete
                </AlertDialogAction>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>

</template>

<script setup>
import { ref, computed } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { Input } from '@/Components/ui/input'
import { Label } from '@/Components/ui/label'
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from '@/Components/ui/select'
import Textarea from '@/Components/ui/textarea/Textarea.vue';
import Button from '@/components/ui/button/Button.vue';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuSeparator,
    DropdownMenuShortcut,
    DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu'
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/Components/ui/table'
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '@/Components/ui/alert-dialog'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/Components/ui/dialog'
import {
    Drawer,
    DrawerClose,
    DrawerContent,
    DrawerDescription,
    DrawerFooter,
    DrawerHeader,
    DrawerTitle,
    DrawerTrigger,
} from '@/Components/ui/drawer'

const props = defineProps({
    patient: Object
})

const showModal = ref(false)
const modalMode = ref('create') // 'create' or 'edit'
const editingId = ref(null)

const openCreateModal = () => {
    form.reset()
    modalMode.value = 'create'
    editingId.value = null
    showModal.value = true
}

const closeModal = () => {
    form.reset()
    showModal.value = false
    modalMode.value = 'create'
    editingId.value = null
}

// Create a computed property to sort TPRs by date and then by time
const sortedTprs = computed(() => {
    if (!props.patient?.tprs) return []

    // Clone the array to avoid modifying the original data
    return [...props.patient.tprs].sort((a, b) => {
        // First sort by date
        const dateComparison = new Date(a.date) - new Date(b.date)

        // If dates are the same, sort by time
        if (dateComparison === 0) {
            // Convert times to comparable values (e.g., minutes since midnight)
            const timeToMinutes = (timeStr) => {
                const [time, period] = timeStr.split(' ')
                const [hours, minutes] = time.split(':').map(Number)

                // Convert to 24-hour format for comparison
                let totalMinutes = hours * 60 + minutes
                if (period === 'PM' && hours < 12) totalMinutes += 12 * 60
                if (period === 'AM' && hours === 12) totalMinutes = minutes // 12 AM is 0 hours

                return totalMinutes
            }

            return timeToMinutes(a.time) - timeToMinutes(b.time)
        }

        return dateComparison
    })
})

const form = useForm({
    patient_Id: props.patient.id,
    date: '',
    time: '',
    temp: '',
    bp: '',
    rr: '',
    pr: '',
    os: ''
})

const editTpr = (tpr) => {
    modalMode.value = 'edit'
    editingId.value = tpr.id
    showModal.value = true
    form.date = tpr.date
    form.time = tpr.time
    form.temp = tpr.temp
    form.bp = tpr.bp
    form.rr = tpr.rr
    form.pr = tpr.pr
    form.os = tpr.os
}

const submit = () => {
    if (modalMode.value === 'edit') {
        form.put(route('tprs.update', editingId.value), {
            preserveScroll: true,
            onSuccess: () => {
                showModal.value = false
                form.reset()
                modalMode.value = 'create'
                editingId.value = null
            }
        })
    } else {
        form.post(route('tprs.store', props.patient?.id), {
            preserveScroll: true,
            onSuccess: () => {
                showModal.value = false
                form.reset()
            }
        })
    }
}

const deleteform = useForm()

const deleteTpr = (id) => {
    selectedDeleteId.value = id
    showDeleteDialog.value = true
}

const handleDelete = () => {
    if (selectedDeleteId.value) {
        deleteform.delete(route('tprs.delete', selectedDeleteId.value), {
            preserveScroll: true,
            onSuccess: () => {
                showDeleteDialog.value = false
                selectedDeleteId.value = null
            }
        })
    }
}

const showDeleteDialog = ref(false)
const selectedDeleteId = ref(null)
</script>