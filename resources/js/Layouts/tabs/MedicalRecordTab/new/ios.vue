<template>
    <div class="bg-gray-50 p-4 rounded-lg">
        <!-- Add Button -->
        <h3 class="text-lg font-semibold mb-2">Intake/Output Sheet</h3>
        <div class="mb-4">
            <Button @click="openModal">
                + Add Intake/Output
            </Button>
        </div>

        <!-- Table -->
        <div class="grid gap-4 auto-rows-fr grid-cols-1 md:grid-cols-4">
            <div class="md:col-span-4 xl:col-span-4 flex flex-col h-full">
                <div class="overflow-x-auto mt-4 border rounded-lg">

                    <Table>
                        <TableHeader class="bg-green-100">
                            <TableRow>
                                <TableHead v-for="header in tableHeaders" :key="header">
                                    {{ header }}
                                </TableHead>
                            </TableRow>
                        </TableHeader>

                        <TableBody>
                            <template v-for="(dateGroup, dateIndex) in groupedData" :key="dateIndex">
                                <template v-for="(shiftGroup, shiftIndex) in dateGroup.shiftGroups" :key="shiftIndex">
                                    <template v-for="(statusGroup, statusIndex) in shiftGroup.statusGroups"
                                        :key="statusIndex">
                                        <template v-for="(row, rowIndex) in statusGroup.rows" :key="rowIndex">
                                            <TableRow>
                                                <!-- Date -->
                                                <TableCell>
                                                    <template
                                                        v-if="rowIndex === 0 && statusIndex === 0 && shiftIndex === 0">
                                                        {{ dateGroup.date }}
                                                    </template>
                                                </TableCell>

                                                <!-- Shift -->
                                                <TableCell>
                                                    <template v-if="rowIndex === 0 && statusIndex === 0">
                                                        {{ shiftGroup.shift }}
                                                    </template>
                                                </TableCell>

                                                <!-- Status + group action buttons -->
                                                <TableCell>
                                                    <template v-if="rowIndex === 0">
                                                        <div class="flex items-center gap-2">
                                                            {{ statusGroup.status }}
                                                            <button
                                                                @click="openEditModal(dateGroup.date, shiftGroup.shift, statusGroup.status)"
                                                                class="text-yellow-500 hover:text-yellow-600">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </button>
                                                            <button
                                                                @click="deletegroup(dateGroup.date, shiftGroup.shift, statusGroup.status)"
                                                                class="text-red-500 hover:text-red-600">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </template>
                                                </TableCell>

                                                <!-- Time with edit/delete -->
                                                <TableCell>
                                                    <div class="flex items-center gap-2">
                                                        {{ row.time }}
                                                        <button
                                                            @click="openTimeEditModal(dateGroup.date, shiftGroup.shift, statusGroup.status, row.time, row.source, row.amount, row.timeId)"
                                                            class="text-blue-500 hover:text-blue-600">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                        <button @click="deletetime(row.timeId)"
                                                            class="text-red-500 hover:text-red-600">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </TableCell>

                                                <!-- Source -->
                                                <TableCell>{{ row.source || '-' }}</TableCell>

                                                <!-- Amount -->
                                                <TableCell>{{ row.amount }}</TableCell>

                                                <!-- Total -->
                                                <TableCell></TableCell>

                                                <!-- Signature -->
                                                <TableCell></TableCell>
                                            </TableRow>
                                        </template>

                                        <!-- Total + Signature row -->
                                        <TableRow v-if="statusGroup.rows && statusGroup.rows.length > 0"
                                            class="bg-gray-50">
                                            <TableCell colspan="4"></TableCell>
                                            <TableCell class="text-right font-medium">Total:</TableCell>
                                            <TableCell class="font-bold">{{ statusGroup.total || '-' }}</TableCell>
                                            <TableCell class="text-right font-medium">Signature:</TableCell>
                                            <TableCell>
                                                <template v-if="statusGroup.signature">
                                                    <img :src="`/storage/${statusGroup.signature}`" alt="Signature"
                                                        class="h-10 max-w-full" />
                                                </template>
                                                <template v-else>-</template>
                                            </TableCell>
                                        </TableRow>
                                    </template>
                                </template>
                            </template>
                        </TableBody>
                    </Table>


                </div>
            </div>
        </div>

        <!-- Add Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md">
                <!-- Step 1 -->
                <div v-if="modalStep === 1">
                    <h2 class="text-lg font-bold mb-4">Step 1: Basic Info</h2>
                    <div class="mb-3">
                        <Label class="block text-sm font-medium">Date</Label>
                        <Input type="date" v-model="form.date" class="w-full mt-1 px-3 py-2 border rounded-md" />
                    </div>
                    <div class="mb-3">
                        <Label class="block text-sm font-medium mb-1">Shift</Label>
                        <Select v-model="form.shift">
                            <SelectTrigger class="w-full">
                                <SelectValue placeholder="Select Shift" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectGroup>
                                    <SelectLabel>Shifts</SelectLabel>
                                    <SelectItem value="Morning">Morning</SelectItem>
                                    <SelectItem value="Afternoon">Afternoon</SelectItem>
                                    <SelectItem value="Night">Night</SelectItem>
                                </SelectGroup>
                            </SelectContent>
                        </Select>
                    </div>

                    <div class="mb-4">
                        <Label class="block text-sm font-medium mb-1">Status</Label>
                        <Select v-model="form.status">
                            <SelectTrigger class="w-full">
                                <SelectValue placeholder="Select Status" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectGroup>
                                    <SelectLabel>Statuses</SelectLabel>
                                    <SelectItem value="Intake">Intake</SelectItem>
                                    <SelectItem value="Output">Output</SelectItem>
                                </SelectGroup>
                            </SelectContent>
                        </Select>
                    </div>
                    <div class="flex justify-end gap-2 mt-6">
                        <Button @click="closeModal" variant="outline">Cancel</button>
                        <Button @click="modalStep = 2">Next</button>
                    </div>
                </div>

                <!-- Step 2 -->
                <div v-else-if="modalStep === 2">
                    <h2 class="text-lg font-bold mb-4">Step 2: Time and Details</h2>
                    <div class="mb-3">
                        <Label class="block text-sm font-medium mb-1">Time</Label>
                        <Select v-model="form.time">
                            <SelectTrigger class="w-full mt-1">
                                <SelectValue placeholder="Select Time" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectGroup>
                                    <SelectLabel>Times</SelectLabel>
                                    <SelectItem v-for="t in shiftTimes[form.shift] || []" :key="t" :value="t">
                                        {{ t }}
                                    </SelectItem>
                                </SelectGroup>
                            </SelectContent>
                        </Select>
                    </div>
                    <div class="mb-3">
                        <Label class="block text-sm font-medium">Amount</Label>
                        <Input type="text" v-model="form.amount" class="w-full mt-1 px-3 py-2 border rounded-md" />
                    </div>
                    <div class="mb-4">
                        <Label class="block text-sm font-medium">Source</Label>
                        <Input type="text" v-model="form.source" class="w-full mt-1 px-3 py-2 border rounded-md" />
                    </div>
                    <div class="flex justify-end gap-2 mt-6">
                        <Button @click="modalStep = 1" variant="outline">Back</button>
                        <Button @click="submitForm">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Edit Modal -->
        <div v-if="showEditModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md">
                <h2 class="text-lg font-bold mb-4">Edit</h2>
                <div class="mb-3">
                    <Label class="block text-sm font-medium">Total</Label>
                    <Input type="text" v-model="editForm.total" class="w-full mt-1 px-3 py-2 border rounded-md" />
                </div>

                <div class="mb-4">
                    <Label class="block text-sm font-medium">Signature</Label>

                    <!-- Signature Image Preview (if exists) -->
                    <div v-if="signaturePreview" class="mt-2 mb-2">
                        <img :src="`/storage/${signaturePreview}`" alt="Signature Preview"
                            class="h-16 border rounded p-1" />
                    </div>

                    <!-- Signature File Upload -->
                    <div class="mt-1">
                        <Label for="signature-upload" class="flex items-center justify-center w-full px-4 py-2 border border-gray-300 rounded-md 
                            cursor-pointer bg-white hover:bg-gray-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm">Upload Signature</span>
                        </Label>
                        <Input id="signature-upload" type="file" @change="handleSignatureUpload" accept="image/*"
                            class="hidden" />
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-6">
                    <Button @click="closeEditModal"
                       variant="outline">Cancel</Button>
                    <Button @click="submitEdit"
                        >Save</Button>
                </div>
            </div>
        </div>

        <!-- Time Edit Modal -->
        <div v-if="showTimeEditModal"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md">
                <h2 class="text-lg font-bold mb-4">Edit Time Entry</h2>
                <div class="mb-3">
                    <Label class="block text-sm mb-1">Time</Label>
                    <Select v-model="timeEditForm.time">
                        <SelectTrigger class="w-full mt-1">
                            <SelectValue placeholder="Select Time" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectGroup>
                                <SelectLabel>Times</SelectLabel>
                                <SelectItem v-for="t in shiftTimes[timeEditForm.shift] || []" :key="t" :value="t">
                                    {{ t }}
                                </SelectItem>
                            </SelectGroup>
                        </SelectContent>
                    </Select>
                </div>
                <div class="mb-3">
                    <Label class="block text-sm font-medium">Amount</Label>
                    <Input type="text" v-model="timeEditForm.amount" class="w-full mt-1 px-3 py-2 border rounded-md" />
                </div>
                <div class="mb-4">
                    <Label class="block text-sm font-medium">Source</Label>
                    <Input type="text" v-model="timeEditForm.source" class="w-full mt-1 px-3 py-2 border rounded-md" />
                </div>



                <div class="flex justify-end gap-2 mt-6">

                    <Button variant="outline" @click="closeTimeEditModal">Cancel</Button>
                    <Button @click="submitTimeEdit">Save</Button>
                </div>
            </div>
        </div>

        <AlertDialog v-model:open="showDeleteDialog">
            <AlertDialogContent>
                <AlertDialogHeader>
                    <AlertDialogTitle>
                        <template v-if="deleteTarget?.type === 'group'">
                            Delete Intake/Output Group?
                        </template>
                        <template v-else-if="deleteTarget?.type === 'time'">
                            Delete Time Entry?
                        </template>
                        <template v-else>
                            Confirm Delete
                        </template>
                    </AlertDialogTitle>
                    <AlertDialogDescription>
                        <template v-if="deleteTarget?.type === 'group'">
                            This will permanently delete the <strong>{{ deleteTarget.description }}</strong>. This
                            includes all related time entries.
                        </template>
                        <template v-else-if="deleteTarget?.type === 'time'">
                            This will permanently delete <strong>{{ deleteTarget.description }}</strong>.
                        </template>
                        <template v-else>
                            This action cannot be undone.
                        </template>
                    </AlertDialogDescription>
                </AlertDialogHeader>
                <AlertDialogFooter>
                    <AlertDialogCancel @click="showDeleteDialog = false">Cancel</AlertDialogCancel>
                    <AlertDialogAction class="bg-red-600 hover:bg-red-700" @click="handleDelete">
                        Delete
                    </AlertDialogAction>
                </AlertDialogFooter>
            </AlertDialogContent>
        </AlertDialog>



    </div>
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


const showModal = ref(false)
const modalStep = ref(1)

const props = defineProps({
    patient: Object
})
const form = useForm({
    date: '',
    shift: '',
    status: '',
    time: '',
    amount: '',
    source: '',
})

// Static table headers
const tableHeaders = [
    'Date', 'Shift', 'Status', 'Time', 'Source', 'Amount', '', ''
]

// Shift-specific time slots
const shiftTimes = {
    Morning: [
        '06:00 AM - 07:00 AM',
        '07:00 AM - 08:00 AM',
        '08:00 AM - 09:00 AM',
        '09:00 AM - 10:00 AM',
        '11:00 AM - 12:00 PM',
        '12:00 PM - 01:00 PM',
        '01:00 PM - 02:00 PM',
    ],
    Afternoon: [
        '02:00 PM - 03:00 PM',
        '03:00 PM - 04:00 PM',
        '04:00 PM - 05:00 PM',
        '05:00 PM - 06:00 PM',
        '06:00 PM - 07:00 PM',
        '07:00 PM - 08:00 PM',
        '08:00 PM - 09:00 PM',
        '09:00 PM - 10:00 PM',
    ],
    Night: [
        '10:00 PM - 11:00 PM',
        '11:00 PM - 12:00 AM',
        '12:00 AM - 01:00 AM',
        '01:00 AM - 02:00 AM',
        '02:00 AM - 03:00 AM',
        '03:00 AM - 04:00 AM',
        '04:00 AM - 05:00 AM',
        '05:00 AM - 06:00 AM',
    ],
}

// For signature image preview
const signaturePreview = ref(null)

const shiftOrder = { Morning: 1, Afternoon: 2, Night: 3 }
const statusOrder = { Intake: 1, Output: 2 }

// First sort the ios entries
const sortedIos = computed(() => {
    return [...(props.patient.ios || [])]
        .sort((a, b) => {
            // Date
            if (a.date !== b.date) return new Date(a.date) - new Date(b.date)
            // Shift
            if (shiftOrder[a.shift] !== shiftOrder[b.shift]) return shiftOrder[a.shift] - shiftOrder[b.shift]
            // Status
            return statusOrder[a.status] - statusOrder[b.status]
        })
        .map(io => ({
            ...io,
            iostimes: [...(io.iostimes || [])].sort((a, b) => {
                // Extract start time in 24hr to sort
                const getStartHour = timeStr => {
                    const [time] = timeStr.split(' - ')
                    const [h, mer] = time.split(/[: ]/)
                    let hour = parseInt(h)
                    if (mer === 'PM' && hour !== 12) hour += 12
                    if (mer === 'AM' && hour === 12) hour = 0
                    return hour
                }
                return getStartHour(a.time) - getStartHour(b.time)
            })
        }))
})

// Redesigned groupedData to have a clear hierarchical structure: date > shift > status > rows
const groupedData = computed(() => {
    const result = [];

    // Temporary storage to build the hierarchy
    const dateMap = new Map();

    // First pass: group by date, shift, and status
    sortedIos.value.forEach(io => {
        const { date, shift, status, total, signature, iostimes } = io;

        // Create or get date group
        if (!dateMap.has(date)) {
            dateMap.set(date, {
                date,
                shiftGroups: new Map()
            });
        }
        const dateGroup = dateMap.get(date);

        // Create or get shift group
        if (!dateGroup.shiftGroups.has(shift)) {
            dateGroup.shiftGroups.set(shift, {
                shift,
                statusGroups: new Map()
            });
        }
        const shiftGroup = dateGroup.shiftGroups.get(shift);

        // Create or get status group
        if (!shiftGroup.statusGroups.has(status)) {
            shiftGroup.statusGroups.set(status, {
                status,
                total,
                signature,
                rows: []
            });
        }
        const statusGroup = shiftGroup.statusGroups.get(status);

        // Add time entries as rows
        iostimes.forEach(timeEntry => {
            statusGroup.rows.push({
                time: timeEntry.time,
                source: timeEntry.source,
                amount: timeEntry.amount,
                timeId: timeEntry.id
            });
        });
    });

    // Convert Map structure to arrays for template rendering
    dateMap.forEach((dateGroup, dateKey) => {
        const formattedDateGroup = {
            date: dateKey,
            shiftGroups: []
        };

        dateGroup.shiftGroups.forEach((shiftGroup, shiftKey) => {
            const formattedShiftGroup = {
                shift: shiftKey,
                statusGroups: []
            };

            shiftGroup.statusGroups.forEach((statusGroup, statusKey) => {
                formattedShiftGroup.statusGroups.push({
                    status: statusKey,
                    total: statusGroup.total,
                    signature: statusGroup.signature,
                    rows: statusGroup.rows
                });
            });

            // Sort status groups (Intake, then Output)
            formattedShiftGroup.statusGroups.sort((a, b) =>
                statusOrder[a.status] - statusOrder[b.status]
            );

            formattedDateGroup.shiftGroups.push(formattedShiftGroup);
        });

        // Sort shift groups (Morning, Afternoon, Night)
        formattedDateGroup.shiftGroups.sort((a, b) =>
            shiftOrder[a.shift] - shiftOrder[b.shift]
        );

        result.push(formattedDateGroup);
    });

    // Sort by date
    result.sort((a, b) => new Date(a.date) - new Date(b.date));

    return result;
})

// Modal controls
const openModal = () => {
    form.reset()
    modalStep.value = 1
    showModal.value = true
}

const closeModal = () => {
    showModal.value = false
}

// Submit handler
const submitForm = () => {
    form.post(route('ios.store', props.patient?.id), {
        preserveScroll: true,
        onSuccess: () => {
            closeModal()
        },
    })
}

// Status Edit Modal
const showEditModal = ref(false)
const editForm = useForm({
    total: '',
    signature: null,
})



const openEditModal = (date, shift, status) => {
    // Find the IO entry with matching date, shift, and status
    const io = sortedIos.value.find(io =>
        io.date === date &&
        io.shift === shift &&
        io.status === status
    );

    // Prefill form
    editForm.date = date;
    editForm.shift = shift;
    editForm.status = status;
    editForm.id = io?.id || ''; // Get the ID from the found IO entry

    console.log('Editing IO with ID:', editForm.id);

    // Lookup total
    if (io) {
        editForm.total = io.total || '';
        // Set signature preview if it exists
        signaturePreview.value = io.signature || null;
    } else {
        signaturePreview.value = null;
    }

    showEditModal.value = true;
}

const closeEditModal = () => {
    showEditModal.value = false;
    // Reset signature preview
    signaturePreview.value = null;
}

const handleSignatureUpload = (event) => {
    const file = event.target.files[0];
    if (!file) return;

    // Validate file is an image
    if (!file.type.match('image.*')) {
        alert('Please select an image file');
        return;
    }

    // Create a preview
    const reader = new FileReader();
    reader.onload = (e) => {
        signaturePreview.value = e.target.result;
    };
    reader.readAsDataURL(file);

    // Set the file in the form
    editForm.signature = file;
}

const removeSignature = () => {
    signaturePreview.value = null;
    editForm.signature = null;
    // Reset the file input
    document.getElementById('signature-upload').value = '';
}

const submitEdit = () => {
    // Use FormData to handle file upload
    const formData = new FormData();
    formData.append('id', editForm.id);
    formData.append('total', editForm.total);

    // Only append signature if it exists
    if (editForm.signature) {
        formData.append('signature', editForm.signature);
    }

    // If signature was removed (preview is null but we had a previous signature)
    if (!signaturePreview.value) {
        formData.append('remove_signature', true);
    }

    // Submit using Inertia's post method with formData
    editForm.post(route('ios.updateStatus', {
        id: editForm.id
    }), {
        data: formData,
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => closeEditModal(),
    })
}

// Time Edit Modal and functionality
const showTimeEditModal = ref(false)
const timeEditForm = useForm({
    id: '',
    ios_Id: '',
    time: '',
    source: '',
    amount: '',
    shift: '', // Needed to get available time slots
})

const openTimeEditModal = (date, shift, status, time, source, amount, timeId) => {
    // Find the IO entry
    const io = sortedIos.value.find(io =>
        io.date === date &&
        io.shift === shift &&
        io.status === status
    );

    // Prefill the form
    timeEditForm.id = timeId || '';
    timeEditForm.ios_Id = io?.id || '';
    timeEditForm.time = time;
    timeEditForm.source = source || '';
    timeEditForm.amount = amount;
    timeEditForm.shift = shift; // Store shift to filter time options

    showTimeEditModal.value = true;
}

const closeTimeEditModal = () => {
    showTimeEditModal.value = false;
}

const submitTimeEdit = () => {
    timeEditForm.post(route('ios.updatetime', {
        id: timeEditForm.id
    }), {
        preserveScroll: true,
        onSuccess: () => {
            closeTimeEditModal();
        },
    });
}


const showDeleteDialog = ref(false)
const deleteTarget = ref({
    type: '', // 'group' | 'time'
    id: null,
    description: '' // Optional: Used for clearer dialog messaging
})


const deletegroup = (date, shift, status) => {
    const io = sortedIos.value.find(io =>
        io.date === date &&
        io.shift === shift &&
        io.status === status
    )
    if (io?.id) {
        deleteTarget.value = {
            type: 'group',
            id: io.id,
            description: `${status} group for ${shift} shift on ${date}`
        }
        showDeleteDialog.value = true
    }
}

const deletetime = (id) => {
    // Ideally: find the entry details using the id to construct a description
    deleteTarget.value = {
        type: 'time',
        id,
        description: `this time entry`
    }
    showDeleteDialog.value = true
}


const deletegourpform = useForm()
const deletetimeform = useForm()

const handleDelete = () => {
    if (!deleteTarget.value) return

    if (deleteTarget.value.type === 'group') {
        deletegourpform.delete(route('ios.delete', deleteTarget.value.id), {
            preserveScroll: true,
            onSuccess: () => {
                showDeleteDialog.value = false
                deleteTarget.value = null
            }
        })
    }

    if (deleteTarget.value.type === 'time') {
        deletetimeform.delete(route('ios.deletetime', deleteTarget.value.id), {
            preserveScroll: true,
            onSuccess: () => {
                showDeleteDialog.value = false
                deleteTarget.value = null
            }
        })
    }
}


</script>