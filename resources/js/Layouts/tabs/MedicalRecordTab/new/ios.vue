<template>
    <div class="p-4">
        <!-- Add Button -->
        <div class="mb-4">
            <button @click="openModal" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Add
            </button>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 border rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th v-for="header in tableHeaders" :key="header"
                            class="px-4 py-2 text-left text-sm font-medium text-gray-700">
                            {{ header }}
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <template v-for="(dateGroup, dateIndex) in groupedData" :key="dateIndex">
                        <template v-for="(shiftGroup, shiftIndex) in dateGroup.shiftGroups" :key="shiftIndex">
                            <!-- Template section with fix for the total and signature row -->
                            <!-- Instead of rendering the total row unconditionally, check if there are rows -->
                            <template v-for="(statusGroup, statusIndex) in shiftGroup.statusGroups" :key="statusIndex">
                                <!-- Display each time entry -->
                                <template v-for="(row, rowIndex) in statusGroup.rows" :key="rowIndex">
                                    <tr>
                                        <!-- Date - only show on first row of each date -->
                                        <td class="px-4 py-2 text-sm text-gray-700">
                                            <template v-if="rowIndex === 0 && statusIndex === 0 && shiftIndex === 0">
                                                {{ dateGroup.date }}
                                            </template>
                                        </td>

                                        <!-- Shift - only show on first row of each shift in a day -->
                                        <td class="px-4 py-2 text-sm text-gray-700">
                                            <template v-if="rowIndex === 0 && statusIndex === 0">
                                                {{ shiftGroup.shift }}
                                            </template>
                                        </td>

                                        <!-- Status - only show on first row of each status in a shift -->
                                        <td class="px-4 py-2 text-sm text-gray-700">
                                            <div class="flex items-center gap-2">
                                                <template v-if="rowIndex === 0">
                                                    {{ statusGroup.status }}
                                                </template>
                                                <template v-if="rowIndex === 0">
                                                    <button
                                                        @click="openEditModal(dateGroup.date, shiftGroup.shift, statusGroup.status)"
                                                        class="text-yellow-500 hover:text-yellow-600">
                                                        <!-- Pen icon (Heroicons pencil-square) -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15.232 5.232l3.536 3.536M16.732 3.732a2.5 2.5 0 113.536 3.536L7 20.5H3.5V17L16.732 3.732z" />
                                                        </svg>
                                                    </button>
                                                    <button
                                                        @click="deletegroup(dateGroup.date, shiftGroup.shift, statusGroup.status)"
                                                        class="text-red-500 hover:text-red-600 ml-2">
                                                        <!-- Trash icon (Heroicons trash) -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </template>
                                            </div>
                                        </td>

                                        <!-- Time - always show with edit button -->
                                        <td class="px-4 py-2 text-sm text-gray-700">
                                            <div class="flex items-center gap-2">
                                                {{ row.time }}
                                                <button
                                                    @click="openTimeEditModal(dateGroup.date, shiftGroup.shift, statusGroup.status, row.time, row.source, row.amount, row.timeId)"
                                                    class="text-blue-500 hover:text-blue-600">
                                                    <!-- Pen icon (Heroicons pencil-square) -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15.232 5.232l3.536 3.536M16.732 3.732a2.5 2.5 0 113.536 3.536L7 20.5H3.5V17L16.732 3.732z" />
                                                    </svg>
                                                </button>

                                                <button @click="deletetime(row.timeId)"
                                                    class="text-red-500 hover:text-red-600 ml-2">
                                                    <!-- Trash icon (Heroicons trash) -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>

                                        <!-- Always show source and amount -->
                                        <td class="px-4 py-2 text-sm text-gray-700">{{ row.source || '-' }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-700">{{ row.amount }}</td>

                                        <!-- No total and signature in regular rows -->
                                        <td class="px-4 py-2 text-sm text-gray-700"></td>
                                        <td class="px-4 py-2 text-sm text-gray-700"></td>
                                    </tr>
                                </template>

                                <!-- Add total and signature row at the end of each status group ONLY if there are rows -->
                                <tr v-if="statusGroup.rows && statusGroup.rows.length > 0" class="bg-gray-50">
                                    <td class="px-4 py-2 text-sm text-gray-700"></td>
                                    <td class="px-4 py-2 text-sm text-gray-700"></td>
                                    <td class="px-4 py-2 text-sm text-gray-700"></td>
                                    <td class="px-4 py-2 text-sm text-gray-700"></td>
                                    <td class="px-4 py-2 text-sm font-medium text-gray-700 text-right">
                                        Total:
                                    </td>
                                    <td class="px-4 py-2 text-sm font-bold text-gray-700">
                                        {{ statusGroup.total || '-' }}
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-700 text-right">
                                        Signature:
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-700">
                                        <template v-if="statusGroup.signature">
                                            <img :src="`/storage/${statusGroup.signature}`" alt="Signature"
                                                class="h-10 max-w-full" />
                                        </template>
                                        <template v-else>
                                            -
                                        </template>
                                    </td>
                                </tr>
                            </template>
                        </template>
                    </template>
                </tbody>
            </table>
        </div>

        <!-- Add Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md">
                <!-- Step 1 -->
                <div v-if="modalStep === 1">
                    <h2 class="text-lg font-bold mb-4">Step 1: Basic Info</h2>
                    <div class="mb-3">
                        <label class="block text-sm font-medium">Date</label>
                        <input type="date" v-model="form.date" class="w-full mt-1 px-3 py-2 border rounded-md" />
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium">Shift</label>
                        <select v-model="form.shift" class="w-full mt-1 px-3 py-2 border rounded-md">
                            <option value="" disabled>Select Shift</option>
                            <option>Morning</option>
                            <option>Afternoon</option>
                            <option>Night</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Status</label>
                        <select v-model="form.status" class="w-full mt-1 px-3 py-2 border rounded-md">
                            <option value="" disabled>Select Status</option>
                            <option>Intake</option>
                            <option>Output</option>
                        </select>
                    </div>
                    <div class="flex justify-between">
                        <button @click="closeModal"
                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                        <button @click="modalStep = 2"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Next</button>
                    </div>
                </div>

                <!-- Step 2 -->
                <div v-else-if="modalStep === 2">
                    <h2 class="text-lg font-bold mb-4">Step 2: Time and Details</h2>
                    <div class="mb-3">
                        <label class="block text-sm font-medium">Time</label>
                        <select v-model="form.time" class="w-full mt-1 px-3 py-2 border rounded-md">
                            <option value="" disabled>Select Time</option>
                            <option v-for="t in shiftTimes[form.shift] || []" :key="t">{{ t }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium">Amount</label>
                        <input type="text" v-model="form.amount" class="w-full mt-1 px-3 py-2 border rounded-md" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Source</label>
                        <input type="text" v-model="form.source" class="w-full mt-1 px-3 py-2 border rounded-md" />
                    </div>
                    <div class="flex justify-between">
                        <button @click="modalStep = 1"
                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Back</button>
                        <button @click="submitForm"
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Edit Modal -->
        <div v-if="showEditModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md">
                <h2 class="text-lg font-bold mb-4">Edit</h2>
                <div class="mb-3">
                    <label class="block text-sm font-medium">Total</label>
                    <input type="text" v-model="editForm.total" class="w-full mt-1 px-3 py-2 border rounded-md" />
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Signature</label>

                    <!-- Signature Image Preview (if exists) -->
                    <div v-if="signaturePreview" class="mt-2 mb-2">
                        <img :src="`/storage/${signaturePreview}`" alt="Signature Preview"
                            class="h-16 border rounded p-1" />
                    </div>

                    <!-- Signature File Upload -->
                    <div class="mt-1">
                        <label for="signature-upload" class="flex items-center justify-center w-full px-4 py-2 border border-gray-300 rounded-md 
                            cursor-pointer bg-white hover:bg-gray-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm">Upload Signature</span>
                        </label>
                        <input id="signature-upload" type="file" @change="handleSignatureUpload" accept="image/*"
                            class="hidden" />
                    </div>
                </div>

                <div class="flex justify-between">
                    <button @click="closeEditModal"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                    <button @click="submitEdit"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Save</button>
                </div>
            </div>
        </div>

        <!-- Time Edit Modal -->
        <div v-if="showTimeEditModal"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md">
                <h2 class="text-lg font-bold mb-4">Edit Time Entry</h2>
                <div class="mb-3">
                    <label class="block text-sm font-medium">Time</label>
                    <select v-model="timeEditForm.time" class="w-full mt-1 px-3 py-2 border rounded-md">
                        <option value="" disabled>Select Time</option>
                        <option v-for="t in shiftTimes[timeEditForm.shift] || []" :key="t">{{ t }}</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium">Amount</label>
                    <input type="text" v-model="timeEditForm.amount" class="w-full mt-1 px-3 py-2 border rounded-md" />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Source</label>
                    <input type="text" v-model="timeEditForm.source" class="w-full mt-1 px-3 py-2 border rounded-md" />
                </div>
                <div class="flex justify-between">
                    <button @click="closeTimeEditModal"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                    <button @click="submitTimeEdit"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Save</button>
                </div>
            </div>
        </div>

    </div>
</template>

<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { computed } from 'vue'

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

const deletegourpform = useForm()
const deletegroup = (date, shift, status) => {
    const io = sortedIos.value.find(io =>
        io.date === date &&
        io.shift === shift &&
        io.status === status
    );
    if (confirm('Are you sure you want to delete this?')) {
        deletegourpform.delete(route('ios.delete', io?.id))
    }
}

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
const deletetimeform = useForm()
const deletetime = (id) => {
    if (confirm('Are you sure you want to delete this time?')) {
        deletetimeform.delete(route('ios.deletetime', id))
    }
}
</script>