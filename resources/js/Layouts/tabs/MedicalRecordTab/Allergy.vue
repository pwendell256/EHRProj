<template>
  <div class="bg-gray-50 p-4 rounded-lg">
    <h3 class="text-lg font-semibold mb-2">Allergy Records</h3>
    <UseTemplate>
      <form @submit.prevent="isEditing ? updateRecord() : addRecord()" class="grid gap-4 px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="flex flex-col gap-2 col-span-2">
            <Label for="allergy">Allergy</Label>
            <Input id="allergy" v-model="form.allergy" type="text" required />
            <p v-if="form.errors.allergy" class="text-red-500 text-sm">{{ form.errors.allergy }}</p>
          </div>

          <div class="flex flex-col gap-2 col-span-2">
            <Label for="dateTime">Test Date & Time</Label>
            <Input id="dateTime" v-model="form.dateTime" type="datetime-local" required />
            <p v-if="form.errors.dateTime" class="text-red-500 text-sm">{{ form.errors.dateTime }}</p>
          </div>

          <div class="flex flex-col gap-2 md:col-span-2">
            <Label for="description">Description</Label>
            <Input id="description" v-model="form.description" type="text" required />
            <p v-if="form.errors.description" class="text-red-500 text-sm">{{ form.errors.description }}</p>
          </div>

          <div class="flex flex-col gap-2 md:col-span-2">
            <Label for="image">Upload Image</Label>
            <input id="image" type="file" @change="handleImageUpload" accept="image/*"
              class="w-full border rounded px-3 py-2" />
            <p v-if="form.errors.image" class="text-red-500 text-sm">{{ form.errors.image }}</p>
          </div>
        </div>

        <Button type="submit">{{ isEditing ? 'Update' : 'Save' }}</Button>

      </form>
    </UseTemplate>

    <Dialog v-if="isDesktop" v-model:open="isOpen">
      <DialogTrigger as-child>
        <Button @click="openModal()">+ Add Data</Button>
      </DialogTrigger>
      <DialogContent class="sm:max-w-[425px]">
        <DialogHeader>
          <DialogTitle>{{ isEditing ? 'Edit' : 'Add' }} Allergy Record</DialogTitle>
          <DialogDescription>
            Provide allergy information, date, and description. Upload an image if available.
          </DialogDescription>
        </DialogHeader>
        <GridForm />
      </DialogContent>
    </Dialog>

    <Drawer v-else v-model:open="isOpen">
      <DrawerTrigger as-child>
        <Button>+ Add Data</Button>
      </DrawerTrigger>
      <DrawerContent>
        <DrawerHeader class="text-left">
          <DrawerTitle>{{ isEditing ? 'Edit' : 'Add' }} Allergy Record</DrawerTitle>
          <DrawerDescription>
            Provide allergy information, date, and description. Upload an image if available.
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


    <div class="overflow-x-auto mt-4 border rounded-lg">
      <Table>
        <TableHeader class="bg-green-100">
          <TableRow>
            <TableHead>Allergy</TableHead>
            <TableHead>Test Date & Time</TableHead>
            <TableHead>Description</TableHead>
            <TableHead>Image</TableHead>
            <TableHead>Actions</TableHead>
          </TableRow>
        </TableHeader>

        <TableBody>
          <TableRow v-if="!patient.allergies || patient.allergies.length === 0">
            <TableCell colspan="5" class="text-center text-gray-500">
              No allergy records found.
            </TableCell>
          </TableRow>

          <TableRow v-for="record in patient.allergies" :key="record.id">
            <TableCell>{{ record.allergy }}</TableCell>
            <TableCell>{{ record.dateTime }}</TableCell>
            <TableCell>{{ record.description }}</TableCell>
            <TableCell>
              <div class="text-center">
                <button v-if="record.path" @click="openImageModal(record.path)" class="text-blue-600 hover:underline">
                  👁️ View
                </button>
                <span v-else class="text-gray-500">No Image</span>
              </div>
            </TableCell>
            <TableCell class="text-center">
              <DropdownMenu>
                <DropdownMenuTrigger as-child>
                  <Button variant="ghost" class="flex h-8 w-8 p-0 data-[state=open]:bg-muted">
                    <i class="fa-solid fa-ellipsis"></i>
                    <span class="sr-only">Open menu</span>
                  </Button>
                </DropdownMenuTrigger>
                <DropdownMenuContent align="end" class="w-[160px]">
                  <DropdownMenuItem @click="openEditModal(record)">
                    <i class="fa-solid fa-pen-to-square mr-2"></i> Edit
                  </DropdownMenuItem>
                  <DropdownMenuItem @click="deleteRecord(record.id)">
                    <i class="fa-solid fa-trash mr-2"></i> Delete
                  </DropdownMenuItem>
                </DropdownMenuContent>
              </DropdownMenu>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>

    <AlertDialog v-model:open="showDeleteDialog">
      <AlertDialogContent>
        <AlertDialogHeader>
          <AlertDialogTitle>Are you absolutely sure?</AlertDialogTitle>
          <AlertDialogDescription>
            This will permanently delete this allergy record.
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


    <!-- Image Preview Modal -->
    <div v-if="showImageModal" class="fixed z-50 inset-0 flex items-center justify-center bg-black bg-opacity-75">
      <div class="relative bg-white p-4 rounded-lg shadow-lg">
        <button @click="closeImageModal"
          class="absolute top-2 right-2 px-3 py-1 bg-red-600 text-white rounded-full hover:bg-red-700">
          &times;
        </button>
        <img :src="`/storage/` + selectedImage" alt="Expanded Image" class="max-w-full max-h-screen rounded-lg">
      </div>
    </div>

    
  </div>
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

import { Input } from '@/Components/ui/input'
import { Label } from '@/Components/ui/label'
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

import { Button } from '@/Components/ui/button'
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
  patient: Object,
});

const showModal = ref(false);
const isEditing = ref(false);
const selectedRecordId = ref(null);
const showImageModal = ref(false);
const selectedImage = ref(null);

const form = useForm({
  allergy: '',
  dateTime: '',
  description: '',
  image: null,
});

const openModal = () => {
  isEditing.value = false;
  form.reset();
  isOpen.value = true;
};

const openEditModal = (record) => {
  isEditing.value = true;
  selectedRecordId.value = record.id;
  form.allergy = record.allergy;
  form.dateTime = record.dateTime;
  form.description = record.description;
  form.image = record.path;
  isOpen.value = true;
};

const closeModal = () => {
  isOpen.value = false;
  form.reset();
};

const handleImageUpload = (event) => {
  form.image = event.target.files[0];
};

const addRecord = () => {
  form.post(route('allergy.store', props.patient.id), {
    preserveScroll: true,
    onSuccess: () => {
      closeModal();
    },
  });
};


const updateRecord = () => {
  const formData = new FormData();
  formData.append('allergy', form.allergy);
  formData.append('dateTime', form.dateTime);
  formData.append('description', form.description);

  // Only append the image if a new file is selected
  if (form.image instanceof File) {
    formData.append('image', form.image);
  }

  router.post(route('allergy.update', { id: selectedRecordId.value }), formData, {
    preserveScroll: true,
    onSuccess: () => {
      closeModal();
    },
  });
};
const showDeleteDialog = ref(false)
const recordToDeleteId = ref(null)

const deleteRecord = (id) => {
  recordToDeleteId.value = id
  showDeleteDialog.value = true
}

const handleDelete = () => {
  form.delete(route('allergy.destroy', recordToDeleteId.value), {
    preserveScroll: true,
    onSuccess: () => {
      showDeleteDialog.value = false
      recordToDeleteId.value = null
    }
  })
}
// Open Image Modal
const openImageModal = (imagePath) => {
  selectedImage.value = imagePath;
  showImageModal.value = true;
};

// Close Image Modal
const closeImageModal = () => {
  showImageModal.value = false;
  selectedImage.value = null;
};
</script>