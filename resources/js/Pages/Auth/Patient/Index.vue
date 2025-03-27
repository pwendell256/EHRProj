<template>

    <Head title="Patient Management" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Patient Management
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <!-- Search Input -->
                        <div class="mb-4">
                            <input type="text" placeholder="Search by name..." v-model="searchform.name"
                                class="w-full p-2 border rounded-lg focus:ring focus:ring-indigo-300" />
                            <select class="w-full p-2 mb-2 my-2 border rounded-lg focus:ring focus:ring-indigo-300"
                                v-model="searchform.station">
                                <option value="">Select Station</option>
                                <option value="ICU - 502">ICU - 502</option>
                                <option value="CCU - 609">CCU - 609</option>
                                <option value="ER - 102">ER - 102</option>
                                <option value="PICU - 703">PICU - 703</option>
                                <option value="ICU - 504">ICU - 504</option>
                                <option value="LDRP - 306">LDRP - 306</option>
                                <option value="CCU - 603">CCU - 603</option>
                                <option value="PICU - 702">PICU - 702</option>
                                <option value="PACU - 404">PACU - 404</option>
                                <option value="General Medical Ward - Bed No. 6">General Medical Ward - Bed No. 6
                                </option>
                            </select>
                            <button @click="searchPatients"
                                class="px-4 py-2 my-4  text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                                Search
                            </button>
                        </div>



                        <!-- Add Patient Button -->
                        <Button @click="openModal()"
                            class="px-4 py-2 my-4 text-base ">
                            + Add Patient
                        </Button>

                        <!-- Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-gray-600">ID</th>
                                        <th class="px-4 py-2 text-left text-gray-600">Name</th>
                                        <th class="px-4 py-2 text-left text-gray-600">Birthdate</th>
                                        <th class="px-4 py-2 text-left text-gray-600">Gender</th>
                                        <th class="px-4 py-2 text-left text-gray-600">Age</th>
                                        <th class="px-4 py-2 text-left text-gray-600">Admission No.</th>
                                        <th class="px-4 py-2 text-left text-gray-600">Date Time</th>
                                        <th class="px-4 py-2 text-left text-gray-600">Room No.</th>
                                        <th class="px-4 py-2 text-left text-gray-600">Station</th>
                                        <th class="px-4 py-2 text-left text-gray-600">Status</th>
                                        <th class="px-4 py-2 text-left text-gray-600">Condition</th>
                                        <th class="px-4 py-2 text-left text-gray-600">View</th>
                                        <th class="px-4 py-2 text-left text-gray-600">Edit</th>
                                        <th class="px-4 py-2 text-left text-gray-600">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="hover:bg-gray-50" v-for="patient in patients" :key="patient.id">
                                        <td class="px-4 py-2 border">{{ patient.id }}</td>
                                        <td class="px-4 py-2 border">{{ patient.full_name }}</td>
                                        <td class="px-4 py-2 border">{{ patient.birth_date }}</td>
                                        <td class="px-4 py-2 border">{{ patient.age }}</td>
                                        <td class="px-4 py-2 border">{{ patient.gender }}</td>
                                        <td class="px-4 py-2 border">{{ patient.admission_no }}</td>
                                        <td class="px-4 py-2 border">{{ patient.admission_datetime }}</td>
                                        <td class="px-4 py-2 border">{{ patient.room_no }}</td>
                                        <td class="px-4 py-2 border">{{ patient.station }}</td>
                                        <td class="px-4 py-2 border">{{ patient.status }}</td>
                                        <td class="px-4 py-2 border">{{ patient.condition }}</td>
                                        <td class="px-4 py-2 border">
                                            <Link :href="route('patient.show', patient.id)">
                                            <button
                                                class="px-2 py-1 text-white bg-green-500 rounded hover:bg-green-600">
                                                View
                                            </button></Link>

                                        </td>
                                        <td class="px-4 py-2 border">
                                            <button @click="openModal(patient)"
                                                class="px-2 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">
                                                Edit
                                            </button>
                                        </td>
                                        <td class="px-4 py-2 border">
                                            <button @click.prevent="deletePatient(patient.id)"
                                                class="px-2 py-1 text-white bg-red-500 rounded hover:bg-red-600">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <!-- Modal -->
    <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="w-full max-w-lg p-6 bg-white rounded-lg shadow-lg">
            <h2 class="mb-4 text-lg font-semibold">
                {{ isEditing ? 'Edit Patient' : 'Add New Patient' }}
            </h2>

            <!-- Full Name -->
            <input v-model="form.full_name" type="text" placeholder="Full Name"
                class="w-full p-2 mb-2 border rounded-lg focus:ring focus:ring-indigo-300" />

            <!-- Birthdate -->
            <input v-model="form.birth_date" type="date" placeholder="Birthdate"
                class="w-full p-2 mb-2 border rounded-lg focus:ring focus:ring-indigo-300" />

            <!-- Gender -->
            <input v-model="form.gender" type="text" placeholder="Gender"
                class="w-full p-2 mb-2 border rounded-lg focus:ring focus:ring-indigo-300" />

            <!-- Admission No. -->
            <input v-model="form.admission_no" type="text" placeholder="Admission No."
                class="w-full p-2 mb-2 border rounded-lg focus:ring focus:ring-indigo-300" />

            <!-- Admission DateTime -->
            <input v-model="form.admission_datetime" type="datetime-local" placeholder="Date Time"
                class="w-full p-2 mb-2 border rounded-lg focus:ring focus:ring-indigo-300" />

            <!-- Room No. -->
            <input v-model="form.room_no" type="text" placeholder="Room No."
                class="w-full p-2 mb-2 border rounded-lg focus:ring focus:ring-indigo-300" />

            <!-- Station -->
            <select v-model="form.station" class="w-full p-2 mb-2 border rounded-lg focus:ring focus:ring-indigo-300">
                <option value="">Select Station</option>
                <option value="ICU - 502">ICU - 502</option>
                <option value="CCU - 609">CCU - 609</option>
                <option value="ER - 102">ER - 102</option>
                <option value="PICU - 703">PICU - 703</option>
                <option value="ICU - 504">ICU - 504</option>
                <option value="LDRP - 306">LDRP - 306</option>
                <option value="CCU - 603">CCU - 603</option>
                <option value="PICU - 702">PICU - 702</option>
                <option value="PACU - 404">PACU - 404</option>
                <option value="General Medical Ward - Bed No. 6">General Medical Ward - Bed No. 6</option>
            </select>

            <!-- Status -->
            <input v-model="form.status" type="text" placeholder="Status"
                class="w-full p-2 mb-2 border rounded-lg focus:ring focus:ring-indigo-300" />

            <!-- Condition -->
            <input v-model="form.condition" type="text" placeholder="Condition"
                class="w-full p-4 mb-2 border rounded-lg focus:ring focus:ring-indigo-300" />

            <!-- Buttons -->
            <div class="flex justify-end gap-2">
                <button @click="closeModal" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">
                    Cancel
                </button>
                <button @click="submit" class="px-4 py-2 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                    {{ isEditing ? 'Update' : 'Save' }}
                </button>
            </div>
        </div>
    </div>

</template>

<script setup>
import { ref, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router, useForm, usePage } from '@inertiajs/vue3';
import Button from '@/Components/ui/button/Button.vue';
import {Link} from '@inertiajs/vue3';

const props = defineProps({
    patients: Array,
});

const showModal = ref(false);
const isEditing = ref(false);
const selectedPatient = ref(null);

const openModal = (patient = null) => {
    isEditing.value = !!patient;
    selectedPatient.value = patient;

    if (patient) {
        form.full_name = patient.full_name;
        form.birth_date = patient.birth_date;
        form.gender = patient.gender;
        form.admission_no = patient.admission_no;
        form.admission_datetime = patient.admission_datetime;
        form.room_no = patient.room_no;
        form.station = patient.station;
        form.status = patient.status;
        form.condition = patient.condition;
    } else {
        form.reset();
    }

    showModal.value = true;
};


const closeModal = () => {
    showModal.value = false;
};

const searchform = useForm({
    name: '',
    station: '',
})

const page = usePage();
onMounted(() => {
    const urlParams = new URLSearchParams(window.location.search);

    searchform.name = urlParams.get('name') || '';
    searchform.station = urlParams.get('station') || '';
});

const searchPatients = () => {
    router.get(route('patient.index'), {
        name: searchform.name,
        station: searchform.station
    })
}

const form = useForm({
    full_name: '',
    birth_date: '',
    gender: '',
    admission_no: '',
    admission_datetime: '',
    room_no: '',
    station: '',
    status: '',
    condition: '',
});

const submit = () => {
    if (isEditing.value) {
        form.put(route('patient.update', selectedPatient.value.id), { onSuccess: closeModal });
    } else {
        form.post(route('patient.store'), { onSuccess: closeModal });
    }
};

const deleteform = useForm({})
const deletePatient = (id) => {
    if (confirm("Are you sure you want to delete this Patient?")) {
        deleteform.delete(route('patient.destroy', id))
    }
}
</script>
