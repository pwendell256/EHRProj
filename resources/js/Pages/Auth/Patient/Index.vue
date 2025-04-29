<template>

    <Head title="Patient Management" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Patient Management
            </h2>
        </template>

        <div class="py-12">

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">




                    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                        <!-- Left side: Search + Station + Search Button -->
                        <div class="flex flex-wrap items-center gap-4 flex-1">
                            <!-- Search Input -->
                            <Input type="text" placeholder="Search by name..." v-model="searchform.name"
                                class="w-[200px]" />

                            <!-- Station Select -->
                            <Select v-model="searchform.station">
                                <SelectTrigger class="w-[200px]">
                                    <SelectValue placeholder="Select Station" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectLabel>Stations</SelectLabel>
                                        <SelectItem value="All">All</SelectItem>
                                        <SelectItem value="ER">ER – Emergency Room</SelectItem>
                                        <SelectItem value="ICU">ICU – Intensive Care Unit</SelectItem>
                                        <SelectItem value="Med-Surg">Med-Surg – Medical-Surgical Ward</SelectItem>
                                        <SelectItem value="NICU">NICU – Neonatal Intensive Care Unit</SelectItem>
                                        <SelectItem value="Nursery Ward">Nursery Ward</SelectItem>
                                        <SelectItem value="OPD">Outpatient Department (OPD) – Scheduled consults and
                                            follow-ups
                                        </SelectItem>
                                        <SelectItem value="PICU">PICU – Pediatric Intensive Care Unit</SelectItem>
                                        <SelectItem value="Pediatric Oncology Unit">Pediatric Oncology Unit</SelectItem>
                                        <SelectItem value="Pediatric Rehab Unit">Pediatric Rehab Unit</SelectItem>
                                        <SelectItem value="Pediatric Ward">Pediatric Ward</SelectItem>
                                        <SelectItem value="Trauma ICU">Trauma ICU – Trauma-related critical care
                                        </SelectItem>
                                        <SelectItem value="Transplant ICU">Transplant ICU – Post-transplant care
                                        </SelectItem>
                                    </SelectGroup>

                                </SelectContent>
                            </Select>

                            <!-- Search Button -->
                            <Button @click="searchPatients">
                                Search
                            </Button>
                        </div>

                        <UseTemplate>
                            <form @submit.prevent="submit" class="grid gap-4 px-4">
                                <!-- 2-column form layout -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="flex flex-col gap-2">
                                        <Label for="full_name">Full Name</Label>
                                        <Input id="full_name" v-model="form.full_name" type="text" />
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <Label for="birth_date">Birthdate</Label>
                                        <Input id="birth_date" v-model="form.birth_date" type="date" />
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <Label for="birth_date">Birthplace</Label>
                                        <Input id="birth_date" v-model="form.birth_place" type="text" />
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <Label for="gender">Gender</Label>
                                        <Input id="gender" v-model="form.gender" type="text" />
                                    </div>

                                    <div class="flex flex-col gap-2 col-span-2">
                                        <Label for="admission_no">Admission No.</Label>
                                        <Input id="admission_no" v-model="form.admission_no" type="text" />
                                    </div>

                                    <div class="flex flex-col gap-2 col-span-2">
                                        <Label for="admission_datetime">Admission Date/Time</Label>
                                        <Input id="admission_datetime" v-model="form.admission_datetime"
                                            type="datetime-local" />
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <Label for="room_no">Room No.</Label>
                                        <Input id="room_no" v-model="form.room_no" type="text" />
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <Label for="room_no">Station</Label>
                                        <Select v-model="form.station">
                                            <SelectTrigger class="truncate" id="station">
                                                <SelectValue placeholder="Select Station" />
                                            </SelectTrigger>
                                            <SelectContent>
                                                <SelectGroup>
                                                    <SelectLabel>Stations</SelectLabel>
                                                    <SelectItem value="All">All</SelectItem>
                                                    <SelectItem value="ER">ER – Emergency Room</SelectItem>
                                                    <SelectItem value="ICU">ICU – Intensive Care Unit</SelectItem>
                                                    <SelectItem value="Med-Surg">Med-Surg – Medical-Surgical Ward
                                                    </SelectItem>
                                                    <SelectItem value="NICU">NICU – Neonatal Intensive Care Unit
                                                    </SelectItem>
                                                    <SelectItem value="Nursery Ward">Nursery Ward</SelectItem>
                                                    <SelectItem value="OPD">Outpatient Department (OPD) – Scheduled
                                                        consults and
                                                        follow-ups</SelectItem>
                                                    <SelectItem value="PICU">PICU – Pediatric Intensive Care Unit
                                                    </SelectItem>
                                                    <SelectItem value="Pediatric Oncology Unit">Pediatric Oncology Unit
                                                    </SelectItem>
                                                    <SelectItem value="Pediatric Rehab Unit">Pediatric Rehab Unit
                                                    </SelectItem>
                                                    <SelectItem value="Pediatric Ward">Pediatric Ward</SelectItem>
                                                    <SelectItem value="Trauma ICU">Trauma ICU – Trauma-related critical
                                                        care
                                                    </SelectItem>
                                                    <SelectItem value="Transplant ICU">Transplant ICU – Post-transplant
                                                        care
                                                    </SelectItem>
                                                </SelectGroup>

                                            </SelectContent>
                                        </Select>
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <Label for="status">Status</Label>
                                        <Input id="status" v-model="form.status" type="text" />
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <Label for="condition">Condition</Label>
                                        <Input id="condition" v-model="form.condition" type="text" />
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <Label for="condition">Educational Attainment</Label>
                                        <Input id="condition" v-model="form.education" type="text" />
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <Label for="condition">Chief Complaint</Label>
                                        <Input id="condition" v-model="form.chiefComplaint" type="text" />
                                    </div>

                                </div>

                                <Button type="submit">
                                    Save changes
                                </Button>

                            </form>
                        </UseTemplate>

                        <!-- Right side: Add Patient Button -->
                        <div class="flex-shrink-0">
                            <Dialog v-if="isDesktop" v-model:open="isOpen">
                                <DialogTrigger as-child>
                                    <Button @click="openModal()">
                                        + Add Patient
                                    </Button>
                                </DialogTrigger>
                                <DialogContent class="sm:max-w-[425px]">
                                    <DialogHeader>
                                        <DialogTitle>{{ isEditing ? 'Edit Patient' : 'Add New Patient' }}</DialogTitle>
                                        <DialogDescription>
                                            Add patient data to the database. Click save when you're done.
                                        </DialogDescription>
                                    </DialogHeader>
                                    <GridForm />
                                </DialogContent>
                            </Dialog>

                            <Drawer v-else v-model:open="isOpen">
                                <DrawerTrigger as-child>
                                    <Button class="hover:bg-gray-100">
                                        + Add Patient
                                    </Button>
                                </DrawerTrigger>
                                <DrawerContent>
                                    <DrawerHeader class="text-left">
                                        <DrawerTitle>+ Add Patient</DrawerTitle>
                                        <DrawerDescription>
                                            Add patient data to the database. Click save when you're done.
                                        </DrawerDescription>
                                    </DrawerHeader>
                                    <GridForm />
                                    <DrawerFooter class="pt-2">
                                        <DrawerClose as-child>
                                            <Button variant="outline">Cancel</Button>
                                        </DrawerClose>
                                    </DrawerFooter>
                                </DrawerContent>
                            </Drawer>
                        </div>
                    </div>





                    <!-- Table -->
                    <div class="overflow-x-auto mt-4 border rounded-lg">
                        <Table class="">
                            <TableHeader class="bg-green-100">
                                <TableRow>
                                    <TableHead>ID</TableHead>
                                    <TableHead>Name</TableHead>
                                    <TableHead>Birthdate</TableHead>
                                    <TableHead class="hidden lg:table-cell">Gender</TableHead>
                                    <TableHead class="hidden lg:table-cell">Age</TableHead>
                                    <TableHead class="hidden xl:table-cell">Admission No.</TableHead>
                                    <TableHead class="hidden xl:table-cell">Date Time</TableHead>
                                    <TableHead class="hidden md:table-cell">Room No.</TableHead>
                                    <TableHead class="hidden md:table-cell">Station</TableHead>
                                    <TableHead class="hidden md:table-cell">Status</TableHead>
                                    <TableHead class="hidden md:table-cell">Condition</TableHead>
                                    <TableHead class="hidden md:table-cell">Chief Complaint</TableHead>
                                    <TableHead class="">Actions</TableHead>
                                </TableRow>
                            </TableHeader>

                            <TableBody>
                                <TableRow v-if="patients.length === 0">
                                    <TableCell colspan="12" class="text-center text-gray-500">
                                        No records found.
                                    </TableCell>
                                </TableRow>

                                <TableRow v-for="patient in patients" :key="patient.id">
                                    <TableCell>{{ patient.id }}</TableCell>
                                    <TableCell>{{ patient.full_name }}</TableCell>
                                    <TableCell>{{ patient.birth_date }}</TableCell>
                                    <TableCell class="hidden lg:table-cell">{{ patient.gender }}</TableCell>
                                    <TableCell class="hidden lg:table-cell">{{ patient.age }}</TableCell>
                                    <TableCell class="hidden xl:table-cell">{{ patient.admission_no }}</TableCell>
                                    <TableCell class="hidden xl:table-cell">{{ patient.admission_datetime }}
                                    </TableCell>
                                    <TableCell class="hidden md:table-cell">{{ patient.room_no }}</TableCell>
                                    <TableCell class="hidden md:table-cell">{{ patient.station }}</TableCell>
                                    <TableCell class="hidden md:table-cell">{{ patient.status }}</TableCell>
                                    <TableCell class="hidden md:table-cell">{{ patient.condition }}</TableCell>
                                    <TableCell class="hidden md:table-cell">{{ patient.chiefComplaint }}</TableCell>

                                    <TableCell class="text-center">
                                        <DropdownMenu>
                                            <DropdownMenuTrigger as-child>
                                                <Button variant="ghost"
                                                    class="flex h-8 w-8 p-0 data-[state=open]:bg-muted">
                                                    <i class="fa-solid fa-ellipsis"></i>
                                                    <span class="sr-only">Open menu</span>
                                                </Button>
                                            </DropdownMenuTrigger>
                                            <DropdownMenuContent align="end" class="w-[160px]">
                                                <Link :href="route('patient.show', patient.id)">
                                                <DropdownMenuItem>
                                                    <i class="fa-solid fa-eye mr-2"></i> View
                                                </DropdownMenuItem>
                                                </Link>

                                                <DropdownMenuItem @click="openModal(patient)">
                                                    <i class="fa-solid fa-pen-to-square mr-2"></i> Edit
                                                </DropdownMenuItem>

                                                <DropdownMenuItem @click="confirmDelete(patient)">
                                                    <i class="fa-solid fa-trash mr-2"></i> Delete
                                                </DropdownMenuItem>
                                            </DropdownMenuContent>
                                        </DropdownMenu>
                                    </TableCell>
                                </TableRow>
                            </TableBody>
                        </Table>

                        <AlertDialog v-model:open="showDeleteDialog">
                            <AlertDialogContent>
                                <AlertDialogHeader>
                                    <AlertDialogTitle>Are you sure?</AlertDialogTitle>
                                    <AlertDialogDescription>
                                        This will permanently delete the selected patient from the system.
                                    </AlertDialogDescription>
                                </AlertDialogHeader>
                                <AlertDialogFooter>
                                    <AlertDialogCancel>Cancel</AlertDialogCancel>
                                    <AlertDialogAction class="bg-red-600" @click="handleDelete">
                                        Delete
                                    </AlertDialogAction>
                                </AlertDialogFooter>
                            </AlertDialogContent>
                        </AlertDialog>

                    </div>

                </div>
            </div>

        </div>
    </AuthenticatedLayout>



</template>

<script setup>
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from '@/Components/ui/select'
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
import { ref, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router, useForm, usePage } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { Input } from '@/Components/ui/input'
import { Label } from '@/Components/ui/label'
import { Button } from '@/components/ui/button'
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
import { createReusableTemplate, useMediaQuery } from '@vueuse/core'
// Reuse `form` section
const [UseTemplate, GridForm] = createReusableTemplate()
const isDesktop = useMediaQuery('(min-width: 768px)')

const isOpen = ref(false)

const props = defineProps({
    patients: Array,
});

const showModal = ref(false);
const isEditing = ref(false);
const selectedPatient = ref(null);

const openModal = (patient = null) => {
    isEditing.value = !!patient
    selectedPatient.value = patient

    if (patient) {
        form.full_name = patient.full_name
        form.birth_date = patient.birth_date
        form.birth_place = patient.birth_place
        form.gender = patient.gender
        form.admission_no = patient.admission_no
        form.admission_datetime = patient.admission_datetime
        form.room_no = patient.room_no
        form.station = patient.station
        form.status = patient.status
        form.condition = patient.condition
        form.chiefComplaint = patient.chiefComplaint
        form.education = patient.education
    } else {
        form.reset()
        selectedPatient.value = null
    }

    isOpen.value = true // This opens the Dialog or Drawer based on screen size
}


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
        station: searchform.station === 'All' ? null : searchform.station,
    }, {
        preserveState: true,
        replace: true,
    })
}

const form = useForm({
    full_name: '',
    birth_date: '',
    birth_place: '',
    gender: '',
    admission_no: '',
    admission_datetime: '',
    room_no: '',
    station: '',
    status: '',
    condition: '',
    chiefComplaint: '',
    education: '',

});

const submit = () => {
    if (isEditing.value) {
        form.put(route('patient.update', selectedPatient.value.id), {
            onSuccess: () => {
                isOpen.value = false
            }
        });
    } else {
        form.post(route('patient.store'), {
            onSuccess: () => {
                form.reset()
                selectedPatient.value = null
                isEditing.value = false
                isOpen.value = false
            }
        });
    }
};


const deleteform = useForm({})
const patientToDelete = ref(null)
const showDeleteDialog = ref(false)

const confirmDelete = (patient) => {
    patientToDelete.value = patient
    showDeleteDialog.value = true
}

const handleDelete = () => {
    if (patientToDelete.value?.id) {
        deleteform.delete(route('patient.destroy', patientToDelete.value.id), {
            onSuccess: () => {
                showDeleteDialog.value = false
                patientToDelete.value = null
            }
        })
    }
}
</script>